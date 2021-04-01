<?php
include "../includes/db.php";
include "../includes/functions.php";

$note_id = $_GET['Note_id'];

$select_query = query("SELECT * FROM seller_notes WHERE ID = '$note_id' ");
confirm($select_query);


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
    <style>
    </style>

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
                                                <p><a href="#">My Profile</a></p>
                                                <p><a href="">My Downloads</a></p>
                                                <p><a href="#">My Sold Notes</a></p>
                                                <p><a href="#">My Rejected Notes</a></p>
                                                <p><a href="#">Change Password</a></p>
                                                <p><a href="#">LOGOUT</a></p>
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
        <div id="note-details-section1">
            <div class="container">
                <p class="NDS1MH">Notes Details</p>
                <div class="row">
                    <div class="col-md-7 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-md-5 col-sm-5 col-xs-5">
                                <img src="./images/Note-Details/computer-science.png">
                            </div>
                            <div class="col-md-7 col-sm-7 col-xs-7">
                                <p class="NDS1LH">Computer Science</p>
                                <p class="NDS1LT1">Sciences</p>
                                <p class="NDS1LT2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut ab
                                    voluptatem corporis velit facere accusamus cum, quae ducimus, unde reprehenderit
                                    vitae sed veniam esse. Quos nihil fugiat numquam facilis reprehenderit!</p>

                                <?php  
                                while($row = mysqli_fetch_assoc($select_query)) {
                                    $ispaid = $row['IsPaid'];
                                    if($ispaid == 0){ ?>
                                        <a href="download.php?note_pdf=srs"><button class="note-details-page-download-btn">DOWNLOAD</button></a>
                                    <?php
                                    }else { ?>
                                        <a href="download.php?note_pdf=srs"><button class="note-details-page-download-btn" onClick='check()'>DOWNLOAD/$15</button></a>
                                        
                                   <?php 
                                    }
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
                                <p class="NDS1RT2">University of California</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT1">Country:</p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT2">United State</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT1">Course Name:</p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT2">Computer Engineering</P>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT1">Course Code:</p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT2">248705</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT1">Professor:</p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT2">Mr. Richard Brown</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT1">Number of Pages:</p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT2">277</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT1">Approved Date:</p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT2">November 25 2020</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-6">
                                <p class="NDS1RT1">Rating:</p>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-6">
                                <div class="row">

                                    <div class="col-md-6  col-sm-6 col-xs-6">
                                        <div class="Rating">
                                            <img src="./images/Note-Details/star.png" class="Rating-Star">
                                            <img src="./images/Note-Details/star.png" class="Rating-Star">
                                            <img src="./images/Note-Details/star.png" class="Rating-Star">
                                            <img src="./images/Note-Details/star.png" class="Rating-Star">
                                            <img src="./images/Note-Details/star-white.png" class="Rating-Star">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <p class="NDS1RT2">100 Reviews</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6  col-sm-6 col-xs-12">
                                <p class="NDS1RT3">5 Users marked this note as inappropriate</p>
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
                                <iframe src="http://unec.edu.az/application/uploads/2014/12/pdf-sample.pdf">
                                    <p style="font-size: 110%;"><em><strong>ERROR: </strong>
                                            An &#105;frame should be displayed here but your browser version does not
                                            support &#105;frames.</em> Please update your browser to its most recent
                                        version and try again, or access the file <a
                                            href="http://unec.edu.az/application/uploads/2014/12/pdf-sample.pdf">with
                                            this link.</a></p>
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
                                        <div class="col-md-1 col-sm-1 col-xs-1">
                                            <img src="./images/Note-Details/reviewer-1.png">
                                        </div>
                                        <div class="col-md-11 col-sm-11 col-xs-11">
                                            <p class="NDS2RT1">Richard Brown</p>
                                            <div class="Rating">
                                                <img src="./images/Note-Details/star.png" class="Rating-Star">
                                                <img src="./images/Note-Details/star.png" class="Rating-Star">
                                                <img src="./images/Note-Details/star.png" class="Rating-Star">
                                                <img src="./images/Note-Details/star.png" class="Rating-Star">
                                                <img src="./images/Note-Details/star-white.png" class="Rating-Star">
                                            </div>
                                            <p class="NDS2RT2">Lorem ipsum is simply dummy text of the printing and
                                                typesetting industry.
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-md-1 col-sm-1 col-xs-1">
                                            <img src="./images/Note-Details/reviewer-2.png">
                                        </div>
                                        <div class="col-md-11 col-sm-11 col-xs-11">
                                            <p class="NDS2RT1">Alice Ortiaz</p>
                                            <div class="Rating">
                                                <img src="./images/Note-Details/star.png" class="Rating-Star">
                                                <img src="./images/Note-Details/star.png" class="Rating-Star">
                                                <img src="./images/Note-Details/star.png" class="Rating-Star">
                                                <img src="./images/Note-Details/star.png" class="Rating-Star">
                                                <img src="./images/Note-Details/star-white.png" class="Rating-Star">
                                            </div>
                                            <p class="NDS2RT2">Lorem ipsum is simply dummy text of the printing and
                                                typesetting industry.
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-md-1 col-sm-1 col-xs-1">
                                            <img src="./images/Note-Details/reviewer-3.png">
                                        </div>
                                        <div class="col-md-11 col-sm-11 col-xs-11">
                                            <p class="NDS2RT1">Sara Passmore</p>
                                            <div class="Rating">
                                                <img src="./images/Note-Details/star.png" class="Rating-Star">
                                                <img src="./images/Note-Details/star.png" class="Rating-Star">
                                                <img src="./images/Note-Details/star.png" class="Rating-Star">
                                                <img src="./images/Note-Details/star.png" class="Rating-Star">
                                                <img src="./images/Note-Details/star-white.png" class="Rating-Star">
                                            </div>
                                            <p class="NDS2RT2">Lorem ipsum is simply dummy text of the printing and
                                                typesetting industry.
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
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