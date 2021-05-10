<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();

        if(isset($_POST['submit'])) {

            $firstname    = escape_string($_POST['first-name']);
            $lastname     = escape_string($_POST['last-name']);
            $email        = escape_string($_POST['email']);
            $code         = escape_string($_POST['code']);
            $phone_number = escape_string($_POST['phone-number']);

            function randomPassword() {
                $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*().,;';
                $l = rand(6,24);
                $pass = substr(str_shuffle(sha1(rand() . time()) . $alphabet), 0 ,$l);
                return $pass;
            }
            $password = randomPassword();
        
            $createdDate  = date("Y-m-d H:i:s");
            $modifiedDate = date("Y-m-d H:i:s");

            $email_query = query("SELECT * FROM users where EmailID='{$email}'");
            confirm($email_query);
            $email_count = mysqli_num_rows($email_query);
   
            if($email_count>0) {
                echo "<script> alert('Email Already Exists'); </script>";
            }else {

                $insert_query = query("INSERT INTO users(RoleID, FirstName, LastName, EmailID, Password, IsEmailVerified, CreatedBy, CreatedDate, ModifiedBy, ModifiedDate) 
                VALUES (2, '{$firstname}', '{$lastname}', '{$email}', '{$password}', 1, 1, '{$createdDate}', 1, '{$modifiedDate}')");
                confirm($insert_query);

                global $connection;
                $user_id = mysqli_insert_id($connection);
                $insert_query1 = query("INSERT INTO user_profile(UserID, PhoneNumber, PhoneNumberCountryCode, CreatedBy, CreatedDate, ModifiedBy, ModifiedDate) 
                VALUES ('{$user_id}', '{$phone_number}', '{$code}', 1, '{$createdDate}', 1, '{$modifiedDate}')");
                confirm($insert_query1);

                $query = query("SELECT * FROM users where EmailID='{$email}'");
                confirm($query);
                $email_count = mysqli_num_rows($query);
                while($row = mysqli_fetch_assoc($query)) {
                    $_SESSION['userid'] =$row['ID'];
                    $_SESSION['roleid'] =$row['RoleID'];
                    $_SESSION['firstname'] = $row['FirstName'];
                    $_SESSION['lastname'] = $row['LastName'];
                    $_SESSION['email'] = $row['EmailID'];

                } 
            }
            if($insert_query) {
                $subject = "Password";
                $email = $_POST['email'];
                $body = "Hello " . $firstname ." ". $lastname.","."\r\n"."\r\n"."Super Admin Add you as Admin and your Password is ". $password ." Now You can Login through this Password."."\r\n"."\r\n"."Regards,"."\r\n". "Notes Marketplace";
                $sender_email = "Email From: {$email}";
                 
                $result = mail($email, $subject, $body, $sender_email);
                 
                 if(!$result) {
                    echo "<script>alert('Email sending failed....')</script>";
                    redirect("Admin_Add_Administrator.php");
                 }else {
                      redirect("../Front/Login.php");
                 }
            }else {
                echo '<script>alert("Not Inserted");</script>';
                //$msg = "Not Inserted";
            }
        }

        if(isset($_GET['Admin_id'])) {
            $admin_id = $_GET['Admin_id'];

            $select_admin = query("SELECT users.*, user_profile.PhoneNumber, user_profile.PhoneNumberCountryCode, countries.CountryCode FROM users LEFT JOIN user_profile ON 
            users.ID = user_profile.UserID LEFT JOIN countries ON user_profile.PhoneNumberCountryCode = countries.ID WHERE users.ID = '$admin_id' ");
            confirm($select_admin);

            while($row = mysqli_fetch_assoc($select_admin)) {

                $db_first_name           = escape_string($row['FirstName']);
                $db_last_name            = escape_string($row['LastName']);
                $db_email                = escape_string($row['EmailID']);
                $db_country_code_id      = escape_string($row['PhoneNumberCountryCode']);
                $db_phone_number         = escape_string($row['PhoneNumber']);
                $db_country_code         = escape_string($row['CountryCode']);
            }

            if(isset($_POST['submit2'])) {

                $first_name           = escape_string($_POST['first-name']);
                $last_name            = escape_string($_POST['last-name']);
                $email                = escape_string($_POST['email']);
                $country_code_id      = escape_string($_POST['code']);
                $phone_number         = escape_string($_POST['phone-number']);

            

            $modified_date = date('Y-m-d H:i:s');
            $update_query  ="UPDATE users SET ";
            $update_query .="FirstName     = '{$first_name}'    , ";
            $update_query .="LastName      = '{$last_name}'     , ";
            $update_query .="EmailID       = '{$email}'         , ";
            $update_query .="ModifiedDate  = '{$modified_date}' , ";
            $update_query .="ModifiedBy    =  1                   ";
            $update_query .="WHERE ID  = '{$admin_id}' ";

            $update_user = query($update_query);
            confirm($update_user);

            $update_query1  ="UPDATE user_profile SET ";
            $update_query1 .="PhoneNumber                = '{$phone_number}'  , ";
            $update_query1 .="PhoneNumberCountryCode     = '{$country_code_id}'  , ";
            $update_query1 .="ModifiedDate               = '{$modified_date}' , ";
            $update_query1 .="ModifiedBy                 =  1                   ";
            $update_query1 .="WHERE UserID               = '{$admin_id}' ";

            $update_user_profile = query($update_query1);
            confirm($update_user_profile);
            }
        }
    


?>

<?php include "header.php"; ?>
    <!-- Add Ministrator -->
    <div id="adminAddAdministrator">
        <form action="" method="post">
            <div class="container">
            <p class="heading">Add Administrator</p>
            
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="firstName" for="firstName">First Name *</label>
                            <input type="text" name="first-name" id="first-name" class="form-control"
                                placeholder="Enter your first name" value="<?php if(isset($_GET['Admin_id'])) { echo $db_first_name;}?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="lastName" for="lastName">Last Name *</label>
                            <input type="text" name="last-name" id="last-name" class="form-control"
                                placeholder="Enter your last name" value="<?php if(isset($_GET['Admin_id'])) { echo $db_last_name;}?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="email" for="email">Email *</label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="Enter your email address" value="<?php if(isset($_GET['Admin_id'])) { echo $db_email;}?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="phoneNumber" for="phoneNumber">Phone Number</label>
                            <div class="row">
                                <div class="col-md-3 col-xs-4">
                                    <span><img class="pn-arrow-down-img"
                                        src="images/Admin/Profile/down-arrow.png"></span>
                                <select type="text" name="code" id="code" class="form-control"
                                    placeholder="">

                                    <?php
                                          /* $show_ccode = query("SELECT CountryCode FROM countries WHERE ID='$db_country_code_id' ");
                                            confirm($show_ccode);

                                            while($show_cc_row = mysqli_fetch_assoc($show_ccode)) {
                                                $country_code = $show_cc_row['CountryCode'];
                                            }*/
                                    ?>
                                    <option selected value="<?php if(isset($_GET['Admin_id'])) { echo $db_country_code_id;}?>"><?php if(isset($_GET['Admin_id'])) { echo $db_country_code;}?><?php if(!isset($_GET['Admin_id'])){?>+91<?php }?></option>
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
                                placeholder="Enter your phone number" value="<?php if(isset($_GET['Admin_id'])) { echo $db_phone_number;}?>">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php 
                    if(isset($_GET['Admin_id'])) {
                    ?>

                        <div class="col-md-6">
                            <button type="submit" name="submit2" class="btn btn-primary submit-btn">SUBMIT</button>
                        </div>

                    <?php
                    }else {
                    ?>

                        <div class="col-md-6">
                            <button type="submit" name="submit" class="btn btn-primary submit-btn">SUBMIT</button>
                        </div>
                    <?php
                    }
                    ?>
                    
                </div>
            </div>
        </form>
    </div>
    <!-- Add Ministrator Ends -->

<?php include "footer.php"; ?>