<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();

    

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
                                <p class="text1"><a
                                        href="Admin_Notes_Under_Reb_Page.php"><?php echo $in_review_count; ?></a></p>
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
                                <p class="text1"><a href="Admin_Downloads_Notes.php"><?php echo $download_count; ?></a>
                                </p>
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
                        <button type="submit" name="search-btn" onclick="showdata()"
                            class="btn btn-primary search-btn">SEARCH</button>

                        <span><img class="arrow-down-img" src="./images/Admin/Dashboard/down-arrow.png"></span>
                        <select style="width:200px;" id="month" name="month" onchange="showdata()">
                            <option value="0" selected>Select month</option>
                            <?php 
                               for($i = 0; $i<=5; $i++) {
                                    $month = date('M Y', strtotime('last day of' . -$i . 'month'));
                                    $date  = date('Y-m', strtotime('last day of' . -$i . 'month'));
                                ?>
                            <option value="<?php echo $date; ?>"><?php echo $month; ?></option>
                            <?php }
                                ?>
                        </select>
                    </div>
                </div>
            </div>

            <div id="result">
            
            
            </div>
        </div>
        </div>
</div>
        
        <!-- Dashboard Ends -->

        <script>
            function Unpublish() {
                if (confirm("Are you sure you want to Unpublish this note?")) {
                    window.location = anchor.attr("href");
                } else {
                    txt = "You Pressed Cancel!";
                }
            }
        </script>

        <!-- Footer -->
        <footer class="admin-footer">
            <hr>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="footer-text-left">Version : 1.1.24</p>
                    </div>
                    <div class="col-md-6">
                        <p class="footer-text-right">
                            Copyright &copy; TatvaSoft All rights reserved.
                        </p>
                    </div>

                </div>
            </div>

        </footer>
        <!-- Footer Ends -->

        <!-- JQuery -->
        <script src="js/jquery-3.5.1.min.js"></script>


        <script type="text/javascript">
            function showdata(page_current) {
                let search_month = $("#month").val();
                let search_result = $("#search").val();

                $.ajax({
                    url: "Admin_Dashboard_Ajax.php",
                    method: "GET",
                    data: {
                        selected_month: search_month,
                        selected_search: search_result
                    },
                    success: function (search_data) {
                        $("#result").html(search_data);
                    }
                });
            }
            $(function () {
                showdata(1);
            });
        </script>


        <!-- Bootstrap JS -->
        <script src="js/bootstrap/bootstrap.min.js"></script>

        <!-- Datatables JS -->
        <script src="js/datatables.js"></script>

        </body>

        </html>