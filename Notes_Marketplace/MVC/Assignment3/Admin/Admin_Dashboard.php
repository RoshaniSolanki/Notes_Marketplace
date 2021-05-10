<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();

    $select_query = query("SELECT seller_notes.*, note_categories.Category_Name FROM seller_notes LEFT JOIN downloads ON seller_notes.ID = downloads.NoteID LEFT JOIN note_categories 
    ON seller_notes.Category = note_categories.ID WHERE seller_notes.Status = 9");
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

    if(isset($_POST['unpublish-btn'])) {

        $noteid = $_POST['noteid_for_unpublish'];
        $notetitle = $_POST['notetitle_for_unpublish'];
        $sellerid = $_POST['sellerid_for_unpublish'];
        $remark  = $_POST['remark'];

        $update_to_removed = query("UPDATE seller_notes SET Status = 11 WHERE ID = '$noteid' AND Status = 9 ");
        confirm($update_to_removed);

        $insert_remark = query("UPDATE seller_notes SET ActionedBy = '$admin_id' AND AdminRemarks = '$remark' ");
        confirm($insert_remark);

        $seller_info = query("SELECT FirstName, LastName, EmailID FROM users WHERE ID = '{$sellerid}' ");
        confirm($seller_info);

        while($row = mysqli_fetch_assoc($seller_info)) {
            $seller_name = $row['FirstName']. " ".$row['LastName'];
            $seller_email = $row['EmailID'];
        }
        
        $subject = "Sorry! We need to remove your notes from our portal.";
        $email = "sroshani025@gmail.com";
        $body = "Hello ".$seller_name.","."\r\n"."\r\n"."We want to inform you that, your note " .$notetitle. "  has been removed from the portal.
        Please find our remarks as below -" ."\r\n".$remark. "\r\n"."\r\n"."Regards,"."\r\n". "Notes Marketplace";
        $sender_email = "Email From: {$email}";
        $result = mail($seller_email, $subject, $body, $sender_email);
             
            if(!$result) {
                echo "<script>alert('Email sending failed....')</script>";
            }

        redirect("Admin_Published_Notes.php");

    }

?>
<?php include "header.php"; ?>

    <!-- Dashboard -->
    <div id="adminDashboard">
        <div class="container">
            <div id="section1">
                <div id="part1">
                    <div class="row">
                        <div class="col-md-12">
                            <h1>Dashboard</h1>
                        </div>
                    </div>
                </div>
                <div id="part2">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4 box">
                            <div class="row">
                                <div class="col-md-12">
                                <?php

                                    $find_in_review_count = query("SELECT ID FROM seller_notes WHERE Status = 8");
                                    confirm($find_in_review_count);

                                    $in_review_count = mysqli_num_rows($find_in_review_count);

                                ?>
                                    <p class="text1"><a href="Admin_Notes_Under_Reb_Page.php"><?php echo $in_review_count; ?></a></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text2">Numbers of Notes in Review for Publish</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4 box">
                            <div class="row">
                                <div class="col-md-12">
                                <?php

                                    $find_download_count = query("SELECT DISTINCT NoteID FROM downloads WHERE IsAttachementDownloaded = 1 AND AttachementDownloadedDate >= DATE(NOW()) - INTERVAL 7 DAY ");
                                    confirm($find_download_count);

                                    $download_count = mysqli_num_rows($find_download_count);

                                ?>
                                    <p class="text1"><a href="Admin_Downloads_Notes.php"><?php echo $download_count; ?></a></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text2">Numbers of New Notes Downloaded<br>(Last 7 days)</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4 box">
                            <div class="row">
                                <div class="col-md-12">
                                <?php

                                    $find_user_count = query("SELECT ID FROM users WHERE CreatedDate >= DATE(NOW()) - INTERVAL 7 DAY ");
                                    confirm($find_user_count );

                                    $user_count  = mysqli_num_rows($find_user_count );

                                ?>
                                    <p class="text1"><a href="Admin_Members.php"><?php echo $user_count; ?></a></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text2">Numbers of New Registrations<br>(Last 7 days)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="section2">
                <div id="part1">
                    <div class="row">
                        <div class="col-md-4 col-sm-3 col-xs-3">
                            <p>Published Notes</p>
                        </div>
                        <div class="col-md-8 col-sm-9 col-xs-9">
                            <span><img class="search-icon-img" src="./images/Admin/Dashboard/search-icon.png"></span>
                            <input type="text" name="search" id="search" placeholder="Search">
                            <a href=""><button class="btn btn-primary search-btn">SEARCH</button></a>
                            <span><img class="arrow-down-img" src="./images/Admin/Dashboard/down-arrow.png"></span>
                            <input type="text" id="month" name="month" placeholder="Select month">
                        </div>
                    </div>
                </div>
                <div id="part2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                            <table class="table" id="dashboard-table">
                                <thead>
                                    <tr>
                                        <th>SR NO.</th>
                                        <th>TITLE</th>
                                        <th>CATEGORY</th>
                                        <th>ATTACHMENT SIZE</th>
                                        <th>SELL TYPE</th>
                                        <th>PRICE</th>
                                        <th>PUBLISHER</th>
                                        <th>PUBLISHED DATE</th>
                                        <th>NUMBER OF<br> DOWNLOADES</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i=1;
                                        while($row = mysqli_fetch_assoc($select_query)) {

                                            $note_id = $row['ID'];
                                            $note_title = $row['Title'];
                                            $note_cat = $row['Category_Name'];
                                            $ispaid = $row['IsPaid'];
                                            $price = $row['SellingPrice'];
                                            $seller_id = $row['SellerID'];
                                            $db_pub_date = $row['PublishedDate'];

                                            $db_date_timestamp = strtotime($db_pub_date);
                                            $pub_date = date('d-m-Y, H:i', $db_date_timestamp);

                                            //publisher
                                            $find_publisher_info = query("SELECT FirstName, LastName FROM users WHERE ID = '{$seller_id}' ");
                                            confirm($find_publisher_info);

                                            while($row = mysqli_fetch_assoc($find_publisher_info)) {
                                                $publisher = $row['FirstName'] . " " . $row['LastName'];
                                            }

                                            if($ispaid == 0) {
                                                $sell_type = 'Free';
                                            }else {
                                                $sell_type = 'Paid';
                                            }

                                            //downloaded notes count
                                            $downloaded = query("SELECT DISTINCT seller_notes.ID FROM seller_notes LEFT JOIN downloads ON seller_notes.ID = downloads.NoteID WHERE 
                                            downloads.IsAttachementDownloaded = 1 AND NoteID = $note_id");
                                            confirm($downloaded);

                                            $download_count = mysqli_num_rows($downloaded);

                                    ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><a href="Admin_Note_Details.php?Note_id=<?php echo $note_id; ?>"><?php echo $note_title; ?></a></td>
                                    <td><?php echo $note_cat; ?></td>
                                    <td>10 KB</td>
                                    <td><?php echo $sell_type; ?></td>
                                    <td>&#36;<?php echo $price; ?></td>
                                    <td><?php echo $publisher; ?></td>
                                    <td><?php echo $pub_date; ?></td>
                                    <td><a href="Admin_Downloads_Notes.php?download_note_id=<?php echo $note_id;?>"><?php echo $download_count; ?></a></td>
                                    <td>
                                        <div class="admin-menu-popup">
                                            <a class="admin-menu-check" target="#ad<?php echo $i; ?>">
                                                <img class="dots-img" src="./images/Admin/Dashboard/dots.png">
                                            </a>
                                            <div id="ad<?php echo $i; ?>" class="admin-menu-show">
                                                <p><a href="Admin_Dashboard.php?Note_id=<?php echo $note_id; ?>">Download Note</a></p>
                                                <p><a href="Admin_Note_Details.php?Note_id=<?php echo $note_id; ?>">View More Details</a></p>
                                                <p><a href="#" data-title="<?php echo $note_title; ?>"
                                                            data-id="<?php echo $note_id; ?>"
                                                            data-sellerid="<?php echo $seller_id; ?>" 
                                                            id="unpublish" data-toggle="modal"
                                                            data-target="#unpublishPopup">Unpublish</a></p>
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
                                                        <h5 style="color:#6255a5;font-weight:600;font-size:16px;" class="modal-title" id="exampleModalLabel">
                                                            <?php echo $note_title;?></h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="" method="POST">
                                                        <div class="modal-body">
                                                            <input name="noteid_for_unpublish" id="noteid_for_unpublish"
                                                                value="" hidden>
                                                            <input name="notetitle_for_unpublish" id="notetitle_for_unpublish"
                                                                value="" hidden>
                                                            <input name="sellerid_for_unpublish" id="sellerid_for_unpublish"
                                                                value="" hidden>
                                                            <div class="form-group">
                                                                <label for="remark">Remarks*</label>
                                                                <textarea id="remark" class="form-control" name="remark" placeholder="Write remarks" rows="7"
                                                                    required></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" name="unpublish-btn" style="background:#ff3636";
                                                                onclick='javascript:Unpublish($(this));return false;'
                                                                >Unpublish</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancle</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php    
                                    $i++; }
                                    ?>
                                
                            </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard Ends -->

    <script>
                
        function Unpublish() {
            if(confirm("Are you sure you want to Unpublish this note?")) {
                window.location = anchor.attr("href");
            } else {
                txt = "You Pressed Cancel!";
            }
        }

    </script>
<?php include "footer.php";?>