<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();

if(isset($_GET['Member_id'])) {

    $member_id = $_GET['Member_id'];

    $select_query = query("SELECT DISTINCT seller_notes.ID, seller_notes.Title, seller_notes.IsPaid, seller_notes.SellingPrice, downloads.Seller, 
    downloads.Downloader, downloads.AttachementDownloadedDate, downloads.NoteCategory FROM seller_notes LEFT JOIN downloads ON 
    downloads.NoteID = seller_notes.ID WHERE IsAttachementDownloaded = 1 ORDER BY downloads.AttachementDownloadedDate DESC");
    confirm($select_query);
}
    $select_query = query("SELECT DISTINCT seller_notes.ID, seller_notes.Title, seller_notes.IsPaid, seller_notes.SellingPrice, downloads.Seller, 
    downloads.Downloader, downloads.AttachementDownloadedDate, downloads.NoteCategory FROM seller_notes LEFT JOIN downloads ON 
    downloads.NoteID = seller_notes.ID WHERE IsAttachementDownloaded = 1 ORDER BY downloads.AttachementDownloadedDate DESC");
    confirm($select_query);

    //download note
    if(isset($_GET['Note_id'])){
        $note_id=$_GET['Note_id'];

        $find_path = query("SELECT * FROM seller_notes_attachements WHERE NoteID = '{$note_id}' ");
        confirm($find_path);

        $find_attachement_count = mysqli_num_rows($find_path);

        while($row = mysqli_fetch_assoc($find_path)) {
            $file_path = $row['FilePath'];
        }

        $find_note_title = query("SELECT Title FROM seller_notes WHERE ID = '{$note_id}' ");
        confirm($find_note_title);

        while($row = mysqli_fetch_assoc($find_note_title)) {
            $title = $row['Title'];
        }
        
        if($find_attachement_count==1){
        header('Cache-Control:public');
        header('Content-Description:File Transfer');
        header('Content-Disposition:attachment; filename='.$title.'.pdf');
        header('Control-Type:application/pdf');
        header('Content-Transfer-Encoding:binary');
        readfile($file_path);
        

        }
        else{
            
            $zipname = $title . '.zip';
            $zip = new ZipArchive;
            $zip->open($zipname, ZipArchive::CREATE);
            $find_path = query("SELECT * FROM seller_notes_attachements WHERE NoteID = '{$note_id}' ");
            confirm($find_path);
            while($row = mysqli_fetch_assoc($find_path)) {
                $attach_id = $row['FilePath'];
                $zip->addFile($attach_id);
            }
            $zip->close();
            header('Content-Type: application/zip');
            header('Content-disposition: attachment; filename=' . $zipname);
            header('Content-Length: ' . filesize($zipname));
            readfile($zipname);
            
        }

    }
?>
<?php include "header.php"; ?>
    <!-- Downloades Notes-->
    <div id="adminDownloadesNotes">
        <div class="container">
            <div id="part1">
                <div class="row">
                    <div class="col-md-12">
                        <p>Downloaded Notes</p>
                    </div>
                </div>
            </div>
            <div id="part2">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <label class="note" for="note">Note</label>
                        <label class="seller" for="seller">Seller</label>
                        <label class="buyer" for="buyer">Buyer</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-8 col-xs-12">
                        
                            <span><img class="arrow-down-img1"
                                    src="./images/Admin/Downloades_Notes/down-arrow.png"></span>
                            <select id="note" name="note">
                                <option selected disabled hidden>Select note</option>
                            </select>
                        
                        
                            <span><img class="arrow-down-img2"
                                    src="./images/Admin/Downloades_Notes/down-arrow.png"></span>
                            <select  id="seller" name="seller">
                                <option selected disabled hidden>Select seller</option>
                            </select>
                       
                        
                            <span><img class="arrow-down-img3"
                                    src="./images/Admin/Downloades_Notes/down-arrow.png"></span>
                            <select id="buyer" name="buyer">
                                <option selected disabled hidden>Rahul Shah</option>
                            </select>
                       
                    </div>
                    <div class="col-md-6 col-sm-4 col-xs-12">
                        
                            <span><img class="search-icon-img"
                                    src="./images/Admin/Downloades_Notes/search-icon.png"></span>
                            <input type="text" name="search" id="search" placeholder="Search">
                            <a href=""><button class="btn btn-primary search-btn">SEARCH</button></a>
                        
                    </div>
                </div>
            </div>
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
                                <td><a href="Admin_Note_Details.php?Note_id=<?php echo $note_id; ?>"><?php echo $note_title;?></a></td>
                                <td><?php echo $note_cat;?></td>
                                <td><?php echo $buyer;?><span><a href="Admin_Member_Details.php?Member_id=<?php echo $buyer_id;?>"><img class="eye-img" src="./images/Admin/Downloades_Notes/eye.png"></a></span></td>
                                <td><?php echo $seller;?><span><a href="Admin_Member_Details.php?Member_id=<?php echo $seller_id;?>"><img class="eye-img" src="./images/Admin/Downloades_Notes/eye.png"></a></span></td>
                                <td><?php echo $sell_type;?></td>
                                <td>&#36;<?php echo $price;?></td>
                                <td><?php echo $download_date;?></td>
                                <td>
                                    <div class="admin-menu-popup">
                                        <a class="admin-menu-check" target="#adn<?php echo $i;?>">
                                            <img class="dots-img" src="./images/Admin/Downloades_Notes/dots.png">
                                        </a>
                                        <div id="adn<?php echo $i;?>" class="admin-menu-show">
                                            <p><a href="Admin_Downloads_Notes.php?Note_id=<?php echo $note_id; ?>">Download Notes</a></p>
                                            <p><a href="Admin_Note_Details.php?Note_id=<?php echo $note_id; ?>">View More Details</a></p>
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
        </div>
        <!-- Published Notes Ends -->
        
        <?php include "footer.php"; ?>