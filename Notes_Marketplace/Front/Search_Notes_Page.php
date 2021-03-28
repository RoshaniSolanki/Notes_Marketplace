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

    <header>
        <nav class="navbar navbar-fixed-top">
            <div class="container-fluid">
                <div class="site-nav-wrapper">

                    <div class="navbar-header">

                        <!-- Mobile Menu Open Button -->
                        <span id="mobile-nav-open-btn">&#9776;</span>

                        <!-- Logo -->
                        <a class="navbar-brand" href="Home_Page.php">
                            <img src="images/home/top-logo.png" alt="logo">
                        </a>
                    </div>

                    <!-- Main Menu -->
                    <div class="container">
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav pull-right">
                                <li><a href="Search_Notes_Page.php">Search Notes</a></li>
                                <li><a href="Dashboard.php">Sell Your Notes</a></li>
                                <li><a href="FAQ.html">FAQ</a></li>
                                <li><a href="Contact_Us.php">Contact Us</a></li>
                                <li><a href="Login.html">
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
                                    <a href="FAQ.html">FAQ</a>
                                </li>

                                <li>
                                    <a href="Contact_Us.php">Contact Us</a>
                                </li>
                                <li>
                                    <a href="Login.html">
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
                            <input type="text" class="form-control" name="search" id="search"
                                placeholder="Search notes here..."><span><img class="search-icon-img" src="./images/search-page/search-icon.png"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <div class="form-group">
                            <select id="type">
                                <option class="form-control" selected disabled hidden>Select type</option>
                            </select><span><img class="arrow-down-img" src="./images/search-page/arrow-down.png"></span>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <div class="form-group">
                            <select id="category">
                                <option class="form-control" selected disabled hidden>Select category</option>
                            </select><span><img class="arrow-down-img" src="./images/search-page/arrow-down.png"></span>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <div class="form-group">
                            <select id="university">
                                <option class="form-control" selected disabled hidden>Select university</option>
                            </select><span><img class="arrow-down-img" src="./images/search-page/arrow-down.png"></span>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <div class="form-group">
                            <select id="course">
                                <option class="form-control" selected disabled hidden>Select course</option>
                            </select><span><img class="arrow-down-img" src="./images/search-page/arrow-down.png"></span>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <div class="form-group">
                            <select id="country">
                                <option class="form-control" selected disabled hidden>Select country</option>
                            </select><span><img class="arrow-down-img" src="./images/search-page/arrow-down.png"></span>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6">
                        <div class="form-group">
                            <select id="rating">
                                <option class="form-control" selected disabled hidden>Select rating</option>
                            </select><span><img class="arrow-down-img" src="./images/search-page/arrow-down.png"></span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Section 2-->
    <div class="search-page-section2">
        <div class="container">
            <p class="SPS2MH">Total 18 notes</p>
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <img class="search1-img" src="./images/search-page/search1.png">
                    <div id="search1">
                        <p class="SPS2H">Computer Operating System - Final Exam Book With Paper Solution</p>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="university-img" src="./images/search-page/university.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T1">University of California, US</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="page-img" src="./images/search-page/pages.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T2">204 Pages</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="date-img" src="./images/search-page/date.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T3">Thu, Nov 26 2020</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="flag-img" src="./images/search-page/flag.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T4">5 Users marked this note as inappropriate</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="Rating">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                  </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6"><p class="SPS2T5">100 reviews</p></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <img class="search2-img" src="./images/search-page/search2.png">
                    <div id="search2">
                        <p class="SPS2H">Computer Science</p>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="university-img" src="./images/search-page/university.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T1">University of California, US</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="page-img" src="./images/search-page/pages.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T2">204 Pages</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="date-img" src="./images/search-page/date.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T3">Thu, Nov 26 2020</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="flag-img" src="./images/search-page/flag.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T4">5 Users marked this note as inappropriate</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="Rating">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star-white.png" class="Rating-Star">
                                  </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6"><p class="SPS2T5">100 reviews</p></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <img class="search3-img" src="./images/search-page/search3.png">
                    <div id="search3">
                        <p class="SPS2H">Basics Computer Engineering Tech India Publication Series</p>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="university-img" src="./images/search-page/university.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T1">University of California, US</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="page-img" src="./images/search-page/pages.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T2">204 Pages</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="date-img" src="./images/search-page/date.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T3">Thu, Nov 26 2020</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="flag-img" src="./images/search-page/flag.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T4">5 Users marked this note as inappropriate</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="Rating">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star-white.png" class="Rating-Star">
                                    <img src="./images/search-page/star-white.png" class="Rating-Star">
                                  </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6"><p class="SPS2T5">100 reviews</p></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <img class="search4-img" src="./images/search-page/search4.png">
                    <div id="search4">
                        <p class="SPS2H">Computer Science illuminated - Seventh Edition</p>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="university-img" src="./images/search-page/university.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T1">University of California, US</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="page-img" src="./images/search-page/pages.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T2">204 Pages</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="date-img" src="./images/search-page/date.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T3">Thu, Nov 26 2020</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="flag-img" src="./images/search-page/flag.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T4">5 Users marked this note as inappropriate</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="Rating">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                  </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6"><p class="SPS2T5">100 reviews</p></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <img class="search5-img" src="./images/search-page/search5.png">
                    <div id="search5">
                        <p class="SPS2H">The Computer Book</p>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="university-img" src="./images/search-page/university.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T1">University of California, US</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="page-img" src="./images/search-page/pages.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T2">204 Pages</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="date-img" src="./images/search-page/date.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T3">Thu, Nov 26 2020</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="flag-img" src="./images/search-page/flag.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T4">5 Users marked this note as inappropriate</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="Rating">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star-white.png" class="Rating-Star">
                                  </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6"><p class="SPS2T5">100 reviews</p></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <img class="search6-img" src="./images/search-page/search6.png">
                    <div id="search6">
                        <p class="SPS2H">Computer Operating System - Final Exam Book With Paper Solution</p>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="university-img" src="./images/search-page/university.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T1">University of California, US</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="page-img" src="./images/search-page/pages.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T2">204 Pages</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="date-img" src="./images/search-page/date.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T3">Thu, Nov 26 2020</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="flag-img" src="./images/search-page/flag.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T4">5 Users marked this note as inappropriate</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="Rating">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star-white.png" class="Rating-Star">
                                    <img src="./images/search-page/star-white.png" class="Rating-Star">
                                  </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6"><p class="SPS2T5">100 reviews</p></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <img class="search7-img" src="./images/search-page/search1.png">
                    <div id="search7">
                        <p class="SPS2H">Computer Operating System - Final Exam Book With Paper Solution</p>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="university-img" src="./images/search-page/university.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T1">University of California, US</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="page-img" src="./images/search-page/pages.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T2">204 Pages</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="date-img" src="./images/search-page/date.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T3">Thu, Nov 26 2020</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="flag-img" src="./images/search-page/flag.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T4">5 Users marked this note as inappropriate</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="Rating">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                  </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6"><p class="SPS2T5">100 reviews</p></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <img class="search8-img" src="./images/search-page/search2.png">
                    <div id="search8">
                        <p class="SPS2H">Computer Science</p>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="university-img" src="./images/search-page/university.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T1">University of California, US</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="page-img" src="./images/search-page/pages.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T2">204 Pages</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="date-img" src="./images/search-page/date.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T3">Thu, Nov 26 2020</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="flag-img" src="./images/search-page/flag.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T4">5 Users marked this note as inappropriate</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="Rating">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star-white.png" class="Rating-Star">
                                  </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6"><p class="SPS2T5">100 reviews</p></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <img class="search9-img" src="./images/search-page/search3.png">
                    <div id="search9">
                        <p class="SPS2H">Basics Computer Engineering Tech India Publication Series</p>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="university-img" src="./images/search-page/university.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T1">University of California, US</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="page-img" src="./images/search-page/pages.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T2">204 Pages</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="date-img" src="./images/search-page/date.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T3">Thu, Nov 26 2020</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-3">
                                <img class="flag-img" src="./images/search-page/flag.png">
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-9">
                                <p class="SPS2T4">5 Users marked this note as inappropriate</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="Rating">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star.png" class="Rating-Star">
                                    <img src="./images/search-page/star-white.png" class="Rating-Star">
                                    <img src="./images/search-page/star-white.png" class="Rating-Star">
                                  </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6"><p class="SPS2T5">100 reviews</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pagination-->
    <center>
        <div class="pagination-section">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <img class="left-arrow-img" src="./images/search-page/left-arrow.png">
                        </a>
                    </li>
                    <li class="page-item"><a  id="one" class="page-link" href="#">1</a></li>
                    <li class="page-item"><a id="two" class="page-link" href="#">2</a></li>
                    <li class="page-item"><a id="three" class="page-link" href="#">3</a></li>
                    <li class="page-item"><a  id="four" class="page-link" href="#">4</a></li>
                    <li class="page-item"><a id="five" class="page-link" href="#">5</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <img class="right-arrow-img" src="./images/search-page/right-arrow.png">
                        </a>
                    </li>
                </ul>
        </div>
    </center>
    <!-- Pagination Ends -->
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

    <!-- Bootstrap JS -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
</section>
</body>

</html>