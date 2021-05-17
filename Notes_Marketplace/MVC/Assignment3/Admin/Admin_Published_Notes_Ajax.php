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

    $select_query = "SELECT seller_notes.*, users.FirstName, users.LastName, note_categories.Category_Name FROM seller_notes LEFT JOIN users ON 
    seller_notes.sellerID = users.ID LEFT JOIN note_categories ON seller_notes.Category = note_categories.ID WHERE (seller_notes.Title LIKE '%$selected_search%' OR 
    note_categories.Category_Name LIKE '%$selected_search%' OR users.FirstName LIKE '%$selected_search%' OR users.LastName LIKE '%$selected_search%' OR seller_notes.SellingPrice 
    LIKE '%$selected_search%' OR seller_notes.PublishedDate LIKE '%$selected_search%') AND Status = 9 ";

    $select_query .= (!empty($selected_seller)&&$selected_seller!="")? "AND users.ID =$selected_seller ":"";

    $select_query .= " ORDER BY seller_notes.PublishedDate DESC";

    $select_query = query($select_query);
    confirm($select_query);

?>
<div id="part3">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table" id="published-notes-table">
                    <thead>
                        <tr>
                            <th>SR NO.</th>
                            <th>NOTE TITLE</th>
                            <th>CATEGORY</th>
                            <th>SELL TYPE</th>
                            <th>PRICE</th>
                            <th>SELLER</th>
                            <th>PUBLISHED DATE</th>
                            <th>APPROVED BY</th>
                            <th>NUMBER OF<br>DOWNLOADS</th>
                            <th></th>
                        </tr>
                        <thead>
                        <tbody>
                            <?php
                                    $i=1;
                                        while($row = mysqli_fetch_assoc($select_query)){

                                            $seller_id      = $row['SellerID'];
                                            $note_id        = $row['ID'];
                                            $note_title     = $row['Title'];
                                            $note_cat       = $row['Category_Name'];
                                            $ispaid         = $row['IsPaid'];
                                            $price          = $row['SellingPrice'];
                                            $seller         = $row['FirstName']. " " .$row['LastName'];
                                            $db_date        = $row['PublishedDate'];
                                            $approved_by    = $row['ActionedBy'];

                                            $find_approved_by_name = query("SELECT FirstName, LastName FROM users WHERE ID = '{$approved_by}' ");
                                            confirm($find_approved_by_name);

                                            while($row = mysqli_fetch_assoc($find_approved_by_name)){

                                                $approved_by_name = $row['FirstName']." ".$row['LastName'];
                                            }

                                            $db_date_timestamp = strtotime($db_date);
                                            $published_date = date('d-m-Y, H:i', $db_date_timestamp);

                                            if($ispaid == 0){
                                                $sell_type = 'Free';
                                            }else {
                                                $sell_type = 'Paid';
                                            }

                                            //downloaded notes
                                            $downloaded = query("SELECT DISTINCT seller_notes.ID FROM seller_notes LEFT JOIN downloads ON seller_notes.ID = downloads.NoteID WHERE 
                                            downloads.IsAttachementDownloaded = 1 AND NoteID = $note_id");
                                            confirm($downloaded);

                                            $download_count = mysqli_num_rows($downloaded);
                                ?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><a
                                        href="Admin_Note_Details.php?Note_id=<?php echo $note_id; ?>"><?php echo $note_title;?></a>
                                </td>
                                <td><?php echo $note_cat;?></td>
                                <td><?php echo $sell_type;?></td>
                                <td>&#36;<?php echo $price;?></td>
                                <td><?php echo $seller;?><span><a
                                            href="Admin_Member_Details.php?Member_id=<?php echo $seller_id;?>"><img
                                                class="eye-img" src="./images/Admin/Published_Notes/eye.png"></span></a>
                                </td>
                                <td><?php echo $published_date;?></td>
                                <td><?php echo $approved_by_name;?></td>
                                <td><a
                                        href="Admin_Downloads_Notes.php?download_note_id=<?php echo $note_id;?>"><?php echo $download_count;?></a>
                                </td>
                                <td>
                                    <div class="admin-menu-popup">
                                        <a class="admin-menu-check" target="#apn<?php echo $i;?>">
                                            <img class="dots-img" src="images/Admin/Spam_Reports/dots.png">
                                        </a>
                                        <div id="apn<?php echo $i;?>" class="admin-menu-show">
                                            <p><a href="Admin_Published_Notes.php?noteid=<?php echo $note_id; ?>">Download
                                                    Notes</a></p>
                                            <p><a href="Admin_Note_Details.php?Note_id=<?php echo $note_id; ?>">View
                                                    More Details</a></p>

                                            <p><a href="#" data-title="<?php echo $note_title; ?>"
                                                    data-id="<?php echo $note_id; ?>"
                                                    data-sellerid="<?php echo $seller_id; ?>" id="unpublish"
                                                    data-toggle="modal" data-target="#unpublishPopup">Unpublish</a>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- unpublish popup -->
                            <div class="modal" id="unpublishPopup" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="color:#6255a5;font-weight:600;font-size:16px;"
                                                class="modal-title" id="exampleModalLabel">
                                                <?php echo $note_title;?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="" method="POST">
                                            <div class="modal-body">
                                                <input name="noteid_for_unpublish" id="noteid_for_unpublish" value=""
                                                    hidden>
                                                <input name="notetitle_for_unpublish" id="notetitle_for_unpublish"
                                                    value="" hidden>
                                                <input name="sellerid_for_unpublish" id="sellerid_for_unpublish"
                                                    value="" hidden>
                                                <div class="form-group">
                                                    <label for="remark">Remarks*</label>
                                                    <textarea id="remark" class="form-control" name="remark"
                                                        placeholder="Write remarks" rows="7" required></textarea>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" name="unpublish-btn"
                                                    style="background:#ff3636";
                                                    onclick='javascript:Unpublish($(this));return false;'>Unpublish</button>
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

$(document).on("click", "#unpublish", function () {
    $('#noteid_for_unpulish').val($(this).data('id'));
    $('#notetitle_for_unpulish').val($(this).data('title'));
    $('#sellerid_for_unpulish').val($(this).data('sellerid'));
    $('#unpublishPopup').modal('show');
});



//Published Notes Table
$(document).ready(function () {
        
    var inProgressNotesTable = $('#published-notes-table').DataTable({
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