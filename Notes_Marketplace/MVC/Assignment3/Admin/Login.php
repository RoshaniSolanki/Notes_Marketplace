
<<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();
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
            background-image: url('../Admin/images/Admin/login/banner-with-overlay.jpg');
            position: absolute;
            width: 100%;
            height: 100%;
            background-repeat: no-repeat;
            height: 800px;
        }
    </style>

</head>

<body>

    <!-- Login Page -->
    <div id="loginPage">
        <img class="logo" src="../Admin/images/Admin/login/top-logo.png" alt="logo">
        
            <div class="container">
                <div class="login">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h1>Login</h1>
                        <p class="login-text1">Enter your email address and password to login</p>
                        <form action="" method="POST" name="login" id="login">
                            <div class="form-group">
                                <label class="emailLabel" for="email">Email</label>
                                
                                    <input type="email" class="form-control" id="email"
                                        aria-describedby="emailHelp" placeholder="Enter email">
                                    <small>Error Message</small>
                                
                            </div>
                            <div class="form-group">
                                <div class="conatainer">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <label class="passwordLabel" for="password">Password</label>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <span id="forgot-password">
                                                <label for="forgotpassword"><a href="Forgot_Password.html"
                                                        alt="forgot-password">Forgot Password?</a></label>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                               
                                <input type="password" class="form-control" id="password"
                                        placeholder="Enter Your Password" name="password">
                             
                                <span class="show-pass" target="#password"><img class="eye-img" src="../Admin/images/Admin/login/eye.png"></span>
                                <small>The password that you have entered is incorrect</small>
                            </div>
                            
                                <input type="checkbox" class="form-check-input" id="checkbox">
                                <label class="form-check-label" for="remember-me">Remember Me</label>
                            
                            <button type="submit" class="btn btn-primary login-btn">LOGIN</button>
                            <div class="login-text2">
                             
                                    <p class="">Don't have an account? <a href="Sign_Up_Page.html">Sign Up</a></p>
                               
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Login Page Ends -->

    <!-- JQuery -->
    <script src="js/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
</body>

</html>

<script>
    const login_form = document.getElementById('login');
    const email = document.getElementById('email');
    const password = document.getElementById('password');

    login_form.addEventListener('submit', e => {
        e.preventDefault();

        checkInputs();
    });

    function checkInputs() {
        const emailValue = email.value.trim();
        const passwordValue = password.value.trim();

        if (emailValue === '') {
            setErrorFor(email, 'Email cannot be blank');
        } else if (!isEmail(emailValue)) {
            setErrorFor(email, 'Not a valid email');
        }

        if (passwordValue === '') {
            setErrorFor(password, 'Password cannot be blank');
        }
    }

    function setErrorFor(input, message) {
        const formGroup = input.parentElement;
        const small = formGroup.querySelector('small');
        formGroup.className = 'form-group error';
        small.innerText = message;
    }

    function isEmail(email) {
        return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            .test(email);
    }
</script>