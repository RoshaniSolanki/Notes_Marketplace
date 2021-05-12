<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();

if(isset($_GET['Note_id'])) {
    $note_id = $_GET['Note_id'];
}
if(isset($_SESSION['email'])) {
    //$email = $_SESSION['email'];
    $buyer_id = $_SESSION['userid'];
    $buyer_full_name = $_SESSION['firstname'] ." ". $_SESSION['lastname'];
        
    $select_query = query("SELECT * FROM seller_notes WHERE ID = '$note_id' ");
    confirm($select_query);

    while($r = mysqli_fetch_assoc($select_query)) {
        $seller_id = $r['SellerID'];
        $note_title = $r['Title'];
        $note_cat_id = $r['Category'];
        $price = $r['SellingPrice'];
    }

    $find_category_name = query("SELECT Category_Name FROM note_categories WHERE ID = '{$note_cat_id}' ");
    confirm($find_category_name);

    while($cr = mysqli_fetch_assoc($find_category_name)) {
        $category = $cr['Category_Name'];
    }

    $find_download_entry = query("SELECT ID FROM downloads WHERE NoteID = '{$note_id}' AND Downloader = '{$buyer_id}' ");
    confirm($find_download_entry);

    $download_entry_count = mysqli_num_rows($find_download_entry);

}

if(isset($_POST['single_attachement'])) {

    $find_file_path = query("SELECT FilePath FROM seller_notes_attachements WHERE NoteID = '{$note_id}' ");
    confirm($find_file_path);
    while($ar = mysqli_fetch_assoc($find_file_path)){

        $file_path = $ar['FilePath'];

    }

    header('Cache-Control: public');
    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename=' . $file_path. '.pdf');
    header('Content-Type: application/pdf');
    header('Content-Transfer-Encoding:binary');
    @readfile($file_path);

    $date = date("Y-m-d H:i:s");

    if($download_entry_count == 0 && $seller_id != $buyer_id) {

        $download_insert = query("INSERT INTO 
        downloads(NoteID, Seller, Downloader, IsSellerHasAllowedDownload, AttachementPath, IsAttachementDownloaded, AttachementDownloadedDate,IsPaid,	
        PurchasedPrice,	NoteTitle,	NoteCategory, CreatedDate,	CreatedBy,	ModifiedDate, ModifiedBy)
        VALUES('{$note_id}', '{$seller_id}', '{$buyer_id}', 1, '{$file_path}', 1, '{$date}', 0, NULL, '{$note_title}', '{$category}',
        '{$date}', '{$buyer_id}', '{$date}', '{$buyer_id}') ");
        confirm($download_insert);
    }
}

if(isset($_POST['multiple_attachement'])) {

    $find_title = query("SELECT DISTINCT Title FROM seller_notes WHERE ID = '{$note_id}' ");
    confirm($find_title);

    while($tr = mysqli_fetch_assoc($find_title)) {
        $title = $tr['Title'];
    }
    $zipname = $title . '.zip';
    $zip = new ZipArchive;
    $zip->open($zipname, ZipArchive::CREATE);
    $path_query = query("SELECT FilePath FROM seller_notes_attachements WHERE NoteID = '{$note_id}' ");
    confirm($path_query);
    while($path_row = mysqli_fetch_assoc($path_query)){
        $attact_id = $path_row['FilePath'];
        $zip->addFile($attact_id);
    }
    $zip->close();
    header('Content-Type: application/zip');
    header('Content-disposition: attachment; filename=' . $zipname);
    header('Content-Length: ' . filesize($zipname));
    readfile($zipname);

    $date = date("Y-m-d H:i:s");

    if($download_entry_count == 0 && $seller_id != $buyer_id) {

        $get_file_path = query("SELECT FilePath FROM seller_notes_attachements WHERE NoteID = '{$note_id}' ");
        confirm($get_file_path);
        while($get_path_row = mysqli_fetch_assoc($get_file_path)){
            $file_path = $get_path_row['FilePath'];
        

        $download_insert = query("INSERT INTO 
        downloads(NoteID, Seller, Downloader, IsSellerHasAllowedDownload, AttachementPath, IsAttachementDownloaded, AttachementDownloadedDate,IsPaid,	
        PurchasedPrice,	NoteTitle,	NoteCategory, CreatedDate,	CreatedBy,	ModifiedDate, ModifiedBy)
        VALUES('{$note_id}', '{$seller_id}', '{$buyer_id}', 1, '{$file_path}', 1, '{$date}', 0, NULL, '{$note_title}', '{$category}',
        '{$date}', '{$buyer_id}', '{$date}', '{$buyer_id}') ");
        confirm($download_insert);

        }
    }
}
if(isset($_POST['confirm-yes-btn'])) {
    

    
    if($download_entry_count == 0 && $seller_id != $buyer_id) {

        /*$get_file_path = query("SELECT FilePath FROM seller_notes_attachements WHERE NoteID = '{$note_id}' ");
        confirm($get_file_path);
        while($get_path_row = mysqli_fetch_assoc($get_file_path)){
            $file_path = $get_path_row['FilePath'];
        */
        $date = date("Y-m-d H:i:s");
        $download_insert = query("INSERT INTO 
        downloads(NoteID, Seller, Downloader, IsSellerHasAllowedDownload, AttachementPath, IsAttachementDownloaded, AttachementDownloadedDate,IsPaid,	
        PurchasedPrice,	NoteTitle,	NoteCategory, CreatedDate,	CreatedBy,	ModifiedDate, ModifiedBy)
        VALUES('{$note_id}', '{$seller_id}', '{$buyer_id}', 0, NULL, 0, '{$date}', 1, '{$price}', '{$note_title}', '{$category}',
        '{$date}', '{$buyer_id}', '{$date}', '{$buyer_id}') ");
        confirm($download_insert); 
        if($download_insert) {
            echo "<script>alert('Inserted Successfully');</script>";
        }

    // }
    }
            /* send email to seller */
           $find_seller_email = query("SELECT EmailID, FirstName, LastName FROM users WHERE ID = '{$seller_id}' ");
            confirm($find_seller_email);

            while($er = mysqli_fetch_assoc($find_seller_email)){

                $seller_email = $er['EmailID'];
                $seller_full_name = $er['FirstName']. " " .$er['LastName']; 

            }
            $subject = "Buyer wants to purchase your notes";
            $email = "sroshani025@gmail.com";
            $body = "Hello ".$seller_full_name.","."\r\n"."\r\n"."We would like to inform you that, <Buyer name> wants to purchase your notes. Please see Buyer Requests tab and allow download access to Buyer if you have received the payment from him. " ."\r\n"."\r\n"."Regards,"."\r\n". "Notes Marketplace";
            $sender_email = "Email From: {$email}";
         
            $result = mail($seller_email, $subject, $body, $sender_email);
            if(!$result) {
                   echo "<script>alert('sending fails...........');</script>";                             
            }

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

    <!-- Font Awesome CSS -->
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css">

    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
 



</head>

<body>
    <section id="note-details-page">
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
                                        <a href="Search_Notes_Page.php">Search Notes</a>
                                    </li>
                                    <li>
                                        <a href="Dashboard.php">Sell Your Notes</a>
                                    </li>
                                    <li><a href="Buyer_Requests.php">Buyer Requests</a></li>
                                    <li>
                                        <a href="FAQ.php">FAQ</a>
                                    </li>

                                    <li>
                                        <a href="Contact_Us.php">Contact Us</a>
                                    </li>
                                    <li><a href="#"><img class="user-img" src="images/User-Profile/user-img.png"
                                                width="40" height="40" alt=""></a></li>
                                    <li>
                                        <a href="">
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
        <!-- Note Details -->
        <form action="" method="post"> 
            <!-- Confirm Box For Paid Note -->
            <div class="modal" id="confirm-box" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <h5>Are you sure you want to download this Paid note. Please confirm.</h5>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary"  name="confirm-yes-btn" id="confirm-yes">Yes</button>
                </div>
                </div>
            </div>
            </div>
        </form>
        <div id="note-details-section1">
            <div class="container">
                <p class="NDS1MH">Notes Details</p>
                <div class="row">
                    <div class="col-md-7 col-sm-12 col-xs-12">
                        <div class="row">
                            <?php 
                            $select_query = query("SELECT * FROM seller_notes WHERE ID = '$note_id' ");
                            confirm($select_query);
                            while($row = mysqli_fetch_assoc($select_query)) {
                                $ispaid       = $row['IsPaid'];
                                $title        = $row['Title'];
                                $description  = $row['Description'];
                                $price        = $row['SellingPrice'];
                                $category_id  = $row['Category'];
                                $university   = $row['UniversityName'];
                                $country_id   = $row['Country'];
                                $course_name  = $row['Course'];
                                $course_code  = $row['CourseCode'];
                                $professor    = $row['Professor'];
                                $no_of_pages  = $row['NumberOfPages'];
                                $approve_date = $row['PublishedDate'];
                                $note_preview = $row['NotesPreview'];
                                $display_picture = $row['DisplayPicture'];
                            
                            $get_cat = query("SELECT Category_Name FROM note_categories WHERE ID = '$category_id' ");
                            confirm($get_cat);
                            while($crow = mysqli_fetch_assoc($get_cat)) {
                                $category = $crow['Category_Name'];
                            }

                            $get_country = query("SELECT Country_Name FROM countries WHERE ID = '$country_id' ");
                            confirm($get_country);
                            while($country_row = mysqli_fetch_assoc($get_country)) {
                                $country = $country_row['Country_Name'];
                            }

                            ?>
                            <div class="col-md-5 col-sm-5 col-xs-5">
                                <img src="<?php echo $display_picture; ?>" alt="note-display-picture">
                            </div>
                            <div class="col-md-7 col-sm-7 col-xs-7">
                                <p class="NDS1LH"><?php echo $title; ?></p>
                                <p class="NDS1LT1"><?php echo $category; ?></p>
                                <p class="NDS1LT2"><?php echo $description; ?></p>

                            <?php  
                            if(isset($_SESSION['email'])){     
                                if($ispaid == 0){

                                    $find_attachement_count = query("SELECT NoteID FROM seller_notes_attachements WHERE NoteID = '{$note_id}' ");
                                    confirm($find_attachement_count); 
                                    $count = mysqli_num_rows($find_attachement_count);
                                    if($count == 1){ ?>
                                        <form action="" method="post">
                                            <button class="note-details-page-download-btn" name="single_attachement">DOWNLOAD</button>
                                        </form>
                                   <?php }
                                    if($count>1) { ?>
                                        <form action="" method="post">
                                            <button class="note-details-page-download-btn" name="multiple_attachement">DOWNLOAD</button>
                                        </form>
                                   <?php }
                                
                                } else { ?>
                                        <!--a href="download.php?note_pdf=srs"><button class="note-details-page-download-btn" onClick="return confirm('Are you sure you want to download this Paid note. Please confirm.')">DOWNLOAD/$15</button></a-->
                                        <button class="note-details-page-download-btn" data-toggle="modal" data-target="#confirm-box">DOWNLOAD/&#36;<?php echo $price; ?></button>
                                   <?php 
                                    }
                            }else {?>
                                <button type='submit' class="note-details-page-download-btn" href='Login.php'>DOWNLOAD</button>
                            <?php 
                            } 
                            ?>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-12 col-xs-12">
                        <div class="row"> 
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT1">Institution:</p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT2"><?php echo $university; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT1">Country:</p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT2"><?php echo $country; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT1">Course Name:</p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT2"><?php echo $course_name; ?></P>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT1">Course Code:</p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT2"><?php echo $course_code; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT1">Professor:</p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT2"><?php echo $professor; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT1">Number of Pages:</p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT2"><?php echo $no_of_pages; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT1">Approved Date:</p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT2"><?php echo $approve_date; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-6">
                                <p class="NDS1RT1">Rating:</p>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-6">
                                <div class="row">
                                    <?php 
                                     $find_rating = query("SELECT AVG(Ratings) as rating FROM seller_notes_review WHERE NoteID = '{$note_id}' ");
                                     confirm($find_rating);
 
                                     $find_rating_count = query("SELECT ID FROM seller_notes_review WHERE NoteID = '{$note_id}' ");
                                     confirm($find_rating_count);
 
                                     $review_count = mysqli_num_rows($find_rating_count);
 
                                     while($row = mysqli_fetch_assoc($find_rating)) {
                                         $avg_rating = $row['rating'];
                                     }
 
                                    ?>
                                    <div class="col-md-6  col-sm-6 col-xs-6">
                                        <div class="Rating">
                                            <?php 
                                                for($i=1;$i<=$avg_rating;$i++) {?>
                                                    <img src="./images/Note-Details/star.png" class="Rating-Star">
                                            <?php    } 
                                                for($i=1;$i<=(5-$avg_rating);$i++) { ?>
                                                    <img src="./images/Note-Details/star-white.png" class="Rating-Star">
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p class="NDS1RT2"><?php echo $review_count; ?> Reviews</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6  col-sm-6 col-xs-12">
                                <?php 
                                $find_user_count = query("SELECT DISTINCT ReportedByID FROM seller_notes_reported_issues WHERE NoteID = '{$note_id}' ");
                                confirm($find_user_count);

                                $user_count = mysqli_num_rows($find_user_count);

                                if($user_count){?>
                                    <p class="NDS1RT3"><?php  echo $user_count; ?> Users marked this note as inappropriate</p>
                               <?php }
                                ?>
                                
                            </div>
                                  
                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
        </div>
        <div class="container">
            <hr>
        </div>
        <div id="note-details-section2">
            <div class="container">
                <div class="row">

                    <div class="col-md-6 col-sm-12">
                        <p class="NDS2LMH">Notes Preview</p>
                        <div id="Iframe-Cicis-Menu-To-Go"
                            class="set-margin-cicis-menu-to-go set-padding-cicis-menu-to-go set-border-cicis-menu-to-go set-box-shadow-cicis-menu-to-go center-block-horiz">
                            <div class="responsive-wrapper 
                               responsive-wrapper-padding-bottom-90pct"
                                style="-webkit-overflow-scrolling: touch; overflow: auto;">
                                <iframe src="<?php echo $note_preview; ?>">
                                    
                                </iframe> 
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-12">
                        <p class="NDS2RMH">Customer Reviews</p>
                        <div class="NDS2RC">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="row">
                                    <?php 
                                        $find_cutomers_review = query("SELECT Comments, Ratings, users.FirstName, users.LastName, user_profile.ProfilePicture FROM seller_notes_review LEFT JOIN 
                                        users ON seller_notes_review.ReviewedByID = users.ID LEFT JOIN user_profile ON user_profile.UserID = users.ID WHERE 
                                        seller_notes_review.NoteID = '{$note_id}' ");
                                        confirm($find_cutomers_review);

                                        while($row = mysqli_fetch_assoc($find_cutomers_review)) {
                                            $rating = $row['Ratings'];
                                            $comments= $row['Comments'];
                                            $name = $row['FirstName']. " " . $row['LastName'];
                                            $pro_pic = $row['ProfilePicture'];
                                        
                                        ?>
                                    <div class="col-md-1 col-sm-1 col-xs-1">
                                            <img src="<?php echo $pro_pic; ?>">
                                        </div>
                                        <div class="col-md-11 col-sm-11 col-xs-11">
                                            <p class="NDS2RT1"><?php echo $name; ?></p>
                                            <div class="Rating">
                                            <?php
                                                for($i=1;$i<=$rating;$i++) {?>
                                                <img src="./images/search-page/star.png" class="Rating-Star">
                                                <?php    } 
                                                for($i=1;$i<=(5-$rating);$i++) { ?>
                                                <img src="./images/search-page/star-white.png" class="Rating-Star">
                                                <?php }?>
                                            </div>
                                            <p class="NDS2RT2"><?php echo $comments; ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            <?php } } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Note Details ends -->

        <!-- Thank you Popup -->
        <div id="thank-you-popup1">
            <div id="thank-you-popup2">
                <div class="close-btn">
                    <img src="./images/Note-Details/close.png">
                </div>
                <div class="right-click-icon">
                    <i class="fa fa-check-circle"></i>
                </div>
                <div class="heading">
                    <p>Thank you for purchasing!</p>
                </div>
                <div class="text">
                    <p>Dear Smith,</p>
                    <p>As this is paid notes - you need to pay to seller Rahil Shah offline. We will send him an email
                        that you want to download this note. He may contact you further for payment process completion.
                    </p>
                    <p>In case, you have urgency,<br>Please contact us on +9195377345959.</p>
                    <p>Once he receives the payment and acknowledge us - selected notes you can see over my downloads
                        tab
                        for
                        download.</p>
                    <p>Have a good day.</p>
                </div>
            </div>
        </div>
        <!-- Thank you Popup ends -->
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
                            <li><a href="#"><img src="images/Note-Details/facebook.png"></a></li>
                            <li><a href="#"><img src="images/Note-Details/twitter.png"></a></li>
                            <li><a href="#"><img src="images/Note-Details/linkedin.png"></a></li>
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

        <!-- Custom JS -->
        <script src="js/script.js"></script>

    </section>
</body>

</html>
   
<script>
/*
$(function () {
$('#confirm-yes').click(function(){
    $('#thank-you-popup1').show();
    setTimeout(function() {
      $( "#thank-you-popup1" ).hide();
    }, 2000);
    
});
});*/
</script>  