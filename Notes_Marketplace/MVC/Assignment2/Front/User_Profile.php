<?php 
include "../includes/db.php"; 
include "../includes/functions.php"; 
session_start(); 

$user_id = $_SESSION['userid'];


$select_query = query("SELECT * FROM user_profile WHERE UserID = '$user_id' ");
confirm($select_query);

$count = mysqli_num_rows($select_query);
if($count>0) {

    while($row = mysqli_fetch_assoc($select_query)) {

        $db_dob                  = escape_string($row['DOB']);
        $db_gender               = escape_string($row['Gender']);
        $db_country_code         = escape_string($row['PhoneNumberCountryCode']);
        $db_phone_number         = escape_string($row['PhoneNumber']);
        $db_profile_picture      = escape_string($row['ProfilePicture']);
        $db_address_line1        = escape_string($row['AddressLine1']);
        $db_address_line2        = escape_string($row['AddressLine2']);
        $db_city                 = escape_string($row['City']);
        $db_state                = escape_string($row['State']);
        $db_zipcode              = escape_string($row['ZipCode']);
        $db_country              = escape_string($row['Country']);
        $db_university           = escape_string($row['University']);
        $db_college              = escape_string($row['College']);

    }

    if(isset($_POST['submit'])) {

        $dob               = escape_string($_POST['dob']);
        $gender            = escape_string($_POST['gender']);
        $country_code      = escape_string($_POST['code']);
        $phone_number      = escape_string($_POST['phone-number']);
        $profile_picture   = "../Members/Default/Admin_default_img.png";
        $address_line1     = escape_string($_POST['address-line1']);
        $address_line2     = escape_string($_POST['address-line2']);
        $city              = escape_string($_POST['city']);
        $state             = escape_string($_POST['state']);
        $zipcode           = escape_string($_POST['zipcode']);
        $country           = escape_string($_POST['country']);
        $university        = escape_string($_POST['university']);
        $college           = escape_string($_POST['college']);

        unlink($db_profile_picture);
        /* Profile Picture */
        $profile_picture           = $_FILES['profile-picture'];
        $profile_picture_name      = $profile_picture['name'];
        $profile_picture_tmp_loc   = $profile_picture['tmp_name'];
        $profile_picture_size      = $profile_picture['size'];
        $profile_picture_extension = explode('.',$profile_picture_name);
        $profile_picture_check     = strtolower(end($profile_picture_extension));
        $profile_picture_extstored = array('png', 'jpg', 'jpeg');
    
        if($profile_picture_size <= 10000000){
            if(in_array($profile_picture_check, $profile_picture_extstored)) {
                if(!is_dir("../Members/")) {
                    mkdir('../Members/');
                }
                if(!is_dir("../Members/" . $user_id)) {
                    mkdir('../Members/' . $user_id);
                }
    
                $profile_picture_destination = '../Members/' . $user_id . '/' . "DP_" . time() . '.' .$profile_picture_check;
                move_uploaded_file($profile_picture_tmp_loc, $profile_picture_destination);
                $profile_picture_query = query("UPDATE user_profile SET ProfilePicture='$profile_picture_destination' WHERE UserID='$user_id' ");
                confirm($profile_picture_query);
    
            }
        }else {
            echo "<script>alert('Profile Picture Max Size Should Be 10MB');</script>";
        }    

        $modified_date = date('Y-m-d H:i:s');
        $update_query ="UPDATE user_profile SET ";
        $update_query .="DOB                       = '{$dob}'              , ";
        $update_query .="Gender                    = '{$gender}'           , ";
        $update_query .="PhoneNumberCountryCode    = '{$country_code}'     , ";
        $update_query .="PhoneNumber               = '{$phone_number}'     , ";
       // $update_query .="ProfilePicture            = '{$profile_picture}'  , ";
        $update_query .="AddressLine1              = '{$address_line1}'    , ";
        $update_query .="AddressLine2              = '{$address_line2}'    , ";
        $update_query .="City                      = '{$city}'             , ";
        $update_query .="State                     = '{$state}'            , ";
        $update_query .="ZipCode                   = '{$zipcode}'          , ";
        $update_query .="Country                   = '{$country}'          , ";
        $update_query .="University                = '{$university}'       , ";
        $update_query .="ModifiedDate              = '{$modified_date}'    , ";
        $update_query .="College                   = '{$college}'            ";
        $update_query .="WHERE UserID= '{$user_id}' ";

            $update_profile = query($update_query);
            confirm($update_profile);
        
    }


}else {
    if(isset($_POST['submit'])) {
    
        $dob               = escape_string($_POST['dob']);
        $gender            = escape_string($_POST['gender']);
        $country_code      = escape_string($_POST['code']);
        $phone_number      = escape_string($_POST['phone-number']);
        $profile_picture   = "../Members/Default/Admin_default_img.png";
        $address_line1     = escape_string($_POST['address-line1']);
        $address_line2     = escape_string($_POST['address-line2']);
        $city              = escape_string($_POST['city']);
        $state             = escape_string($_POST['state']);
        $zipcode           = escape_string($_POST['zipcode']);
        $country           = escape_string($_POST['country']);
        $university        = escape_string($_POST['university']);
        $college           = escape_string($_POST['college']);
        $created_date      = date("Y-m-d H:i:s");
        $modified_date     = date("Y-m-d H:i:s");
    
    
        $insert_query  = query("INSERT INTO user_profile(UserID, DOB, Gender, PhoneNumberCountryCode, PhoneNumber, ProfilePicture, AddressLine1, AddressLine2, City, State, ZipCode, Country, University, College, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy) 
        VALUES('{$user_id}', '{$dob}', '{$gender}', '{$country_code}', '{$phone_number}', '{$profile_picture}', '{$address_line1}', '{$address_line2}', '{$city}', '{$state}', '{$zipcode}', '{$country}', '{$university}','{$college}', '{$created_date}', '{$user_id}', '{$modified_date}', '{$user_id}')");
        confirm($insert_query);
        if($insert_query){
            echo "<script>alert('Inserted Sucessfully...........');</script>";
        }
    
        /* Profile Picture */
        global $connection;
        $id = mysqli_insert_id($connection);
        $profile_picture           = $_FILES['profile-picture'];
        $profile_picture_name      = $profile_picture['name'];
        $profile_picture_tmp_loc   = $profile_picture['tmp_name'];
        $profile_picture_size      = $profile_picture['size'];
        $profile_picture_extension = explode('.',$profile_picture_name);
        $profile_picture_check     = strtolower(end($profile_picture_extension));
        $profile_picture_extstored = array('png', 'jpg', 'jpeg');
    
        if($profile_picture_size <= 10000000){
            if(in_array($profile_picture_check, $profile_picture_extstored)) {
                if(!is_dir("../Members/")) {
                    mkdir('../Members/');
                }
                if(!is_dir("../Members/" . $user_id)) {
                    mkdir('../Members/' . $user_id);
                }
    
                $profile_picture_destination = '../Members/' . $user_id . '/' . "DP_" . time() . '.' .$profile_picture_check;
                move_uploaded_file($profile_picture_tmp_loc, $profile_picture_destination);
                $profile_picture_query = query("UPDATE user_profile SET ProfilePicture='$profile_picture_destination' WHERE ID=$id");
                confirm($profile_picture_query);
    
            }
        }else {
            echo "<script>alert('Profile Picture Max Size Should Be 10MB');</script>";
        }    
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
    <!-- User Profile -->
    <div id="userProfile">
        <div class="user-profile-img">
            <img src="images/User-Profile/banner-with-overlay.jpg">
            <div class="user-profile-img-text">User Profile</div>
        </div>

        <form action="" method="POST" onsubmit="return profile()" enctype="multipart/form-data" >
            <div class="container">
                <p class="user-profile-headings">Basic Profile Details</p>
                <div class="row">

                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="firstName" for="firstName">First Name *</label>
                            <input type="text" name="first-name" id="first-name" class="form-control"
                                placeholder="Enter your first name" value="<?php if(isset($_SESSION['firstname'])){echo $_SESSION['firstname']; }?>" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="lastName" for="lastName">Last Name *</label>
                            <input type="text" name="last-name" id="last-name" class="form-control"
                                placeholder="Enter your last name" value="<?php if(isset($_SESSION['lastname'])){echo $_SESSION['lastname']; } ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="email" for="email">Email *</label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="Enter your email address" value="<?php if(isset($_SESSION['email'])){echo $_SESSION['email']; }?>" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="dateOfBirth" for="dateOfBirth">Date of Birth</label>
                            <input type="text" name="dob" id="dob" class="form-control"
                                placeholder="Enter your date of birth" value="<?php if($count > 0){ echo $db_dob;}?>">
                            <label for="dob"><img class="calendar-img" src="images/User-Profile/calendar.png"
                                    alt="calender"></label>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="gender" for="gender">Gender</label>
                            <span><img class="gender-arrow-down-img" src="./images/User-Profile/down-arrow.png"></span>
                            <select class="form-control" id="gender" name="gender">

                            <?php
                                $show_gender = query("SELECT Value FROM reference_data WHERE ID='$db_gender' ");
                                confirm($show_gender);

                                while($show_gender_row = mysqli_fetch_assoc($show_gender)) {
                                    $gender = $show_gender_row['Value'];
                                    }
                            ?>
                                <option selected value="<?php if($count>0){echo $db_gender;}?>"><?php if($count>0){echo $gender;}?><?php if($count==0){?>Select your gender<?php }?></option>

                                <?php  
                                    $get_gender = query("SELECT ID,Value FROM reference_data WHERE RefCategory = 'Gender' ");
                                    confirm($get_gender);

                                        while($grow = mysqli_fetch_assoc($get_gender)) {
                                        $gender_id=$grow['ID'];
                                        $gender_name=$grow['Value'];
                                        echo "<option value='$gender_id'>$gender_name</option>";
                                        }
                                ?>
                                
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
                                            $show_ccode = query("SELECT CountryCode FROM countries WHERE ID='$db_country_code' ");
                                            confirm($show_ccode);

                                            while($show_cc_row = mysqli_fetch_assoc($show_ccode)) {
                                                $country_code = $show_cc_row['CountryCode'];
                                            }
                                        ?>
                                        <option selected value="<?php if($count>0){echo $db_country_code;}?>"><?php if($count>0){echo $country_code;}?><?php if($count==0){?>+91<?php }?></option>


                                        <?php  
                                        $get_country_code = query("SELECT ID,CountryCode FROM countries");
                                        confirm($get_country_code);

                                        while($row = mysqli_fetch_assoc($get_country_code)) {
                                        $country_id=$row['ID'];
                                        $country_name=$row['CountryCode'];
                                        echo "<option value='$country_id'>$country_name</option>";
                                        }
                                        ?>
                                    </select>
                                    
                                </div>
                                <div class="col-md-9 col-sm-9">
                                    
                                    <input type="tel" name="phone-number" id="phone-number" class="form-control"
                                        placeholder="Enter your phone number" value="<?php if($count > 0){ echo $db_phone_number;}?>">
                                    <small>Error Message</small>
                                       
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
                            <input type="file" id="profile-picture" name="profile-picture" class="form-control"
                                placeholder="Upload a Picture" value="<?php if($count > 0){ echo $db_profile_picture;}?>">
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
                                placeholder="Enter your address" value="<?php if($count > 0){ echo $db_address_line1;}?>" required>
                                <small>Error Message</small>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="addressLine2" for="addressLine2">Address Line 2</label>
                            <input type="text" name="address-line2" id="address-line2" class="form-control"
                                placeholder="Enter your address" value="<?php if($count > 0){ echo $db_address_line2;}?>">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="city" for="city">City *</label>
                            <input type="text" name="city" id="city" class="form-control" placeholder="Enter your city" 
                            value="<?php if($count > 0){ echo $db_city;}?>" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="state" for="state">State *</label>
                            <input type="text" name="state" id="state" class="form-control"
                                placeholder="Enter your state" value="<?php if($count > 0){ echo $db_state;}?>" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="zipCode" for="zipCode">ZipCode *</label>
                            <input type="text" name="zipcode" id="zipcode" class="form-control"
                                placeholder="Enter your zipcode" value="<?php if($count > 0){ echo $db_zipcode;}?>" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="country" for="country">Country *</label>
                            <span><img class="country-arrow-down-img"
                                            src="images/User-Profile/down-arrow.png"></span>
                            <select name="country" id="country" class="form-control"
                                placeholder="Enter your country" name="country">

                                <option selected value="<?php if($count>0){echo $db_country;}?>"><?php if($count>0){echo $db_country;}?><?php if($count==0){?>Enter your country<?php }?></option>

                                <?php 
                                $country = query("SELECT Country_Name FROM countries");
                                confirm($country);

                                while($country_row = mysqli_fetch_assoc($country)) {
                                $country_name=$country_row['Country_Name'];
                                echo "<option value='$country_name'>$country_name</option>";
                                }
                                ?>

                            </select>
                        </div>
                    </div>
                </div>
                <p class="user-profile-headings">University and College information</p>
                <div class="row">

                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="university" for="university">University</label>
                            <input type="text" name="university" id="university" class="form-control"
                                placeholder="Enter your university" value="<?php if($count > 0){ echo $db_university;}?>">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="college" for="college">College</label>
                            <input type="text" name="college" id="college" class="form-control"
                                placeholder="Enter your college" value="<?php if($count > 0){ echo $db_college;}?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <button type="submit" name="submit" class="btn btn-primary user-profile-submit-btn">SUBMIT</button>
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

<script>

const phone_number  = document.getElementById('phone-number');
/*const address_line1 = document.getElementById('address-line1');
const city          = document.getElementById('city');
const state         = document.getElementById('state');
const zipcode       = document.getElementById('zipcode');*/

    function profile() {
        var x= checkInputs();
        if(x) {
            return true;
        }else{
            return false;
        }
    }

    function checkInputs() {
        var flag =0;
        const phoneNumberValue  = phone_number.value.trim();
        /*const addressLine1Value = address_line1.value.trim();
        const cityValue         = city.value.trim();
        const stateValue        = state.value.trim();
        const zipcodeValue      = zipcode.value.trim();*/

        var m=/[0-9]+$/;
        if (phoneNumberValue === '') {
            setErrorFor(phone_number, 'Phone Number cannot be blank');
            flag=0;
        }else if(phoneNumberValue.length!=10) {
            setErrorFor(phone_number, 'Phone Number length should be 10');
            flag=0;
        }else if(!phoneNumberValue.match(m)){
            setErrorFor(phone_number, 'Phone Number value should be numeric');
            flag=0;
        }else{
            setSuccessFor(phone_number);
            flag=1;
        }

        
       /* if (addressLine1Value === '') {
            setErrorFor(address_line1, 'Address Line1 Value cannot be blank');
            flag=0;
        }else {
            setSuccessFor(address_line1);
            flag=1;
        }

        if (cityValue === '') {
            setErrorFor(city, 'City Value cannot be blank');
            flag=0;
        }else {
            setSuccessFor(city);
            flag=1;
        }

        
        if (stateValue === '') {
            setErrorFor(state, 'State Value cannot be blank');
            flag=0;
        }else {
            setSuccessFor(state);
            flag=1;
        }

        if (zipcodeValue === '') {
            setErrorFor(zipcode, 'Zipcode Value cannot be blank');
            flag=0;
        }else {
            setSuccessFor(zipcode);
            flag=1;
        }*/


        if(flag == 1) {
            return true;
        }else {
            return false;
        }

    }    
    
    function setErrorFor(input, message) {
        const formGroup = input.parentElement;
        const small = formGroup.querySelector('small');
        formGroup.className = 'form-group error';
        small.innerText = message;
        
    }

    function setSuccessFor(input) {
        const formGroup = input.parentElement;
        formGroup.className = 'form-group';
       
    }
    
</script>