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
    
    <!--a href="download.php?note_pdf=srs"><p>CLICK TO download </p></a-->
    <?php
    /*$date = '2012-09-09 03:09:00';
    $dt = new DateTime($date);
    
    echo $dt->format('Y-m-d');*/
    if(isset($_POST['submit'])) {
        foreach($_FILES['doc']['name'] as $key=>$val){
            move_uploaded_file($_FILES['doc']['tmp_name'][$key],$val);
        }
        
    }
?>
    <form action="index.php" method="post" enctype="multipart/form-data">
    <input type="file" name="doc[]" multiple>
    <input type="submit" name="submit">
    </form>

    <!-- JQuery -->
    <script src="js/jquery-3.5.1.min.js"></script>


    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
</body></html>q
