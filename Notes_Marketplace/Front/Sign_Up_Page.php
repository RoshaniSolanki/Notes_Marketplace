<?php include "../includes/db.php"; ?>
<?php include "../includes/functions.php"; ?>
<?php session_start(); ?>

<?php 

if(isset($_POST['submit'])) {

    $firstname = escape_string($_POST['firstname']);
    $lastname = escape_string($_POST['lastname']);
    $email = escape_string($_POST['email']);
    $password = escape_string($_POST['password']);
    $confirmpassword = escape_string($_POST['confirmpassword']);
    
    $createdDate = date("Y-m-d H:i:s");
    $modifiedDate = date("Y-m-d H:i:s");

    $email_query = query("SELECT * FROM users where EmailID='{$email}'");
    $email_count = mysqli_num_rows($email_query);

    if($email_count) {
        $query = mysqli_fetch_assoc($email_query);

        $_SESSION['firstname'] = $query['FirstName'];
        $_SESSION['email'] = $query['EmailID'];
    }
   
    if($email_count>0) {
        echo "<script> alert('Email Already Exists'); </script>";
    }else {

    $insert_query = query("INSERT INTO users(RoleID, FirstName, LastName, EmailID, Password, CreatedBy, CreatedDate, ModifiedBy, ModifiedDate) VALUES (3, '{$firstname}', '{$lastname}', '{$email}', '{$password}', null, '{$createdDate}', null, '{$modifiedDate}')");
    confirm($insert_query);
    }

    if($insert_query) {
        $subject = "Note Marketplace - Email Verification";
        $email = $_POST['email'];
        $body = "Hello " . $firstname ." ". $lastname.","."\r\n"."\r\n"."Thank you for signing up with us. Please click on below link to verify your email address and to do login."."\r\n"."\r\n". "http://localhost/Roshani_php/Training/NotesMarketPlace/Notes_Marketplace/Front/Email_Verification_Page.php" ."\r\n"."\r\n"."Regards,"."\r\n". "Notes Marketplace";
        $sender_email = "Email From: {$email}";
         
        $result = mail($email, $subject, $body, $sender_email);
         
         if(!$result) {
             echo "Email sending failed....";
             redirect("Sign_Up_Page.php");
         }else {
              /*echo "Email successfully sent to $to_email...";*/
              redirect("Login.php");
         }
    }else {
        echo '<script>alert("Not Inserted");</script>';
    }


   /* echo "<p class='text2' style='text-align:center;margin-top:20px;'><i class='fa fa-check-circle'></i>Your account has
    been successfully created</p>";*/
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

    <!-- Font Awesome CSS -->
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>

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
            height: 1050px;
        }
    </style>


</head>

<body>

    <!-- Sign Up Page -->
    <div id="signUpPage">
        <img class="logo" src="images/login/top-logo.png">
        <div class="container">
            <div class="signUp">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Create an Account</h1>
                        <p class="text1">Enter your details to signup</p>
                        <p class="text2"> <i class='fa fa-check-circle'></i>Your account has
                            been successfully created</p>

                        <form action="" method="post" id="sign_up_form" onsubmit="return Sign_Up()">
                            <div class="form-group">
                                <label class="firstNameLabel" for="firstName">First Name *</label>
                                <input type="text" class="form-control" id="first-name" name="firstname"
                                    placeholder="Enter your first name">
                                <small>Error Message</small>
                            </div>
                            <div class="form-group">
                                <label class="lastNameLabel" for="lastName">Last Name *</label>
                                <input type="text" class="form-control" id="last-name" name="lastname"
                                    placeholder="Enter your last name">
                                <small>Error Message</small>
                            </div>
                            <div class="form-group">
                                <label class="emailLabel" for="email">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                                    placeholder="Enter email">
                                <small>Error Message</small>
                            </div>
                            <div class="form-group">
                                <label class="passwordLabel" for="password">Password</label>
                                <input type="password" class="form-control" id="password"
                                    placeholder="Enter Your Password" name="password">
                                <span class="show-pass" target="#password"><img class="eye-img"
                                        src="images/login/eye.png"></span>
                                <small>Error Message</small>
                            </div>
                            <div class="form-group">
                                <label class="confirmPasswordLabel" for="confirmPassword">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm-password"
                                    placeholder="Enter Your Password" name="confirmpassword">

                                <span class="show-pass" target="#confirm-password"><img class="eye-img"
                                        src="images/login/eye.png"></span>
                                <small>Error Message</small>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary sign-up-btn">SIGN UP</button>
                            <p class="text3">Already have an account? <a href="Login.php">Login</a></p>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sign Up Page Ends -->

    <!-- JQuery -->
    <script src="js/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
</body>

</html>

<script>

   /***** function Sign_Up() {
        const first_name = document.getElementById('first-name');
        const firstNameValue = first_name.value.trim();

        var a = /[A-Za-z]+$/;
        if (firstNameValue === '') {
            first_name.style.border = "1px solid red";
            document.getElementById('fn').innerHTML = "First Name cannot be blank";
            return false;

        }if (!firstNameValue.match(a)) {
            document.getElementById('fn').innerHTML = "Not a valid First Name";
            return false;
        } 
        
    }*****/
    /*
    const sign_up_form = document.getElementById('sign_up_form');
    const first_name = document.getElementById('first-name');
    const last_name = document.getElementById('last-name');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const confirm_password = document.getElementById('confirm-password');

    sign_up_form.addEventListener('submit', e => {
       e.preventDefault();

        checkInputs();
    });

    function checkInputs() {
        const emailValue = email.value.trim();
        const firstNameValue = first_name.value.trim();
        const lastNameValue = last_name.value.trim();
        const passwordValue = password.value.trim();
        const confirmPasswordValue = confirm_password.value.trim();

        var a = /[A-Za-z]+$/;
        if (firstNameValue === '') {
            setErrorFor(first_name, 'First Name cannot be blank');
        } else if (!firstNameValue.match(a)) {
            setErrorFor(first_name, 'Not a valid First Name');
        } else {
            setSuccessFor(first_name);
        }

        if (lastNameValue === '') {
            setErrorFor(last_name, 'Last Name cannot be blank');
        } else if (!lastNameValue.match(a)) {
            setErrorFor(last_name, 'Not a valid Last Name');
        } else {
            setSuccessFor(last_name);
        }

        if (emailValue === '') {
            setErrorFor(email, 'Email cannot be blank');
        } else if (!isEmail(emailValue)) {
            setErrorFor(email, 'Not a valid email');
        } else {
            setSuccessFor(email);
        }


        var c = 0;
        for (var i = 0; i < passwordValue.length; i++) {
            if (passwordValue[i] == " ")
                c++;
        }
        if (passwordValue === '') {
            setErrorFor(password, 'Password cannot be blank');
        } else if (passwordValue.length < 6 || passwordValue.length > 24) {
            setErrorFor(password, 'Password must be between 6 and 24 characters long');
        }else if(passwordValue.search(/[a-z]/) == -1) {
            setErrorFor(password, 'Password must have at least 1 lowercase character');
        }else if(passwordValue.search(/[0-9]/) == -1) {
            setErrorFor(password, 'Password must have at least 1 digit character');
        }else if(passwordValue.search(/[!\@\#\$\%\^\&\(\)\;\:\_\+\,\.]/) == -1) {
            setErrorFor(password, 'Password must have at least 1 special character');
        }else if(c!=0) {
            setErrorFor(password, 'Password must not contain whitespaces');
        }
        else {
            setSuccessFor(password);
        }

        var c = 0;
        for (var i = 0; i < confirmPasswordValue.length; i++) {
            if (confirmPasswordValue[i] == " ")
                c++;
        }
        if (confirmPasswordValue === '') {
            setErrorFor(confirm_password, 'Password cannot be blank');
        }else if (confirmPasswordValue.length < 6 || confirmPasswordValue.length > 24) {
            setErrorFor(confirm_password, 'Password must be between 6 and 24 characters long');
        }else if(confirmPasswordValue.search(/[a-z]/) == -1) {
            setErrorFor(confirm_password, 'Password must have at least 1 lowercase character');
        }else if(confirmPasswordValue.search(/[0-9]/) == -1) {
            setErrorFor(confirm_password, 'Password must have at least 1 digit character');
        }else if(confirmPasswordValue.search(/[!\@\#\$\%\^\&\(\)\;\:\_\+\,\.]/) == -1) {
            setErrorFor(confirm_password, 'Password must have at least 1 special character');
        }else if(c!=0) {
            setErrorFor(confirm_password, 'Password must not contain whitespaces');
        }
         else if (passwordValue !== confirmPasswordValue) {
            setErrorFor(confirm_password, 'Passwords does not match');
        }else {
            setSuccessFor(confirm_password);
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
    }*/
</script>