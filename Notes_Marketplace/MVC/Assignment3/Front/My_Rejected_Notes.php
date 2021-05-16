<?php
include "../includes/db.php";
include "../includes/functions.php";

session_start();

if(isset($_SESSION['email']) && $_SESSION['roleid']==3) {
    $user_id = $_SESSION['userid'];


    if(isset($_POST['search-btn'])) {

        $search_result = $_POST['search'];
        
        $select_query = query("SELECT seller_notes.ID, downloads.NoteTitle, downloads.NoteCategory, reference_data.Value, seller_notes.AdminRemarks, seller_notes.CreatedDate FROM 
        downloads LEFT JOIN users ON downloads.Downloader=users.ID LEFT JOIN seller_notes ON downloads.NoteID = seller_notes.ID LEFT JOIN reference_data ON 
        seller_notes.Status=reference_data.ID WHERE (downloads.NoteTitle LIKE '%$search_result%' OR downloads.NoteCategory LIKE '%$search_result%' OR seller_notes.AdminRemarks 
        LIKE '%$search_result%') AND downloads.Downloader=$user_id AND reference_data.Value = 'Rejected' ORDER BY downloads.AttachementDownloadedDate DESC");
        confirm($select_query);

    }else {

        $select_query = query("SELECT seller_notes.ID, downloads.NoteTitle, downloads.NoteCategory, reference_data.Value, seller_notes.AdminRemarks, seller_notes.CreatedDate FROM downloads LEFT JOIN users ON downloads.Downloader=users.ID LEFT JOIN seller_notes 
        ON downloads.NoteID = seller_notes.ID LEFT JOIN reference_data ON seller_notes.Status=reference_data.ID WHERE downloads.Downloader=$user_id AND reference_data.Value = 'Rejected' ORDER BY downloads.AttachementDownloadedDate DESC");
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

    <!-- My Rejected Notes -->
    <div id="myRejectedNotes">
        <div class="container">

            <div id="part1">
                <div class="row">
                    <div class="col-md-5 col-sm-4 col-xs-4">
                        <p>My Rejected Notes</p>
                    </div>
                    <div class="col-md-7 col-sm-8 col-xs-8">
                        <form action="" method="POST">
                        <input type="text" name="search" id="search" placeholder="Search">
                        <span><img class="search-icon-img" src="./images/My_Rejected_Notes/search-icon.png"></span>
                        <button type="submit" name="search-btn" class="btn btn-primary my-rejected-notes-search-btn">SEARCH</button>
                        </form>
                    </div>
                </div>
            </div>
            <div id="part2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                        <table class="table" id="my-rejected-notes-table">
                            <thead>
                            <tr>
                                <th>SR NO.</th>
                                <th>NOTE TITLE</th>
                                <th>CATEGORY</th>
                                <th>REMARKS</th>
                                <th>Date Edited</th>
                                <th>CLONE</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 

                            $i=1;
                            while($row = mysqli_fetch_assoc($select_query)){

                                $note_id = $row['ID'];
                                $note_title = $row['NoteTitle'];
                                $note_category = $row['NoteCategory'];
                                $remarks = $row['AdminRemarks'];
                                $db_date_edited = $row['CreatedDate'];

                                $db_date_timestamp = strtotime($db_date_edited);
                                $date_edited = date('d M Y, H:i:s', $db_date_timestamp); 

                                ?>

                                <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $note_title; ?></td>
                                <td><?php echo $note_category; ?></td>
                                <td><?php echo $remarks; ?></td>
                                <td><?php echo $date_edited; ?></td>
                                <td>Clone</td>
                                <td>
                                    <div class="my-rej-menu-popup">
                                        <a class="my-rej-menu-check" target="#mr<?php echo $i;?>">
                                            <img class="dots-img" src="./images/My_Rejected_Notes/dots.png">
                                        </a>
                                        <div id="mr<?php echo $i; ?>" class="my-rej-menu-show">
                                            <p><a href="My_Rejected_Notes.php?Note_id=<?php echo $note_id; ?>">Download Note</a></p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            }
                            $i++;
                            ?>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- My Rejected Notes Ends -->
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
                            <li><a href="#"><img src="images/My_Rejected_Notes/facebook.png"></a></li>
                            <li><a href="#"><img src="images/My_Rejected_Notes/twitter.png"></a></li>
                            <li><a href="#"><img src="images/My_Rejected_Notes/linkedin.png"></a></li>
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