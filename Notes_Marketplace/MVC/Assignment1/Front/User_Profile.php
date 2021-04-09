<?php include "../includes/db.php"; ?>
<?php include "../includes/functions.php"; ?>


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
    
        <!-- CSS For Calender-->
        <link rel="stylesheet" href="css/jquery/jquery-ui.css">

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
                                <li><a href="Search_Notes_Page.html">Search Notes</a></li>
                                <li><a href="My_Sold_Notes.html">Sell Your Notes</a></li>
                                <li><a href="Buyer_Requests.html">Buyer Requests</a></li>
                                <li><a href="FAQ.html">FAQ</a></li>
                                <li><a href="Contact_Us.html">Contact Us</a></li>
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
    <!-- User Profile -->
    <div id="userProfile">
        <div class="user-profile-img">
            <img src="images/User-Profile/banner-with-overlay.jpg">
            <div class="user-profile-img-text">User Profile</div>
        </div>

        <form>
            <div class="container">
                <p class="user-profile-headings">Basic Profile Details</p>
                <div class="row">

                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="firstName" for="firstName">First Name *</label>
                            <input type="text" name="first-name" id="first-name" class="form-control"
                                placeholder="Enter your first name">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="lastName" for="lastName">Last Name *</label>
                            <input type="text" name="last-name" id="last-name" class="form-control"
                                placeholder="Enter your last name">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="email" for="email">Email *</label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="Enter your email address">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="dateOfBirth" for="dateOfBirth">Date of Birth</label>
                            <input type="text" name="dob" id="dob" class="form-control"
                                placeholder="Enter your date of birth">
                            <span><img class="calendar-img" src="images/User-Profile/calendar.png"
                                    alt="calender"></span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="gender" for="gender">Gender</label>
                            <span><img class="gender-arrow-down-img" src="./images/User-Profile/down-arrow.png"></span>
                            <select class="form-control" id="gender">
                                <option selected disabled hidden>Select your gender</option>
                                <option>FeMale</option>
                                <option>Male</option>
                                <option>Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="phoneNumber" for="phoneNumber">Phone Number</label>

                            <div class="row">
                                <div class="col-md-3 col-sm-3">
                                    <span><img class="pn-arrow-down-img"
                                            src="images/User-Profile/down-arrow.png"></span>
                                    <select type="text" name="code" id="code" class="form-control"
                                        placeholder="">

                                        <?php  
                                        $get_country_code = query("SELECT CountryCode FROM countries");
                                        confirm($get_country_code);

                                        while($row = mysqli_fetch_assoc($get_country_code)) {
                                        $country_id=$row['ID'];
                                        $country_name=$row['CountryCode'];
                                        echo "<option value='$country_id'>$country_name</option>";
                                        }
                                        ?>
                                        <!--option selected>+91</option-->
                                    </select>
                                </div>
                                <div class="col-md-9 col-sm-9">
                                    <input type="tel" name="phone-number" id="phone-number" class="form-control"
                                        placeholder="Enter your phone number">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="profilePicture" for="profilePicture">Profile Picture</label>
                            <label for="profile-picture"><img class="upload-img" src="./images/User-Profile/upload.png"></label>
                            <span class="pp-text">Upload a picture</span>
                            <div style="border:1px solid #d1d1d1;border-radius: 3px;height: 110px;">
                            <input type="file" name="profile-picture" id="profile-picture" class="form-control"
                                placeholder="Upload a Picture">
                            </div>
                        </div>
                    </div>
                </div>
                <p class="user-profile-headings">Address Details</p>
                <div class="row">

                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="addressLine1" for="addressLine1">Address Line 1 *</label>
                            <input type="text" name="address-line1" id="address-line1" class="form-control"
                                placeholder="Enter your address">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="addressLine2" for="addressLine2">Address Line 2</label>
                            <input type="text" name="address-line2" id="address-line2" class="form-control"
                                placeholder="Enter your address">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="city" for="city">City *</label>
                            <input type="text" name="city" id="city" class="form-control" placeholder="Enter your city">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="state" for="state">State *</label>
                            <input type="text" name="state" id="state" class="form-control"
                                placeholder="Enter your state">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="zipCode" for="zipCode">ZipCode *</label>
                            <input type="text" name="zipcode" id="zipcode" class="form-control"
                                placeholder="Enter your zipcode">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="country" for="country">Country *</label>
                            <input type="text" name="country" id="country" class="form-control"
                                placeholder="Enter your country">
                        </div>
                    </div>
                </div>
                <p class="user-profile-headings">University and College information</p>
                <div class="row">

                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="university" for="university">University</label>
                            <input type="text" name="university" id="university" class="form-control"
                                placeholder="Enter your university">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="college" for="college">College</label>
                            <input type="text" name="college" id="college" class="form-control"
                                placeholder="Enter your college">
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <button class="btn btn-primary user-profile-submit-btn">SUBMIT</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <!-- User Profile Ends-->
    <!-- Footer -->
    <footer class="footer">
        <hr>
        <div class="container">
            <div class="row">
                <div class="footer-content">
                <div class="col-md-6 col-sm-6 col-xs-7">
                    <p>
                        Copyright &copy; TatvaSoft All Rights Reserved.
                    </p>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-5">
                    <ul class="social-list">
                        <li><a href="#"><img src="images/home/facebook.png"></a></li>
                        <li><a href="#"><img src="images/home/twitter.png"></a></li>
                        <li><a href="#"><img src="images/home/linkedin.png"></a></li>
                    </ul>
                </div>
            </div>
            </div>
        </div>

    </footer>
    <!-- Footer Ends -->
    <!-- JQuery -->
    <script src="js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- jQuery ui for calendar-->
    <script src="js/css/jquery-ui.js"></script>
    <!-- Custom JS -->
    <script src="js/script.js"></script>
</body>

</html>