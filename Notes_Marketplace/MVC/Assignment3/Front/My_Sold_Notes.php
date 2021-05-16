<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();

if(isset($_SESSION['email']) && $_SESSION['roleid']==3) {
    $user_id = $_SESSION['userid'];



    if(isset($_POST['search-btn'])) {

        $search_result = $_POST['search'];
        
        $select_query = query("SELECT downloads.* , users.EmailID FROM downloads LEFT JOIN users ON downloads.Seller=users.ID 
        WHERE (downloads.NoteTitle LIKE '%$search_result%' OR downloads.NoteCategory LIKE '%$search_result%' OR downloads.PurchasedPrice LIKE '%$search_result%')
        AND downloads.Seller=$user_id AND IsSellerHasAllowedDownload = 1 AND AttachementPath IS NOT NULL ORDER BY downloads.AttachementDownloadedDate DESC");
        confirm($select_query);

    }else {

        $select_query = query("SELECT downloads.* , users.EmailID FROM downloads LEFT JOIN users ON downloads.Seller=users.ID 
        WHERE downloads.Seller=$user_id AND IsSellerHasAllowedDownload = 1 AND AttachementPath IS NOT NULL ORDER BY downloads.AttachementDownloadedDate DESC");
        confirm($select_query);

    }

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
        $date = date('Y-m-d H:i:s');

        $update_entry = query("UPDATE downloads SET AttachementDownloadedDate='$date', IsAttachementDownloaded = 1 WHERE NoteID = $note_id AND Downloader = $user_id AND IsSellerHasAllowedDownload = 1");
        confirm($update_entry);

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
            $date = date('Y-m-d H:i:s');
            $update_entry = query("UPDATE downloads SET AttachementDownloadedDate='$date', IsAttachementDownloaded = 1 WHERE NoteID = $note_id AND Downloader = $user_id AND IsSellerHasAllowedDownload = 1");
            confirm($update_entry);
        }

    }

}else{
    redirect("Login.php");
}
?>

<?php include "header.php"; ?>

    <!-- My Sold Notes -->
    <div id="mySoldNotes">
        <div class="container">

            <div id="part1">
                <div class="row">
                    <div class="col-md-5 col-sm-4 col-xs-4">
                        <p>My Sold Notes</p>
                    </div>
                    <div class="col-md-7 col-sm-8 col-xs-8">
                        <form action="" method="POST">
                            <input type="text" name="search" id="search" placeholder="Search"><span><img
                                    class="search-icon-img" src="./images/My_Sold_Notes/search-icon.png"></span>
                            <button type="submit" name="search-btn" class="btn btn-primary my-sold-notes-search-btn">SEARCH</button></a>
                        </form>
                    </div>
                </div>
            </div>
            <div id="part2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table" id="my-sold-note-table">
                                <thead>
                                <tr>
                                    <th>SR NO.</th>
                                    <th>NOTE TITLE</th>
                                    <th>CATEGORY</th>
                                    <th>BUYER</th>
                                    <th>SELL TYPE</th>
                                    <th>PRICE</th>
                                    <th>DOWNLOADED DATE/TIME</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $i=1;
                                    while($buyer_row = mysqli_fetch_assoc($select_query)) {

                                        $note_id       = $buyer_row['NoteID'];
                                        $ispaid        = $buyer_row['IsPaid'];
                                        $price         = $buyer_row['PurchasedPrice'];
                                        $note_title    = $buyer_row['NoteTitle'];
                                        $note_category = $buyer_row['NoteCategory'];
                                        $downloader    = $buyer_row['Downloader'];

                                        $db_download_date = $buyer_row['AttachementDownloadedDate'];
                                        $db_download_date_timestamp = strtotime($db_download_date);
                                        $download_date = date('d M Y, H:i:s', $db_download_date_timestamp); 

                                        $select_email = query("SELECT EmailID FROM users WHERE ID = '{$downloader}' ");
                                        confirm($select_email);

                                        while($email_row = mysqli_fetch_assoc($select_email)) {
                                            $buyer_email = $email_row['EmailID'];
                                        }


                                        if($ispaid == 0) {
                                            $sell_type = 'Free';
                                            $price =0;
                                        }else {
                                            $sell_type = 'Paid';
                                        }
                                ?>
                                
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $note_title; ?></td>
                                    <td><?php echo $note_category; ?></td>
                                    <td><?php echo $buyer_email; ?></td>
                                    <td><?php echo $sell_type; ?></td>
                                    <td>&#36;<?php echo $price; ?></td>
                                    <td><?php echo $download_date; ?></td>
                                    <td><a href="Note_Details_Page.php?Note_id=<?php echo $note_id; ?>"><img
                                                class="eye-img" src="./images/My_Sold_Notes/eye.png"></a>

                                        <div class="my-sold-menu-popup">
                                            <a class="my-sold-menu-check" target="#ms<?php echo $i;?>">
                                                <img class="dots-img" src="./images/My_Sold_Notes/dots.png">
                                            </a>
                                            <div id="ms<?php echo $i;?>" class="my-sold-menu-show">
                                                <p><a href="My_Sold_Notes.php?Note_id=<?php echo $note_id; ?>">Download Note</a></p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <?php    
                                $i++;}
                            ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- My Sold Notes Ends -->
        <!-- Footer -->
        <footer class="footer">
            <hr>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <p class="footer-text">
                            Copyright &copy; TatvaSoft All Rights Reserved.
                        </p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <ul class="social-list">
                            <li><a href="#"><img src="images/My_Sold_Notes/facebook.png"></a></li>
                            <li><a href="#"><img src="images/My_Sold_Notes/twitter.png"></a></li>
                            <li><a href="#"><img src="images/My_Sold_Notes/linkedin.png"></a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </footer>
        <!-- Footer Ends -->

        <!-- JQuery -->
        <script src="js/jquery-3.5.1.min.js"></script>

        <!-- Bootstrap JS -->
        <script src="js/bootstrap/bootstrap.min.js"></script>

        <script src="js/datatables.js"></script>

        <!-- Custom JS -->
        <script src="js/script.js"></script>
</body>

</html>