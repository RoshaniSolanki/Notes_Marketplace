<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();

if(isset($_SESSION['email'])) {
    $user_id = $_SESSION['userid'];



if(isset($_POST['search-btn'])) {

    $search_result = $_POST['search'];
    
    $select_query = query("SELECT downloads.* , users.EmailID FROM downloads LEFT JOIN users ON downloads.Downloader=users.ID 
    WHERE (downloads.NoteTitle LIKE '%$search_result%' OR downloads.NoteCategory LIKE '%$search_result%' OR downloads.PurchasedPrice LIKE '%$search_result%')
     AND downloads.Downloader=$user_id AND IsSellerHasAllowedDownload = 1 AND AttachementPath IS NOT NULL ORDER BY downloads.AttachementDownloadedDate DESC");
    confirm($select_query);

}else {

    $select_query = query("SELECT downloads.* , users.EmailID FROM downloads LEFT JOIN users ON downloads.Downloader=users.ID 
    WHERE downloads.Downloader=$user_id AND IsSellerHasAllowedDownload = 1 AND AttachementPath IS NOT NULL ORDER BY downloads.AttachementDownloadedDate DESC");
    confirm($select_query);

}

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


if(isset($_POST['rating_submit_btn'])) {

    $comments      = $_POST['comments'];
	$downloaded_id = $_POST['review_downloadedid'];
	$note_id       = $_POST['review_noteid'];
    $rating       = $_POST['starrating'];
    $createdDate = date("Y-m-d H:i:s");
    $modifiedDate = date("Y-m-d H:i:s");

    $insert_rate  = query("INSERT INTO seller_notes_review(NoteID, ReviewedByID, AgainstDownloadsID, Ratings, Comments, CreatedDate, CreatedBy,	ModifiedDate, ModifiedBy)
                    VALUES('{$note_id}', '{$user_id}', '{$downloaded_id}', '{$rating}', '{$comments}', '{$createdDate}', '{$user_id}', '{$modifiedDate}', '{$user_id}')");
    confirm($insert_rate);

}


    if(isset($_POST['report'])) {
        
        $noteID = $_POST['noteid_for_report'];
        $noteTitle = $_POST['title_for_report'];
        $noteDownloadid = $_POST['downloadedid_for_report'];
        $remark = $_POST['remark'];

         $createdDate = date("Y-m-d H:i:s");
         $modifiedDate = date("Y-m-d H:i:s");

         $insert_remark = query("INSERT INTO seller_notes_reported_issues(NoteID, ReportedByID, AgainstDownloadID, Remarks, CreatedDate, CreatedBy,	ModifiedDate, ModifiedBy)
         VALUES('{$noteID}', '{$user_id}', '{$noteDownloadid}', '{$remark}', '{$createdDate}', '{$user_id}', '{$modifiedDate}', '{$user_id}')");
         confirm($insert_remark);

         // find MemberName
         $find_member_name = query("SELECT FirstName, LastName FROM users WHERE ID = '{$user_id}' ");
         confirm($find_member_name);

         while($mr = mysqli_fetch_assoc($find_member_name)) {
             $member_name = $mr['FirstName'] . " " .$mr['LastName']; 
         }

         //find seller information
         $find_seller_id = query("SELECT SellerID FROM seller_notes WHERE ID = '{$noteID}' ");
         confirm($find_seller_id);

         while($sr = mysqli_fetch_assoc($find_seller_id)) {
             $seller_id = $sr['SellerID']; 
         }

         $find_seller_info = query("SELECT FirstName, LastName, EmailID FROM users WHERE ID = '{$seller_id}' ");
         confirm($find_seller_info);

         while($sr = mysqli_fetch_assoc($find_seller_info)) {
             $seller_name = $sr['FirstName'] . " " .$sr['LastName']; 
             $seller_email = $sr['EmailID'];
         }
        
        
        $subject = $member_name." Reported an issue for ". $noteTitle;
        $email = "sroshani025@gmail.com";
        $body = "Hello Admins, "."\r\n"."\r\n"."We want to inform you that, " .$member_name. "  Reported an issue for"." ".$seller_name."’s Note with title " . $noteTitle ." . "."Please look at the notes and take required actions.". "\r\n"."\r\n"."Regards,"."\r\n". "Notes Marketplace";
        $sender_email = "Email From: {$email}";
        $result = mail($seller_email, $subject, $body, $sender_email);
             
            if(!$result) {
                echo "<script>alert('Email sending failed....')</script>";
            }
    }

}else {
    redirect("Login.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0 ,user-scalable=no">

    <title>Document</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Datatables -->
    <link rel="stylesheet" href="css/datatables.css">

    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">

</head>

<body>
    <!-- Header -->

    <header>
        <nav class="navbar navbar-fixed-top">
            <div class="container-fluid">
                <div class="site-nav-wrapper">

                    <div class="navbar-header">

                        <!-- Mobile Menu Open Button -->
                        <span id="mobile-nav-open-btn">&#9776;</span>

                        <!-- Logo -->
                        <a class="navbar-brand" href="Home_Page.php">
                            <img src="images/home/logo.png" alt="logo">
                        </a>
                    </div>

                    <!-- Main Menu -->
                    <div class="container">
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav pull-right">
                                <li><a href="Search_Notes_Page.php">Search Notes</a></li>
                                <li><a href="Dashboard.php">Sell Your Notes</a></li>
                                <li><a href="Buyer_Requests.php">Buyer Requests</a></li>
                                <li><a href="FAQ.php">FAQ</a></li>
                                <li><a href="Contact_Us.php">Contact Us</a></li>
                                <li>
                                    <div class="user-menu-popup">
                                        <a class="user-menu-check" target=".user-menu-show"><img class="user-img"
                                                src="images/User-Profile/user-img.png" width="40" height="40"
                                                alt=""></a>
                                        <div class="user-menu-show">
                                            <p><a href="User_Profile.php">My Profile</a></p>
                                            <p><a href="My_Downloads.php">My Downloads</a></p>
                                            <p><a href="My_Sold_Notes.php">My Sold Notes</a></p>
                                            <p><a href="My_Rejected_Notes.php">My Rejected Notes</a></p>
                                            <p><a href="Change_Password_Page.php">Change Password</a></p>
                                            <p><a href="Logout.php">LOGOUT</a></p>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="Logout.html">
                                        <button class="btn btn-primary logout-btn">Logout</button>
                                    </a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Mobile Menu -->
                    <div id="mobile-nav">

                        <!-- Logo -->
                        <a href="Home_Page.html">
                            <img class="logo" src="images/home/logo.png" alt="logo">
                        </a>

                        <!-- Mobile Menu close Button -->
                        <span id="mobile-nav-close-btn">&times;</span>

                        <div id="mobile-nav-content">
                            <ul class="nav">
                                <li>
                                    <a href="Search_Notes_Page.html">Search Notes</a>
                                </li>
                                <li>
                                    <a href="My_Sold_Notes.html">Sell Your Notes</a>
                                </li>
                                <li><a href="Buyer_Requests.html">Buyer Requests</a></li>
                                <li>
                                    <a href="FAQ.html">FAQ</a>
                                </li>

                                <li>
                                    <a href="Contact_Us.html">Contact Us</a>
                                </li>
                                <li><a href="#"><img class="user-img" src="images/User-Profile/user-img.png" width="40"
                                            height="40" alt=""></a></li>
                                <li>
                                    <a href="Login.html">
                                        <button class="btn btn-primary logout-btn">Logout</button>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- Header Ends -->


    <!-- My Downloades -->
    <div id="myDownloads">
        <div class="container">
            
                <div id="part1">
                    <div class="row">
                        <div class="col-md-5 col-sm-4 col-xs-4">
                            <p>My Downloads</p>
                        </div>
                        <div class="col-md-7 col-sm-8 col-xs-8">
                        <form action="" method="POST">
                            <span><img class="my-downloads-search-icon-img"
                                    src="./images/My_Download/search-icon.png"></span>
                            <input type="text" name="search" id="search" placeholder="Search">
                            <button type="submit" name="search-btn"
                                class="btn btn-primary my-downloads-search-btn">SEARCH</button>
                        </form>
                        </div>
                    </div>
                </div>
                <div id="part2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table" id="my-downloads-table">
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

                                        $id            = $buyer_row['ID'];
                                        $note_id       = $buyer_row['NoteID'];
                                        $ispaid        = $buyer_row['IsPaid'];
                                        $price         = $buyer_row['PurchasedPrice'];
                                        $note_title    = $buyer_row['NoteTitle'];
                                        $note_category = $buyer_row['NoteCategory'];
                                        $downloader    = $buyer_row['Downloader'];
                                        $email         = $buyer_row['EmailID'];

                                        $db_download_date = $buyer_row['AttachementDownloadedDate'];
                                        $db_download_date_timestamp = strtotime($db_download_date);
                                        $download_date = date('d M Y, H:i:s', $db_download_date_timestamp); 

                                        if($ispaid == 0) {
                                            $sell_type = 'Free';
                                            $price =0;
                                        }else {
                                            $sell_type = 'Paid';
                                        }
                                ?>
                                        <tr>
                                            
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $note_title; ?></td>
                                            <td><?php echo $note_category; ?></td>
                                            <td><?php echo $email; ?></td>
                                            <td><?php echo $sell_type; ?></td>
                                            <td>&#36;<?php echo $price; ?></td>
                                            <td><?php echo $download_date; ?></td>
                                            <td><a href="Note_Details_Page.php?Note_id=<?php echo $note_id; ?>"><img
                                                        class="eye-img" src="./images/My_Download/eye.png"></a>
                                                <div class="menu-popup">
                                                    <a class="menu-check" target="#mp<?php echo $i;?>"><img
                                                            class="dots-img" src="./images/My_Download/dots.png"></a>
                                                    <div id="mp<?php echo $i;?>" class="menu-popup-show">
                                                        <p><a href="My_Downloads.php?Note_id=<?php echo $note_id; ?>">Download
                                                                Notes</a></p>
                                                        <p><a class="add-review-popup-click"
                                                                data-id="<?php echo $note_id; ?>"
                                                                data-download="<?php echo $id; ?>" id="add-review-star" data-toggle="modal"
                                                                data-target="#addReviewPopup">Add Reviews/Feedback</a>
                                                        </p>
                                                        <p><a href="#" data-title="<?php echo $note_title; ?>"
                                                                data-id="<?php echo $note_id; ?>"
                                                                data-download="<?php echo $id; ?>"
                                                                id="report-as-inappropriate" data-toggle="modal"
                                                                data-target="#reportAsInappropriate">Reports as
                                                                Inappropriate</a></p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <?php  
                                $i++;?>


                                        <!-- Add Review Popup -->
                                        <div class="modal" style="top:50%;transform: translateY(-50%);"
                                            id="addReviewPopup" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title add-review" id="exampleModalLabel"> Add
                                                            Review</h5>
                                                        <button type="button" class="close" id="add-review-close-btn"
                                                            data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="" method="post">
                                                        <div class="modal-body">

                                                            <div class="stars">
                                                                <input type="hidden" id="star1_hidden" value="1">
                                                                <img src="images/My_Download/star-white.png"
                                                                    onmouseover="change(this.id);" id="star1" class="star">
                                                                <input type="hidden" id="star2_hidden" value="2">
                                                                <img src="images/My_Download/star-white.png"
                                                                    onmouseover="change(this.id);" id="star2" class="star">
                                                                <input type="hidden" id="star3_hidden" value="3">
                                                                <img src="images/My_Download/star-white.png"
                                                                    onmouseover="change(this.id);" id="star3" class="star">
                                                                <input type="hidden" id="star4_hidden" value="4">
                                                                <img src="images/My_Download/star-white.png"
                                                                    onmouseover="change(this.id);" id="star4" class="star">
                                                                <input type="hidden" id="star5_hidden" value="5">
                                                                <img src="images/My_Download/star-white.png"
                                                                    onmouseover="change(this.id);" id="star5" class="star">
                                                                <input type="hidden" name="starrating" id="starrating">
                                                            </div>
                                                            <input name="review_noteid" id="review_noteid"
                                                                value="" hidden>
                                                            <input name="review_downloadedid"
                                                                id="review_downloadedid" value="" hidden>
                                                            <div class="comments_form">
                                                                <div class="form-group">
                                                                    <label class="commentsLabel">Comments *</label>
                                                                    <input type="text" id="comments" name="comments"
                                                                        class="form-control" placeholder="Comments..."
                                                                        required>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" name="rating_submit_btn"
                                                                        class="btn btn-primary add-review-popup-submit-btn pull-left"
                                                                        id="modal-btn">SUBMIT</button>
                                                                </div>
                                                            </div>
                                                        </div>    
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Add Review Popup Ends -->

                                        <!-- Reports as Inappropriate Pop up -->

                                        <div class="modal" id="reportAsInappropriate" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            <?php echo $note_title;?></h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="" method="POST">
                                                        <div class="modal-body">
                                                            <input name="title_for_report" id="title_for_report"
                                                                value="" hidden>
                                                            <input name="noteid_for_report" id="noteid_for_report"
                                                                value="" hidden>
                                                            <input name="downloadedid_for_report"
                                                                id="downloadedid_for_report" value="" hidden>
                                                            <div class="form-group">
                                                                <label for="remark">Remarks*</label>
                                                                <textarea id="remark" class="form-control" name="remark"
                                                                    required></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancle</button>
                                                            <button type="submit" class="btn btn-primary" name="report"
                                                                onclick='javascript:Report($(this));return false;'
                                                                >Report an issue</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
            </div>
            
        </div>
    </div>

    <script>
        
                
        function Report() {
            if(confirm("Are you sure you want to mark this report as spam, you cannot update it later?")) {
                window.location = anchor.attr("href");
            } else {
                txt = "You Pressed Cancel!";
            }
        }

        function change(id) {
            var cname=document.getElementById(id).className;
            var ab=document.getElementById(id+"_hidden").value;
            document.getElementById(cname+"rating").value=ab;

            for(var i=ab;i>=1;i--)
            {
                document.getElementById(cname+i).src="images/My_Download/star.png";
                
            }
            var id = parseInt(ab) + 1;
            for (var j = id; j <= 5; j++) {
                document.getElementById(cname + j).src = "images/My_Download/star-white.png";
            }
        }

</script>

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
                        <li><a href="#"><img src="images/My_Download/facebook.png"></a></li>
                        <li><a href="#"><img src="images/My_Download/twitter.png"></a></li>
                        <li><a href="#"><img src="images/My_Download/linkedin.png"></a></li>
                    </ul>
                </div>
            </div>
        </div>

    </footer>
    <!-- Footer Ends -->

    <!-- JQuery -->
    <script src="js/jquery-3.5.1.min.js"></script>

    <!--script src="js/bootstrap/bootstrap.bundle.min.js"></script-->

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>



    <script src="js/datatables.js"></script>
    
    <script>

        

        $(function () {


            $(document).on("click", "#add-review-star", function () {
                $('#review_noteid').val($(this).data('id'));
                $('#review_downloadedid').val($(this).data('download'));
                $('#addReviewPopup').modal('show');
            });

            $(document).on("click", "#report-as-inappropriate", function () {
                $("#title_for_report").val($(this).data('title'));
                $("#noteid_for_report").val($(this).data('id'));
                $("#downloadedid_for_report").val($(this).data('download'));
                $("#reportAsInappropriate").modal('show');

            });

        });

        
    </script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>


</body>

</html>
