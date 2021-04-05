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
                        <a class="navbar-brand" href="Admin_Dashboard.html">
                            <img src="images/Admin/Dashboard/logo.png" alt="logo">
                        </a>
                    </div>

                    <!-- Main Menu -->
                    <div class="container">
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav pull-right">
                                <li><a href="Admin_Dashboard.html">Dashboard</a></li>
                                <li><a href="#">Notes</a></li>
                                <li><a href="#">Members</a></li>
                                <li><a href="#">Reports</a></li>
                                <li><a href="#">Settings</a></li>
                                <li>
                                    <div class="admin-user-menu-popup">
                                        <a class="admin-user-menu-check" target=".admin-user-menu-show"><img
                                                src="images/Admin/Dashboard/user-img.png" class="user-img" width="40"
                                                height="40" alt="user-img"></a>
                                        <div class="admin-user-menu-show">
                                            <p><a href="#">Update Profile</a></p>
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
                        <a href="Admin_Dashboard.html">
                            <img class="logo" src="images/Admin/Dashboard/logo.png" alt="logo">
                        </a>

                        <!-- Mobile Menu close Button -->
                        <span id="mobile-nav-close-btn">&times;</span>
                        
                        <div id="mobile-nav-content">
                            <ul class="nav">
                                <li>
                                    <a href="Admin_Dashboard.html">Dashboard</a>
                                </li>
                                <li>
                                    <a href="#">Notes</a>
                                </li>
                                <li><a href="#">Members</a></li>
                                <li>
                                    <a href="#">Reports</a>
                                </li>

                                <li>
                                    <a href="#">Settings</a>
                                </li>
                                <li><a href="#"><img src="images/Admin/Dashboard/user-img.png" class="user-img" width="40" height="40"
                                    alt="user-img"></a></li>
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
    <!-- Manage System Configuration -->
    <div id="adminManageSystemConfiguration">
        <form>
            <div class="container">
                <p>Manage System Configuration</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="supportEmail" for="supportEmail">Support email address *</label>
                            <input type="email" name="support-email" id="support-email" class="form-control"
                                placeholder="Enter Support email address">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="supportPhoneNumber" for="supportPhoneNumber">Support phone number</label>
                            <input type="tel" name="support-phone-number" id="support-phone-number" class="form-control"
                                placeholder="Enter phone number">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="email" for="email">Email Address(es)(for various events system will send notifications to these users) *</label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="Enter your email address">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="facebookURL" for="facebookURL">Facebook URL</label>
                            <input type="email" name="facebook-url" id="facebook-url" class="form-control"
                                placeholder="Enter facebook url">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="twitterURL" for="twitterURL">Twitter URL</label>
                            <input type="email" name="twitter-url" id="twitter-url" class="form-control"
                                placeholder="Enter twitterurl">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="linkedinURL" for="linkedinURL">Linkedin URL</label>
                            <input type="email" name="linkedin-url" id="linkedin-url" class="form-control"
                                placeholder="Enter linkedin url">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="defaultImage" for="defaultImage">Default image for notes(if seller do not upload)</label>
                            <span><img class="upload-img" src="./images/Admin/Manage_System_Configuration/upload.png"></span>
                            <input type="text" name="default-image" id="default-image" class="form-control"
                                placeholder="Upload a Picture">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="defaultProfilePicture" for="defaultProfilePicture">Default profile picture(if seller do not upload)</label>
                            <span><img class="upload-img" src="./images/Admin/Manage_System_Configuration/upload.png"></span>
                            <input type="text" name="default-profile-picture" id="default-profile-picture" class="form-control"
                                placeholder="Upload a Picture">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary submit-btn">SUBMIT</button>
                    </div>
                </div>
                
            </div>
        </form>
    </div>
    <!-- Manage System Configuration Ends -->
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

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
</body>

</html>