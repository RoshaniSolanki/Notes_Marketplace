<?php
include "../includes/db.php";
include "../includes/functions.php";


    if(isset($_GET['selected_search'])){
        $selected_search=$_GET['selected_search'];
    }
    else {
        $selected_search="";
    }
    if(isset($_GET['selected_seller'])&&!empty($_GET['selected_seller'])){
        $selected_seller=$_GET['selected_seller'];
    }
    else{
        $selected_seller="";
    }

    $select_query = "";

        $select_query = "SELECT seller_notes.ID,seller_notes.SellerID, seller_notes.Title, seller_notes.CreatedDate, users.FirstName, users.LastName, reference_data.Value, 
        note_categories.Category_Name FROM seller_notes LEFT JOIN users ON  seller_notes.sellerID = users.ID LEFT JOIN note_categories ON seller_notes.Category = note_categories.ID 
        LEFT JOIN reference_data ON seller_notes.Status = reference_data.ID WHERE(seller_notes.Title LIKE '%$selected_search%' OR note_categories.Category_Name LIKE '%$selected_search%'
        OR users.FirstName LIKE '%$selected_search%' OR users.LastName LIKE '%$selected_search%' OR reference_data.Value LIKE '%$selected_search%') AND (reference_data.Value = 
        'Submitted For Review' OR reference_data.Value = 'In Review') ";

        $select_query .= (!empty($selected_seller)&&$selected_seller!="")? "AND users.ID =$selected_seller ":"";

        $select_query .= " ORDER BY seller_notes.CreatedDate ASC";

        $select_query = query($select_query);
        confirm($select_query);

    

?>
<div id="part3">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table" id="notes-under-review-table">
                    <thead>
                        <tr>
                            <th>SR NO.</th>
                            <th>NOTE TITLE</th>
                            <th>CATEGORY</th>
                            <th>SELLER</th>
                            <th>DATE ADDED</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $i=1;
                                    while($row = mysqli_fetch_assoc($select_query)){

                                        $note_id    = $row['ID'];
                                        $note_title = $row['Title'];
                                        $note_cat   = $row['Category_Name'];
                                        $seller     = $row['FirstName']. " " .$row['LastName'];
                                        $seller_id  = $row['SellerID'];
                                        $db_date    = $row['CreatedDate'];
                                        $status     = $row['Value'];

                                        $db_date_timestamp = strtotime($db_date);
                                        $date_added = date('d-m-Y, H:i', $db_date_timestamp);

                                ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><a
                                    href="Admin_Note_Details.php?Note_id=<?php echo $note_id; ?>"><?php echo $note_title; ?></a>
                            </td>
                            <td><?php echo $note_cat; ?></td>
                            <td><?php echo $seller; ?><span><a
                                        href="Admin_Member_Details.php?Member_id=<?php echo $seller_id;?>"><img
                                            class="eye-img" src="./images/Admin/Note_Under_Review/eye.png"></a></span>
                            </td>
                            <td><?php echo $date_added; ?></td>
                            <td><?php echo $status; ?></td>
                            <td>
                                <button type="submit" class="btn btn-primary approve-btn"
                                    onclick='javascript:Approve($(this));return false;'>
                                    <a style="color:inherit;text-decoration:none;"
                                        href="Admin_Notes_Under_Reb_Page.php?approve_noteid=<?php echo $note_id;?>">Approve</a>
                                </button>
                                <button type="button" class="btn btn-primary reject-btn" data-toggle="modal"
                                    data-target="#rejectPopup" id="reject-button"
                                    data-id="<?php echo $note_id; ?>">Reject</button>
                                <button type="submit" class="btn btn-primary inreview-btn"
                                    onclick='javascript:InReview($(this));return false;'>
                                    <a style="color:inherit;text-decoration:none;"
                                        href="Admin_Notes_Under_Reb_Page.php?inreview_noteid=<?php echo $note_id;?>">InReview</a>
                                </button>

                            </td>
                            <td>
                                <div class="admin-menu-popup">
                                    <a class="admin-menu-check" target="#apn<?php echo $i;?>">
                                        <img class="dots-img" src="./images/Admin/Note_Under_Review/dots.png">
                                    </a>
                                    <div id="apn<?php echo $i;?>" class="admin-menu-show">
                                        <p><a href="Admin_Note_Details.php?Note_id=<?php echo $note_id; ?>">View
                                                More Details</a></p>
                                        <p><a href="Admin_Notes_Under_Reb_Page.php?Note_id=<?php echo $note_id; ?>">Download
                                                Notes</a></p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <!-- reject popup -->
                        <div class="modal" id="rejectPopup" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 style="color:#6255a5;font-weight:600;font-size:16px;" class="modal-title"
                                            id="exampleModalLabel">
                                            <?php echo $note_title;?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="" method="POST">
                                        <div class="modal-body">
                                            <input name="noteid_for_reject" id="noteid_for_reject" value="" hidden>
                                            <div class="form-group">
                                                <label for="remark">Remarks*</label>
                                                <textarea id="remark" class="form-control" name="remark"
                                                    placeholder="Write remarks" rows="7" required></textarea>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" name="reject-btn"
                                                style="background:#ff3636" ;
                                                onclick='javascript:Reject($(this));return false;'>Reject</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancle</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <?php
                                    $i++;}
                                ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
 
<script>
    
//Notes under review Table
$(document).ready(function () {
        
        var inProgressNotesTable = $('#notes-under-review-table').DataTable({
            "order": [[ 4, "desc" ]],
            "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                //debugger;
                var index = iDisplayIndexFull + 1;
                $("td:first", nRow).html(index);
                return nRow;
            },
            'sDom': '"top"i',
            "iDisplayLength": 5,
            "bInfo": false,
            language: {
                "zeroRecords": "No record found",
                paginate: {
                    next: "<img src='./images/Admin/Members/right-arrow.png' alt=''>",
                    previous: "<img src='./images/Admin/Members/left-arrow.png' alt=''>"
                }
            }
        });
    });
</script>

<!-- Custom JS -->
<script src="js/script.js"></script>
