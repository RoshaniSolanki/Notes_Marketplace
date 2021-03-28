<?php
include "../includes/db.php";
include "../includes/functions.php";

function show_note_category() {

    $category_query = query("SELECT * FROM note_categories");
    confirm($category_query);

    while($category_row = mysqli_fetch_assoc($category_query)) {
     
    $categories_options = <<<DELIMETER
    <option value="">{$category_row['Name']}</option>
        
DELIMETER;
        
    echo $categories_options;
    }

}

function show_note_type() {

    $note_type = query("SELECT * FROM note_types");
    confirm($note_type);

    while($note_row = mysqli_fetch_assoc($note_type)) {
     
    $note_options = <<<DELIMETER
    <option value="">{$note_row['Name']}</option>
        
DELIMETER;
        
    echo $note_options;
    }

}

function show_countries() {

    $country = query("SELECT * FROM countries");
    confirm($country);

    while($country_row = mysqli_fetch_assoc($country)) {
     
    $country_options = <<<DELIMETER
    <option value="">{$country_row['Name']}</option>
        
DELIMETER;
        
    echo $country_options;
    }

}

if(isset($_POST['save'])) {
        
        //echo  $category_title = escape_string($_POST['category']);

        $category_title = escape_string($_POST['category']);
        $cat_id = query("SELECT ID FROM note_categories WHERE Name = '{$category_title}' ");
        confirm($cat_id);
        $cat_id_row = mysqli_fetch_assoc($cat_id);
        $category =$cat_id_row['ID'];

        $note_title = escape_string($_POST['type']);
        $note_id = query("SELECT ID FROM note_types WHERE Name = '{$note_title}' ");
        confirm($note_id);
        $note_id_row = mysqli_fetch_assoc($note_id);
        $type =$note_id_row['ID'];

        $country_title = escape_string($_POST['country']);
        $country_id = query("SELECT ID FROM countries WHERE Name = '{$country_title}' ");
        confirm($country_id);
        $country_id_row = mysqli_fetch_assoc($note_id);
        $country =$country_id_row['ID'];

        $sell_for_radio_btn        = escape_string($_POST['sellfor-radio']);
        if($sell_for_radio_btn == "free") {
            $ispaid = 'false';
            $selling_price = 0;
        }else {
            $ispaid = 'true';
            $selling_price = escape_string($_POST['sell-price']);
        }
       
        $title                     = escape_string($_POST['title']);
        //$category           = escape_string($_POST['category']);
        //$type               = escape_string($_POST['type']);
        $display_picture           = escape_string($_FILES['display-picture']['name']);
        $display_picture_temp_loc  = escape_string($_FILES['display-picture']['tmp_name']);
        $upload_notes              = escape_string($_FILES['upload-notes']['name']);
        $upload_notes_temp_loc     = escape_string($_FILES['upload-notes']['tmp_name']);
        $number_of_pages           = escape_string($_POST['number-of-pages']);
        $description               = escape_string($_POST['description']);
        //$country            = escape_string($_POST['country']);
        $institute_name            = escape_string($_POST['institution-name']);
        $course_name               = escape_string($_POST['course-name']);
        $course_code               = escape_string($_POST['course-code']);
        $professor                 = escape_string($_POST['professor']);
        //$sell_for_radio_btn        = escape_string($_POST['sellfor-radio']);
        $note_preview              = escape_string($_FILES['note-preview']['name']);
        $note_preview_temp_loc     = escape_string($_FILES['note-preview']['tmp_name']);
        $created_date = date("Y-m-d H:i:s");
        $modified_date = date("Y-m-d H:i:s");
        
        move_uploaded_file($display_picture_temp_loc, "C://xampp/htdocs/Roshani_php/Training/NotesMarketPlace/Notes_Marketplace/Front".$display_picture);
        move_uploaded_file($upload_notes_temp_loc, "C://xampp/htdocs/Roshani_php/Training/NotesMarketPlace/Notes_Marketplace/Front".$upload_notes);
        move_uploaded_file($note_preview_temp_loc, "C://xampp/htdocs/Roshani_php/Training/NotesMarketPlace/Notes_Marketplace/Front".$note_preview);

        $upload_notes_insert = query("INSERT INTO seller_notes_attachements(FilePath, CreatedDate, ModifiedDate) VALUES('{$upload_notes}', '{$created_date)}', '{$modified_date)}'");

        $query  = "INSERT INTO ";
        $query .="seller_notes(SellerID, Title, Category, Type, NumberOfPages, Description, Country, UniversityName, CourseName, CourseCode, Professor, IsPaid, NotePreview, CreatedDate, ModifiedDate) ";
        $query .="VALUES('{$_SESSION['userid']}', {$title}', '{$category}', '{$display_picture}, {$type}', '{$number_of_pages}', '{$description}', '{$country}', '{$institute_name}', '{$course_name}', '{$course_code}', '{$professor}', '{$ispaid}', '{$note_preview}', '{$created_date}', '{$modified_date}')";
        $query =query($query);
        confirm($query);
        //set_message("New Product with id {$last_id} was Added");

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

    </style>

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
                                <li><a href="Search_Notes_Page.php">Search Notes</a></li>
                                <li><a href="Dashboard.php">Sell Your Notes</a></li>
                                <li><a href="Buyer_Requests.html">Buyer Requests</a></li>
                                <li><a href="FAQ.html">FAQ</a></li>
                                <li><a href="Contact_Us.php">Contact Us</a></li>
                                <li>
                                    <div class="user-menu-popup">
                                        <a class="user-menu-check" target=".user-menu-show"><img class="user-img"
                                                src="images/User-Profile/user-img.png" width="40" height="40"
                                                alt=""></a>
                                        <div class="user-menu-show">
                                            <p><a href="#">My Profile</a></p>
                                            <p><a href="">My Downloads</a></p>
                                            <p><a href="#">My Sold Notes</a></p>
                                            <p><a href="#">My Rejected Notes</a></p>
                                            <p><a href="#">Change Password</a></p>
                                            <p><a href="#">LOGOUT</a></p>
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
                                    <a href="Search_Notes_Page.php">Search Notes</a>
                                </li>
                                <li>
                                    <a href="Dashboard.php">Sell Your Notes</a>
                                </li>
                                <li><a href="Buyer_Requests.html">Buyer Requests</a></li>
                                <li>
                                    <a href="FAQ.html">FAQ</a>
                                </li>

                                <li>
                                    <a href="Contact_Us.php">Contact Us</a>
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
    <!-- Add Notes -->
    <div id="addNotes">
        <div class="add-notes-img">
            <img src="images/Add-notes/banner-with-overlay.jpg">
            <div class="add-notes-img-text">Add Notes</div>
        </div>

        <form action="" method="POST">
            <div class="container">
                <p class="add-notes-headings"></p>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="title" for="title">Title *</label>
                            <input type="text" name="title" id="title" class="form-control"
                                placeholder="Enter your notes title">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="category" for="category">Category *</label>
                            <span><img class="add-notes-arrow-down-img" src="./images/Add-notes/arrow-down.svg"></span>
                            <select class="form-control" id="category" name="category">
                                <option selected value="">Select your category</option>

                                <?php show_note_category(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="displayPicture" for="displayPicture">Display Picture</label>
                            <label for="display-picture"><img class="add-notes-upload-file-img1"
                                    src="./images/Add-notes/upload-file.png"></label>
                            <input type="file" id="display-picture" name="display-picture" class="form-control"
                                placeholder="Upload a picture">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="uploadNotes" for="uploadNotes">Upload your notes *</label>
                            <label for="upload-notes"><img class="add-notes-upload-notes-img"
                                    src="./images/Add-notes/upload-note.png"></label>
                            <input type="file" accept=".pdf" id="upload-notes" name="upload-notes" class="form-control"
                                placeholder="Upload your notes">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="type" for="type">Type</label>
                            <label for="type"><img class="add-notes-arrow-down-img" src="./images/Add-notes/arrow-down.svg"></label>
                            <select class="form-control" id="type" name="type">
                                <option>Select your notes type</option>

                                <?php show_note_type(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="noOfPages" for="noOfPages">Number of Pages</label>
                            <input type="text" name="number-of-pages" id="number-of-pages" class="form-control"
                                placeholder="Enter number of notes pages">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="description" for="description">Description *</label>
                            <input type="text" id="description" name="description" placeholder="Enter your description">
                        </div>
                    </div>
                </div>
                <p class="add-notes-headings">Institution information</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="country" for="country">Country </label>
                            <span><img class="add-notes-arrow-down-img" src="./images/Add-notes/arrow-down.svg"></span>
                            <select class="form-control" id="country" name="country">
                                <option selected>Select your country</option>

                                <?php show_countries(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="institutionName" for="institutionName">Institution Name</label>
                            <input type="text" name="institution-name" id="institution-name" class="form-control"
                                placeholder="Enter your institution name">
                        </div>
                    </div>
                </div>
                <p class="add-notes-headings">Course Details</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="courseName" for="courseName">Course Name</label>
                            <input type="text" name="course-name" id="course-name" class="form-control"
                                placeholder="Enter your course name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="courseCode" for="courseCode">Course Code</label>
                            <input type="text" name="course-code" id="course-code" class="form-control"
                                placeholder="Enter your course code">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="professor" for="professor">Professor / Lecturer</label>
                            <input type="text" name="professor" id="professor" class="form-control"
                                placeholder="Enter your professor name">
                        </div>
                    </div>
                </div>
                <p class="add-notes-headings">Selling Information</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12"><label class="sellFor" for="sellFor">Sell For *</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-2 col-xs-4">
                                            <label for="free" class="radio">
                                                <input type="radio" name="sellfor-radio" id="free" value="free"
                                                    class="radio-input form-control">
                                                <div class="internal-circle"></div>
                                                Free
                                            </label>
                                        </div>
                                        <div class="col-md-9 col-sm-10 col-xs-8">
                                            <label for="paid" class="radio">
                                                <input type="radio" name="sellfor-radio" id="paid" value="paid"
                                                    class="radio-input form-control">
                                                <div class="internal-circle"></div>
                                                Paid
                                            </label>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="sellPrice" for="sellPrice">Sell Price *</label>
                                    <input type="text" name="sell-price" id="sell-price" class="form-control"
                                        placeholder="Enter your price">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="notePreview" for="notePreview">Note Preview</label>
                            <label for="note-preview"><img class="add-notes-upload-file-img2"
                                    src="./images/Add-notes/upload-file.png"></label>
                            <input type="file" id="note-preview" name="note-preview" class="form-control"
                                placeholder="Upload a file">
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-3 col-xs-6">
                        <button type="submit" name="save" class="btn btn-primary add-notes-save-btn">SAVE</button>
                    </div>
                    <div class="col-md-10 col-sm-9 col-xs-6">
                        <button type="submit" name="publish" class="btn btn-primary add-notes-publish-btn">PUBLISH</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <!-- Add Notes Ends -->
    <!-- Footer -->
    <footer class="footer">
        <hr>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <p class="footer-text">
                        Copyright &copy; TatvaSoft All Rights Reserved.
                    </p>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <ul class="social-list">
                        <li><a href="#"><img src="images/Add-notes/facebook.png"></a></li>
                        <li><a href="#"><img src="images/Add-notes/twitter.png"></a></li>
                        <li><a href="#"><img src="images/Add-notes/linkedin.png"></a></li>
                    </ul>
                </div>
            </div>
        </div>

    </footer>
    <!-- Footer Ends -->
    <!-- JQuery -->
    <script src="js/jquery-3.5.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
</body>

</html>