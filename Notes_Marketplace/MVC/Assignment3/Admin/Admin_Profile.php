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

        $db_secondary_email      = escape_string($row['SecondaryEmailAddress']);
        $db_country_code         = escape_string($row['PhoneNumberCountryCode']);
        $db_phone_number         = escape_string($row['PhoneNumber']);
        $db_profile_picture      = escape_string($row['ProfilePicture']);

    }

    if(isset($_POST['submit'])) {

        $secondary_email   = escape_string($_POST['secondary-email']);
        $country_code      = escape_string($_POST['code']);
        $phone_number      = escape_string($_POST['phone-number']);
        $profile_picture   = "../Members/Default/Admin_default_img.png";

        //unlink($db_profile_picture);
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
        $update_query .="SecondaryEmailAddress     = '{$secondary_email}'  , ";
        $update_query .="PhoneNumberCountryCode    = '{$country_code}'     , ";
        $update_query .="PhoneNumber               = '{$phone_number}'     , ";
        $update_query .="ModifiedDate              = '{$modified_date}'      ";
        $update_query .="WHERE UserID= '{$user_id}' ";

            $update_profile = query($update_query);
            confirm($update_profile);
        
    }


}else {
    if(isset($_POST['submit'])) {
    
        $secondary_email   = escape_string($_POST['secondary-email']);
        $country_code      = escape_string($_POST['code']);
        $phone_number      = escape_string($_POST['phone-number']);
        $profile_picture   = "../Members/Default/Admin_default_img.png";
        $created_date      = date("Y-m-d H:i:s");
        $modified_date     = date("Y-m-d H:i:s");
    
    
        $insert_query  = query("INSERT INTO user_profile(UserID, SecondaryEmailAddress, PhoneNumberCountryCode, PhoneNumber, ProfilePicture, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy) 
        VALUES('{$user_id}', '{$secondary_email}','{$country_code}', '{$phone_number}', '{$profile_picture}', '{$created_date}', '{$user_id}', '{$modified_date}', '{$user_id}')");
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
<?php include "header.php"; ?>
    <!-- Profile -->
    <div id="adminProfile">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="container">
                <p class="admin-profile-heading">My Profile</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="firstName" for="firstName">First Name *</label>
                            <input type="text" name="first-name" id="first-name" class="form-control"
                                placeholder="Enter your first name" value="<?php if(isset($_SESSION['firstname'])){echo $_SESSION['firstname']; }?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="lastName" for="lastName">Last Name *</label>
                            <input type="text" name="last-name" id="last-name" class="form-control"
                                placeholder="Enter your last name" value="<?php if(isset($_SESSION['lastname'])){echo $_SESSION['lastname']; } ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="email" for="email">Email *</label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="Enter your email address" value="<?php if(isset($_SESSION['email'])){echo $_SESSION['email']; }?>" disabled required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="secondaryEmail" for="secondaryEmail">Secondary Email *</label>
                            <input type="email" name="secondary-email" id="secondary-email" class="form-control"
                                placeholder="Enter your email address" value="<?php if($count > 0){ echo $db_secondary_email;}?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="phoneNumber" for="phoneNumber">Phone Number</label>
                            <div class="row">
                                <div class="col-md-3 col-xs-4">
                                    <span><img class="apn-arrow-down-img"
                                        src="images/Admin/Profile/down-arrow.png"></span>
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
                                <div class="col-md-9 col-xs-8">
                                    <input type="tel" name="phone-number" id="phone-number" class="form-control"
                                placeholder="Enter your phone number" value="<?php if($count > 0){ echo $db_phone_number;}?>">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="profilePicture" for="profilePicture">Profile Picture</label>
                            <label for="profile-picture"><img class="upload-img" src="./images/Admin/Profile/upload.png"></label>
                            <span class="pp-text">Upload a picture</span>
                            <div style="border:1px solid #d1d1d1;border-radius: 3px;height: 110px;">
                            <input type="file" name="profile-picture" id="profile-picture" class="form-control"
                                placeholder="Upload a Picture" value="<?php if($count > 0){ echo $db_profile_picture;}?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" name="submit" class="btn btn-primary submit-btn">SUBMIT</button>
                    </div>
                </div>
                
            </div>
        </form>
    </div>
    <!-- Profile Ends -->
    <?php include "footer.php"; ?>