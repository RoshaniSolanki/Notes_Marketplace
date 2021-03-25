<?php include "../includes/db.php" ?>
<?php include "../includes/functions.php"; ?>
<?php session_start();

if(isset($_POST['submit'])) {

    $email = escape_string($_POST['email']);

    $email_search = query("SELECT * FROM users WHERE EmailID = '$email' ");
    confirm($email_search);

    $email_count = mysqli_num_rows($email_search);

    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*().,;';
        $l = rand(6,24);
        $pass = substr(str_shuffle(sha1(rand() . time()) . $alphabet), 0 ,$l);
        return $pass;
    }
    $randomPassword = randomPassword();
    
    if($email_count) {
        $subject = "New Temporary Password has been created for you";
        $email = $_POST['email'];
        $body = "Hello, "."\r\n"."\r\n"."We have generated a new password for you"."\r\n". "Password: " .$randomPassword."\r\n"."\r\n"."Regards,"."\r\n". "Notes Marketplace";
        $sender_email = "Email From: {$email}";
         
        $result = mail($email, $subject, $body, $sender_email);
         
         if(!$result) {
             echo "Email sending failed....";
             redirect("Fogot_Password.php");
         }else {
              echo "<script> alert('Your password has been changed 
              successfully and newly generated password is sent on your registered email address.');</script>";
              redirect("Login.php");
         }
        
    }else {
        echo "Invalid Email";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0 ,user-scalable=no">

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
            height: 750px;
        }
    </style>


</head>

<body>
    <!-- Forgot Password Page -->
    <div id="forgotPasswordPage">
        <img class="logo" src="images/login/top-logo.png" alt="logo">
        <div class="container">
            <div class="forgotPassword">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Forgot Password?</h1>
                        <p class="text">Enter your email to reset your password</p>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label class="emailLabel" for="email">Email</label>
                               
                                    <input type="email" class="form-control" id="email" name="email"
                                        aria-describedby="emailHelp" placeholder="Enter email">
                                
                            </div>
                            <div class="forgot-password-page-button">
                                <button type="submit" name="submit" class="btn btn-primary submit-btn">SUBMIT</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- Forgot Password Page Ends -->

     
    <!-- JQuery -->
    <script src="js/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

</body>

</html>