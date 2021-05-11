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

    

    $select_query = "SELECT seller_notes.*, note_categories.Category_Name FROM seller_notes LEFT JOIN note_categories ON seller_notes.Category = note_categories.ID WHERE 
    (seller_notes.Title LIKE '%$selected_search%' OR note_categories.Category_Name LIKE '%$selected_search%' OR seller_notes.AdminRemarks LIKE '%$selected_search%') AND 
    Status = 10 ";

    $select_query .= (!empty($selected_seller)&&$selected_seller!="")? "AND seller_notes.SellerID =$selected_seller ":"";

    $select_query .= " ORDER BY seller_notes.CreatedDate DESC";

    $select_query = query($select_query);
    confirm($select_query);

?>

<div id="part3">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table" id="rejected-notes-table">
                            <thead>
                                <tr>
                                    <th>SR NO.</th>
                                    <th>NOTE TITLE</th>
                                    <th>CATEGORY</th>
                                    <th>SELLER</th>
                                    <th>DATE EDITED</th>
                                    <th>REJECTED BY</th>
                                    <th>REMARK</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                            $i=1;
                                while($row = mysqli_fetch_assoc($select_query)) {
                                    $note_id = $row['ID'];
                                    $note_title = $row['Title'];
                                    $note_cat  = $row['Category_Name'];
                                    $seller_id = $row['SellerID'];
                                    $db_date_edited = $row['CreatedDate'];
                                    $rejected_by_id = $row['ActionedBy'];
                                    $remark = $row['AdminRemarks'];

                                    $db_date_timestamp = strtotime($db_date_edited);
                                    $date_edited = date('d-m-Y, H:i', $db_date_timestamp);

                                //admin info
                                $find_admin_info = query("SELECT FirstName, LastName FROM users WHERE ID = '{$rejected_by_id}' ");
                                confirm($find_admin_info);

                                while($row = mysqli_fetch_assoc($find_admin_info )) {
                                    $rejected_by = $row['FirstName'] . " " . $row['LastName'];
                                }

                                //seller
                                $find_seller_info = query("SELECT FirstName, LastName FROM users WHERE ID = '{$seller_id}' ");
                                confirm($find_seller_info);

                                while($row = mysqli_fetch_assoc($find_seller_info)) {
                                    $seller = $row['FirstName'] . " " . $row['LastName'];
                                }

                                
                            ?>
                                    <td><?php echo $i; ?></td>
                                    <td><a
                                            href="Admin_Note_Details.php?Note_id=<?php echo $note_id; ?>"><?php echo $note_title; ?></a>
                                    </td>
                                    <td><?php echo $note_cat; ?></td>
                                    <td><?php echo $seller; ?><span><a
                                                href="Admin_Member_Details.php?Member_id=<?php echo $seller_id;?>"><img
                                                    class="eye-img"
                                                    src="./images/Admin/Rejected_Notes/eye.png"></a></span></td>
                                    <td><?php echo $date_edited; ?></td>
                                    <td><?php echo $rejected_by; ?></td>
                                    <td><?php echo $remark; ?></td>
                                    <td>
                                        <div class="admin-menu-popup">
                                            <a class="admin-menu-check" target="#arn<?php echo $i; ?>">
                                                <img class="dots-img" src="./images/Admin/Rejected_Notes/dots.png">
                                            </a>
                                            <div id="arn<?php echo $i; ?>" class="admin-menu-show">
                                                <p><a style="color:inherit;text-decoration:none;"
                                                        href="Admin_Rejected_Notes.php?approve_noteid=<?php echo $note_id;?>"
                                                        onclick='javascript:Approve($(this));return false;'>Approve</a>
                                                </p>
                                                <p><a href="Admin_Rejected_Notes.php?Note_id=<?php echo $note_id; ?>">Download
                                                        Notes</a></p>
                                                <p><a href="Admin_Note_Details.php?Note_id=<?php echo $note_id; ?>">View
                                                        More Details</a></p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
<script>
     
//Notes under review Table
$(document).ready(function () {
        
        var inProgressNotesTable = $('#rejected-notes-table').DataTable({
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