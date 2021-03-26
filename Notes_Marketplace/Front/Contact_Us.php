<?php 
 include "../includes/db.php";
 include "../includes/functions.php"; 
 session_start(); 
 
 if($_SESSION['roleid']==3) {
   // echo "<script>alert('USER')</script>";
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $full_name = $firstname . ' ' . $lastname;
    $email = $_SESSION['email'];
}
    

 if(isset($_POST['submit'])) {
    if($_SESSION['roleid']!=3) {
    $full_name = $_POST['full-name'];
    $email = $_POST['email-address'];
    }
    $subject = $_POST['subject'];
    $comments = $_POST['comments'];

 
    $subject = $full_name." - Query";
    $email_to = "sroshani025@gmail.com";
    $body = "Hello, "."\r\n"."\r\n".$comments."\r\n"."\r\n"."Regards,"."\r\n". $full_name;
    $sender_email = "Email From: {$email}";
         
    $result = mail($email_to, $subject, $body, $sender_email);
         
    if(!$result) {
        //$_SESSION['msg'] ="Email sending failed....";
        echo "<script>alert('Email sending failed....')</script>";
    }else {
        redirect("Contact_Us.php");
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


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css">

    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
</head>

<body>
    <section id="contact-us-page">
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
                                <li><a href="Search_Notes_Page.html">Search Notes</a></li>
                                <li><a href="My_Sold_Notes.html">Sell Your Notes</a></li>
                                <li><a href="FAQ.html">FAQ</a></li>
                                <li><a href="Contact_Us.html">Contact Us</a></li>
                                <li><a href="Login.html">
                                        <button class="btn btn-primary login-btn">Login</button>
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
                                <li>
                                    <a href="FAQ.html">FAQ</a>
                                </li>

                                <li>
                                    <a href="Contact_Us.html">Contact Us</a>
                                </li>
                                <li>
                                    <a href="Login.html">
                                        <button class="btn btn-primary login-btn">Login</button>
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
    <!-- Contact Us -->
    <div id="contactUs">
        <div class="contact-us-img">
            <img src="images/Contact_Us/banner-with-overlay.jpg">
            <div class="contact-us-img-text">Contact Us</div>
        </div>
        <form action="Contact_Us.php" method="POST">
            <div class="container">
                <h1>Get in Touch</h1>
                <p>Let us know how to get back to you</p>

                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="fullNameLabel" for="fullName">Full Name *</label>
                                    <input type="text" id="full-name" name="full-name" value="<?php if($_SESSION['roleid']==3) {echo $_SESSION['firstname'].' '.$_SESSION['lastname']; } ?>"
                                        placeholder="Enter your full name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="emailAddressLabel" for="emailAddress">Email Address *</label>
                                    <input type="text" id="email-address" name="email-address" value="<?php if($_SESSION['roleid']==3) {echo $_SESSION['email'];}?>"
                                        placeholder="Enter your email address" class="form-control" <?php if($_SESSION['roleid']==3){?>disabled<?php }?>>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="subjectLabel" for="subject">Subject *</label>
                                    <input type="text" id="subject" name="subject" placeholder="Enter your subject" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="commentsLabel" for="comments/questions">Comments/Questions *</label>
                            <input type="text" id="comments" name="comments" placeholder="Comments..." class="form-control">
                        </div>
                    </div>
                    
                </div>
                <button type="submit" name="submit" class="btn btn-primary contact-us-submit-btn">SUBMIT</button>
            </div>
        </form>
    </div>
    <!-- Contact Us Ends -->
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
                        <li><a href="#"><img src="images/Contact_Us/facebook.png"></a></li>
                        <li><a href="#"><img src="images/Contact_Us/twitter.png"></a></li>
                        <li><a href="#"><img src="images/Contact_Us/linkedin.png"></a></li>
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