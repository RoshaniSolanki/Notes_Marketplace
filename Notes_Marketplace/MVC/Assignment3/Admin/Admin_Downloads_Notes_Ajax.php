<?php
include "../includes/db.php";
include "../includes/functions.php";


    if(isset($_GET['selected_search'])){
        $selected_search=$_GET['selected_search'];
    }
    else {
        $selected_search="";
    }
    if(isset($_GET['selected_note'])&&!empty($_GET['selected_note'])){
        $selected_note=$_GET['selected_note'];
    }
    else{
        $selected_note="";
    }
    if(isset($_GET['selected_buyer'])&&!empty($_GET['selected_buyer'])){
        $selected_buyer=$_GET['selected_buyer'];
    }
    else{
        $selected_buyer="";
    }
    if(isset($_GET['selected_seller'])&&!empty($_GET['selected_seller'])){
        $selected_seller=$_GET['selected_seller'];
    }
    else{
        $selected_seller="";
    }

    $select_query = "";

    $select_query = "SELECT DISTINCT seller_notes.ID, seller_notes.Title, seller_notes.IsPaid, seller_notes.SellingPrice, downloads.Seller,
    downloads.Downloader, downloads.AttachementDownloadedDate, downloads.NoteCategory FROM seller_notes LEFT JOIN downloads ON 
    downloads.NoteID = seller_notes.ID WHERE (seller_notes.Title LIKE '%$selected_search%' OR 
    downloads.NoteCategory LIKE '%$selected_search%' OR seller_notes.SellingPrice LIKE '%$selected_search%') AND IsAttachementDownloaded = 1 ";

    $select_query .= (!empty($selected_note)&&$selected_note!="")? "AND seller_notes.ID =$selected_note ":"";

    $select_query .= (!empty($selected_seller)&&$selected_seller!="")? "AND downloads.Seller =$selected_seller ":"";

    $select_query .= (!empty($selected_buyer)&&$selected_buyer!="")? "AND downloads.Downloader=$selected_buyer ":"";

    $select_query .= " ORDER BY downloads.AttachementDownloadedDate DESC";

    $select_query = query($select_query);
    confirm($select_query);

?>
<div id="part3">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table" id="downloads-notes-table">
                            <thead>
                                <tr>
                                    <th>SR NO.</th>
                                    <th>NOTE TITLE</th>
                                    <th>CATEGORY</th>
                                    <th>BUYER</th>
                                    <th>SELLER</th>
                                    <th>SELL TYPE</th>
                                    <th>PRICE</th>
                                    <th>DOWNLOADED<br>DATE/TIME</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                            $i=1;
                            while($row = mysqli_fetch_assoc($select_query)){
                                $note_id    = $row['ID'];
                                $note_title = $row['Title'];
                                $note_cat   = $row['NoteCategory'];
                                $buyer_id      = $row['Downloader'];
                                $seller_id     = $row['Seller'];
                                $ispaid        = $row['IsPaid'];
                                $price         = $row['SellingPrice'];
                                $db_download_date = $row['AttachementDownloadedDate'];

                                $db_date_timestamp = strtotime($db_download_date);
                                $download_date = date('d-m-Y, H:i', $db_date_timestamp);

                                //buyer
                                $find_buyer_info = query("SELECT FirstName, LastName FROM users WHERE ID = '{$buyer_id}' ");
                                confirm($find_buyer_info);

                                while($row = mysqli_fetch_assoc($find_buyer_info)) {
                                    $buyer = $row['FirstName'] . " " . $row['LastName'];
                                }

                                //seller
                                $find_seller_info = query("SELECT FirstName, LastName FROM users WHERE ID = '{$seller_id}' ");
                                confirm($find_seller_info);

                                while($row = mysqli_fetch_assoc($find_seller_info)) {
                                    $seller = $row['FirstName'] . " " . $row['LastName'];
                                }

                                if($ispaid == 0) {
                                    $sell_type = 'Free';
                                }else {
                                    $sell_type = 'Paid';
                                }

                            ?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td><a
                                            href="Admin_Note_Details.php?Note_id=<?php echo $note_id; ?>"><?php echo $note_title;?></a>
                                    </td>
                                    <td><?php echo $note_cat;?></td>
                                    <td><?php echo $buyer;?><span><a
                                                href="Admin_Member_Details.php?Member_id=<?php echo $buyer_id;?>"><img
                                                    class="eye-img"
                                                    src="./images/Admin/Downloades_Notes/eye.png"></a></span></td>
                                    <td><?php echo $seller;?><span><a
                                                href="Admin_Member_Details.php?Member_id=<?php echo $seller_id;?>"><img
                                                    class="eye-img"
                                                    src="./images/Admin/Downloades_Notes/eye.png"></a></span></td>
                                    <td><?php echo $sell_type;?></td>
                                    <td>&#36;<?php echo $price;?></td>
                                    <td><?php echo $download_date;?></td>
                                    <td>
                                        <div class="admin-menu-popup">
                                            <a class="admin-menu-check" target="#adn<?php echo $i;?>">
                                                <img class="dots-img" src="./images/Admin/Downloades_Notes/dots.png">
                                            </a>
                                            <div id="adn<?php echo $i;?>" class="admin-menu-show">
                                                <p><a href="Admin_Downloads_Notes.php?Note_id=<?php echo $note_id; ?>">Download
                                                        Notes</a></p>
                                                <p><a href="Admin_Note_Details.php?Note_id=<?php echo $note_id; ?>">View
                                                        More Details</a></p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++;}?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    <script>
    
//Downloads Notes Table
$(document).ready(function () {
        
        var inProgressNotesTable = $('#downloads-notes-table').DataTable({
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