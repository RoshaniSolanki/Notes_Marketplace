<?php 
include "../includes/db.php";
include "../includes/functions.php"; 
session_start();

if(isset($_POST['submit'])){
    $old_password = escape_string($_POST['oldpassword']);
    $new_password = escape_string($_POST['newpassword']);
    $confirm_password = escape_string($_POST['confirmpassword']);

    if(isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
    

    $select_password = query("SELECT Password FROM users WHERE EmailID = '{$email}' ");
    confirm($select_password);

    $row = mysqli_fetch_assoc($select_password);
    $db_password = $row['Password'];

    if($old_password == $db_password) {
        $update_password = query("UPDATE users SET Password = '{$new_password}' ");
        confirm($update_password);
        
        if($update_password){
            $message = "Password has been changed successfully";
        }
    }

    }

}else {
    $message = "";
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

    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <style>
        body {
            background-image: url('images/login/banner-with-overlay.jpg');
            position: absolute;
            width: 100%;
            height: 100%;
            background-repeat: no-repeat;
            height: 800px;
        }
    </style>
    
</head>

<body>

    <!-- Change Password Page -->
    <div id="changePasswordPage">
        <img class="logo" src="images/login/top-logo.png">
        <div class="container">
            <div class="changePassword">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h1>Change Password</h1>
                        <p class="text">Enter your new password to change your password</p>
                        <p class="success-msg"><?php echo $message; ?></p>
                        <form action="" method="POST" onsubmit="return checkPassword()">
                            <div class="form-group">
                                <label class="oldPasswordLabel" for="oldPassword">Old Password</label>

                                <input type="password" class="form-control" id="old-password"
                                    placeholder="Enter Your old Password" name="oldpassword">
                                <span class="show-pass" target="#old-password"><img class="eye-img" src="images/login/eye.png"></span>
                                <small>Error Message</small>
                            </div>
                            <div class="form-group">
                                <label class="newPasswordLabel" for="newPassword">New Password</label>

                                <input type="password" class="form-control" id="new-password"
                                    placeholder="Enter Your new Password" name="newpassword">
                            
                                <span class="show-pass" target="#new-password"><img class="eye-img" src="images/login/eye.png"></span>
                                <small>Error Message</small>
                            </div>
                            <div class="form-group">
                                <label class="confirmPasswordLabel" for="confirmPassword">Confirm Password</label>

                                <input type="password" class="form-control" id="confirm-password"
                                    placeholder="Enter Your confirm Password" name="confirmpassword">
                               
                                <span class="show-pass" target="#confirm-password"><img class="eye-img" src="images/login/eye.png"></span>
                                <small>Error Message</small>
                            </div>
                            <div class="change-password-page-button">
                                <button type="submit" name="submit" class="btn btn-primary submit-btn">SUBMIT</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Change Password Page Ends -->

    <!-- JQuery -->
    <script src="js/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
</body>

</html>

<script>

    const old_password     = document.getElementById('old-password');
    const new_password     = document.getElementById('new-password');
    const confirm_password = document.getElementById('confirm-password');


    function checkPassword() {
        var x= checkInputs();
        if(x) {
            return true;
        }else{
            return false;
        }
    }

    function checkInputs() {
        var flag=0;
        const oldPasswordValue = old_password.value.trim();
        const newPasswordValue = new_password.value.trim();
        const confirmPasswordValue = confirm_password.value.trim();

        
        if (oldPasswordValue === '') {
            setErrorFor(old_password, 'Old password cannot be blank');
            flag=0;
        } else {
            setSuccessFor(old_password);
            flag=1;
        }


        var c = 0;
        for (var i = 0; i < newPasswordValue.length; i++) {
            if (newPasswordValue[i] == " ")
                c++;
        }
        if (newPasswordValue === '') {
            setErrorFor(new_password, 'Password cannot be blank');
            flag=0;
        } else if (newPasswordValue.length < 6 || newPasswordValue.length > 24) {
            setErrorFor(new_password, 'Password must be between 6 and 24 characters long');
            flag=0;
        }else if(newPasswordValue.search(/[a-z]/) == -1) {
            setErrorFor(new_password, 'Password must have at least 1 lowercase character');
            flag=0;
        }else if(newPasswordValue.search(/[0-9]/) == -1) {
            setErrorFor(new_password, 'Password must have at least 1 digit character');
            flag=0;
        }else if(newPasswordValue.search(/[!\@\#\$\%\^\&\(\)\;\:\_\+\,\.]/) == -1) {
            setErrorFor(new_password, 'Password must have at least 1 special character');
            flag=0;
        }else if(c!=0) {
            setErrorFor(new_password, 'Password must not contain whitespaces');
            flag=0;
        }
        else {
            setSuccessFor(new_password);
            flag=1;
        }

        var c = 0;
        for (var i = 0; i < confirmPasswordValue.length; i++) {
            if (confirmPasswordValue[i] == " ")
                c++;
        }
        if (confirmPasswordValue === '') {
            setErrorFor(confirm_password, 'Password cannot be blank');
            flag=0;
        }else if (confirmPasswordValue.length < 6 || confirmPasswordValue.length > 24) {
            setErrorFor(confirm_password, 'Password must be between 6 and 24 characters long');
            flag=0;
        }else if(confirmPasswordValue.search(/[a-z]/) == -1) {
            setErrorFor(confirm_password, 'Password must have at least 1 lowercase character');
            flag=0;
        }else if(confirmPasswordValue.search(/[0-9]/) == -1) {
            setErrorFor(confirm_password, 'Password must have at least 1 digit character');
            flag=0;
        }else if(confirmPasswordValue.search(/[!\@\#\$\%\^\&\(\)\;\:\_\+\,\.]/) == -1) {
            setErrorFor(confirm_password, 'Password must have at least 1 special character');
            flag=0;
        }else if(c!=0) {
            setErrorFor(confirm_password, 'Password must not contain whitespaces');
            flag=0;
        }
         else if (passwordValue !== confirmPasswordValue) {
            setErrorFor(confirm_password, 'Passwords does not match');
            flag=0;
        }else {
            setSuccessFor(confirm_password);
            flag=1;
        }

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
    

    function isEmail(email) {
        return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            .test(email);
    }

</script>    