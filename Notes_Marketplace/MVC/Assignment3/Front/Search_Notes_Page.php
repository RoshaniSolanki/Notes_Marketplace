<?php
include "../includes/db.php";
include "../includes/functions.php";




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
    <section id="search-notes-page">
        <!-- Header -->
        <?php 
    if(isset($_SESSION['userid'])) {
        echo "heloo";
        echo $_SESSION['userid'];
     ?>

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
                                    <li><a href="Buyer_Requests.php">Buyer Requests</a></li>
                                    <li><a href="FAQ.php">FAQ</a></li>
                                    <li><a href="Contact_Us.php">Contact Us</a></li>
                                    <li>
                                        <div class="user-menu-popup">
                                            <a class="user-menu-check" target=".user-menu-show"><img class="user-img"
                                                    src="images/User-Profile/user-img.png" width="40" height="40"
                                                    alt=""></a>
                                            <div class="user-menu-show">
                                                <p><a href="User_Profile.php">My Profile</a></p>
                                                <p><a href="My_Downloads.php">My Downloads</a></p>
                                                <p><a href="My_Sold_Notes.php">My Sold Notes</a></p>
                                                <p><a href="My_Rejected_Notes.php">My Rejected Notes</a></p>
                                                <p><a href="Change_Password_Page.php">Change Password</a></p>
                                                <p><a href="Logout.php">LOGOUT</a></p>
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
                                    <li>
                                        <a><img class="user-img" src="images/User-Profile/user-img.png" width="40"
                                                height="40" alt=""></a>

                                    </li>
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

        <?php
    }else {?>

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
                                    <li><a href="FAQ.php">FAQ</a></li>
                                    <li><a href="Contact_Us.php">Contact Us</a></li>
                                    <li><a href="Login.php">
                                            <button class="btn btn-primary login-btn">Login</button>
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
                                    <li>
                                        <a href="FAQ.php">FAQ</a>
                                    </li>

                                    <li>
                                        <a href="Contact_Us.php">Contact Us</a>
                                    </li>
                                    <li>
                                        <a href="Login.php">
                                            <button class="btn btn-primary login-btn">Login</button>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <?php }
    ?>
        <!-- Header Ends -->
        <div class="search-page-img">
            <img src="images/search-page/banner-with-overlay.jpg">
            <div class="search-page-img-text">Search Notes</div>
        </div>
        <!-- Section1 -->
        <div class="search-page-section1">
            <div class="container">
                <p class="SPS1H">Search and Filter notes</p>
                <div class="SPS1C">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="search" id="search" onchange="showdata()"
                                    placeholder="Search notes here...">
                                <span><img class="search-icon-img" src="./images/search-page/search-icon.png"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-4 col-xs-6">
                            <div class="form-group">
                                <select id="type" onchange="showdata()">
                                    <option value="0" class="form-control" selected>Select type</option>
                                    <?php 
                                $select_type = query("SELECT * FROM note_types WHERE IsActive = 1");
                                confirm($select_type);

                                while($t_row = mysqli_fetch_assoc($select_type)) {
                                    $type = $t_row['Type_Name'];
                                    $type_id = $t_row['ID'];
                                ?>
                                    <option value="<?php echo $type_id;?>"><?php echo $type; ?></option>
                                    <?php    
                                }
                                ?>
                                </select><span><img class="arrow-down-img"
                                        src="./images/search-page/arrow-down.png"></span>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6">
                            <div class="form-group">
                                <select id="category" onchange="showdata()">
                                    <option value="0" class="form-control" selected>Select category</option>

                                    <?php 
                                $select_category = query("SELECT * FROM note_categories WHERE IsActive = 1");
                                confirm($select_category);

                                while($row = mysqli_fetch_assoc($select_category)) {
                                    $category = $row['Category_Name'];
                                    $cat_id = $row['ID'];
                                ?>
                                    <option value="<?php echo $cat_id;?>"><?php echo $category; ?></option>
                                    <?php    
                                }
                                ?>

                                </select><span><img class="arrow-down-img"
                                        src="./images/search-page/arrow-down.png"></span>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6">
                            <div class="form-group">
                                <select id="university" onchange="showdata()">
                                    <option value="0" class="form-control" selected>Select university</option>

                                    <?php 
                                $select_university = query("SELECT DISTINCT UniversityName FROM seller_notes");
                                confirm($select_university);

                                while($row = mysqli_fetch_assoc($select_university)) {
                                    $university = $row['UniversityName'];
                                ?>
                                    <option value="<?php echo $university;?>"><?php echo $university; ?></option>
                                    <?php    
                                }
                                ?>

                                </select><span><img class="arrow-down-img"
                                        src="./images/search-page/arrow-down.png"></span>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6">
                            <div class="form-group">
                                <select id="course" onchange="showdata()">
                                    <option value="0" class="form-control" selected>Select course</option>

                                <?php 
                                $select_course = query("SELECT DISTINCT Course FROM seller_notes");
                                confirm($select_course);

                                while($row = mysqli_fetch_assoc($select_course)) {
                                    $course = $row['Course'];
                                ?>
                                    <option value="<?php echo $course;?>"><?php echo $course; ?></option>
                                    <?php    
                                }
                                ?>

                                </select><span><img class="arrow-down-img"
                                        src="./images/search-page/arrow-down.png"></span>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6">
                            <div class="form-group">
                                <select id="country" onchange="showdata()">
                                    <option value="0" class="form-control" selected>Select country</option>

                                    <?php 
                                $select_country = query("SELECT * FROM countries WHERE IsActive = 1");
                                confirm($select_country);

                                while($row = mysqli_fetch_assoc($select_country)) {
                                    $country = $row['Country_Name'];
                                    $country_id = $row['ID'];
                                ?>
                                    <option value="<?php echo $country_id;?>"><?php echo $country; ?></option>
                                    <?php    
                                }
                                ?>

                                </select><span><img class="arrow-down-img"
                                        src="./images/search-page/arrow-down.png"></span>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-6">
                            <div class="form-group">
                                <select id="rating" onchange="showdata()">
                                    <option value="0" class="form-control" selected>Select rating</option>

                                    <?php 
                                        for($i = 1; $i <=5 ; $i++) {?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php    }
                                    ?>

                                </select><span><img class="arrow-down-img"
                                        src="./images/search-page/arrow-down.png"></span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div id="result">
            
            
        </div>
        
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
                                    <li><a href="#"><img src="images/home/facebook.png"></a></li>
                                    <li><a href="#"><img src="images/home/twitter.png"></a></li>
                                    <li><a href="#"><img src="images/home/linkedin.png"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </footer>
                <!-- Footer Ends -->
                <!-- JQuery -->
                <script src="js/jquery-3.5.1.min.js"></script>

                <script type="text/javascript">
                    function showdata(page_current) {
                        let search_type = $("#type").val();
                        let search_category = $("#category").val();
                        let search_university = $("#university").val();
                        let search_course = $("#course").val();
                        let search_country = $("#country").val();
                        let search_rating = $("#rating").val();
                        let search_result = $("#search").val();

                        $.ajax({
                            url: "Search_Notes_Page_Ajax.php",
                            method: "GET",
                            data: {
                                selected_type: search_type,
                                selected_category: search_category,
                                selected_university: search_university,
                                selected_course: search_course,
                                selected_country: search_country,
                                selected_rating: search_rating,
                                selected_search: search_result
                            },
                            success: function (search_data) {
                                $("#result").html(search_data);
                            }
                        });
                    }
                    $(function () {
                        showdata(1);
                    });
                </script>


                <!-- Bootstrap JS -->
                <script src="js/bootstrap/bootstrap.min.js"></script>

                <!-- Custom JS -->
                <script src="js/script.js"></script>
    </section>
</body>

</html>