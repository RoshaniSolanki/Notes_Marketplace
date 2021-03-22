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
                                <li><a href="Search_Notes_Page.html">Search Notes</a></li>
                                <li><a href="My_Sold_Notes.html">Sell Your Notes</a></li>
                                <li><a href="Buyer_Requests.html">Buyer Requests</a></li>
                                <li><a href="FAQ.html">FAQ</a></li>
                                <li><a href="Contact_Us.html">Contact Us</a></li>
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
                                    <a href="Search_Notes_Page.html">Search Notes</a>
                                </li>
                                <li>
                                    <a href="My_Sold_Notes.html">Sell Your Notes</a>
                                </li>
                                <li><a href="Buyer_Requests.html">Buyer Requests</a></li>
                                <li>
                                    <a href="FAQ.html">FAQ</a>
                                </li>

                                <li>
                                    <a href="Contact_Us.html">Contact Us</a>
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

        <form>
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
                            <select class="form-control" id="category">
                                <option selected disabled hidden>Select your category</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="displayPicture" for="displayPicture">Display Picture</label>
                            <span><img class="add-notes-upload-file-img1"
                                    src="./images/Add-notes/upload-file.png"></span>
                            <input type="text" id="display-picture" name="display-picture" class="form-control"
                                placeholder="Upload a picture">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="uploadNotes" for="uploadNotes">Upload your notes *</label>
                            <span><img class="add-notes-upload-notes-img"
                                    src="./images/Add-notes/upload-note.png"></span>
                            <input type="text" id="upload-notes" name="upload-notes" class="form-control"
                                placeholder="Upload your notes">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="type" for="type">Type</label>
                            <span><img class="add-notes-arrow-down-img" src="./images/Add-notes/arrow-down.svg"></span>
                            <select class="form-control" id="type" name="type">
                                <option selected disabled hidden>Select your notes type</option>
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
                                <option selected disabled hidden>Select your country</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="institutionName" for="institutionName">Institution Name</label>
                            <input type="text" name="institution-name" id="institution-name" class="form-control"
                                placeholder="Enter your institutionvname">
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
                            <span><img class="add-notes-upload-file-img2"
                                    src="./images/Add-notes/upload-file.png"></span>
                            <input type="text" id="note-preview" name="note-preview" class="form-control"
                                placeholder="Upload a file">
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-3 col-xs-6">
                        <button class="btn btn-primary add-notes-save-btn">SAVE</button>
                    </div>
                    <div class="col-md-10 col-sm-9 col-xs-6">
                        <button class="btn btn-primary add-notes-publish-btn">PUBLISH</button>
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