<?php include "../includes/db.php" ?>
<?php include "../includes/functions.php"; ?>
<?php  session_start();

if(isset($_POST['submit'])) {

    $email = escape_string($_POST['email']);
    $password = escape_string($_POST['password']);

    $email_search = query("SELECT * FROM users WHERE EmailID = '$email' and IsEmailVerified = 1 ");
    confirm($email_search);

    $email_count = mysqli_num_rows($email_search);

    if($email_count) {
        $query = mysqli_fetch_assoc($email_search);

        $db_pass = $query['Password'];
        $role_id = $query['RoleID'];

        if($password == $db_pass) {

            $_SESSION['userid'] =$query['ID'];
            $_SESSION['roleid'] =$query['RoleID'];
            $_SESSION['firstname'] = $query['FirstName'];
            $_SESSION['lastname'] = $query['LastName'];
            $_SESSION['email'] = $query['EmailID'];
           
           if($role_id==3) {
                if(isset($_POST['rememberme'])) {
                    setcookie('emailcookie', $email, time()+86400);
                    setcookie('passwordcookie', $password, time()+86400);
                    redirect("Search_Notes_Page.php");

                }else {
                    redirect("Search_Notes_Page.php");
                }
            }

            if($role_id==2) {
                if(isset($_POST['rememberme'])) {
                    setcookie('emailcookie', $email, time()+86400);
                    setcookie('passwordcookie', $password, time()+86400);
                    redirect("../Admin/Admin_Dashboard.php");

                }else {
                    redirect("../Admin/Admin_Dashboard.php");
                }
            }
        }else {
            echo "<script>alert('Invalid Password')</script>";
        }
        
    }else {
        echo "<script>alert('Invalid Email')</script>";
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

    <!-- Login Page -->
    <div id="loginPage">
        <img class="logo" src="images/login/top-logo.png" alt="logo">

        <div class="container">
            <div class="login">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h1>Login</h1>
                        <p class="login-text1">Enter your email address and password to login</p>
                        <form action="Login.php" method="POST" name="login" id="login" onsubmit="return login_form()">
                            <div class="form-group">
                                <label class="emailLabel" for="email">Email</label>

                                <input type="text" class="form-control" id="email" name="email"
                                    aria-describedby="emailHelp" placeholder="Enter email" value="<?php if(isset($_COOKIE['emailcookie'])) {echo $_COOKIE['emailcookie']; } ?>">
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
                                                <label for="forgotpassword"><a href="Forgot_Password.php"
                                                        alt="forgot-password">Forgot Password?</a></label>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <input type="password" class="form-control" id="password"
                                    placeholder="Enter Your Password" name="password" value="<?php if(isset($_COOKIE['passwordcookie'])) {echo $_COOKIE['passwordcookie']; } ?>">

                                <span class="show-pass" target="#password"><img class="eye-img"
                                        src="images/login/eye.png"></span>
                                <small>Error Message</small>
                            </div>

                            <input type="checkbox" name="rememberme" class="form-check-input" id="checkbox">
                            <label class="form-check-label" for="remember-me">Remember Me</label>

                            <button type="submit" name="submit" id="login-button" class="btn btn-primary login-btn">LOGIN</button>
                            <div class="login-text2">

                                <p class="">Don't have an account? <a href="Sign_Up_Page.php">Sign Up</a></p>

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

    const email = document.getElementById('email');
    const password = document.getElementById('password');

  
  function login_form() {
    var x= checkInputs();
        if(x) {
            return true;
        }else{
            return false;
        }
    }
    
    function checkInputs(){
        var flag =0;
        const emailValue = email.value.trim();
        const passwordValue = password.value.trim();

        if (emailValue === '') {
            setErrorFor(email, 'Email cannot be blank');
            flag=0;
        } else if (!isEmail(emailValue)) {
            setErrorFor(email, 'Not a valid email');
            flag=0;
        } else {
            setSuccessFor(email);
            flag=1;
        }

        var c = 0;
        for (var i = 0; i < passwordValue.length; i++) {
            if (passwordValue[i] == " ")
                c++;
        }
        if (passwordValue === '') {
            setErrorFor(password, 'Password cannot be blank');
            flag=0;
        } else if (passwordValue.length < 6 || passwordValue.length > 24) {
            setErrorFor(password, 'Password must be between 6 and 24 characters long');
            flag=0;
        }else if(passwordValue.search(/[a-z]/) == -1) {
            setErrorFor(password, 'Password must have at least 1 lowercase character');
            flag=0;
        }else if(passwordValue.search(/[0-9]/) == -1) {
            setErrorFor(password, 'Password must have at least 1 digit character');
            flag=0;
        }else if(passwordValue.search(/[!\@\#\$\%\^\&\(\)\;\:\_\+\,\.]/) == -1) {
            setErrorFor(password, 'Password must have at least 1 special character');
            flag=0;
        }else if(c!=0) {
            setErrorFor(password, 'Password must not contain whitespaces');
            flag=0;
        }
        else {
            setSuccessFor(password);
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