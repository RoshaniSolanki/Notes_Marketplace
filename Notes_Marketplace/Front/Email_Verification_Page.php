<?php include "../includes/db.php"; ?>
<?php include "../includes/functions.php"; ?>

<?php 

session_start(); 
$email = $_SESSION['email'];
$firstname = $_SESSION['firstname'];
if(isset($_POST['email-verify-btn'])) {

$update_query = query("UPDATE users SET IsEmailVerified = 1 WHERE EmailID ='$email' ");
confirm($update_query);

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
</head>

<body>
    <!-- h:412 w:600-->
    <div id="email-verification-page">
       <img src="images/login/logo.png">
       <form action="" method="POST">
       <p class="EVPMH">Email Verification</p>
       <p class="EVPH">Dear <?php echo $firstname; ?>,</p>
       <p class="EVPT">Thanks for Signing up!</p>
       <p class="EVPT">Simply click below for email verification.</p>
       <button class="btn btn-primary evp-btn" type="submit" name="email-verify-btn">VERIFY EMAIL ADDRESS</button>
       </form>
    </div>
    <!-- JQuery -->
    <script src="js/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
</body>

</html>
