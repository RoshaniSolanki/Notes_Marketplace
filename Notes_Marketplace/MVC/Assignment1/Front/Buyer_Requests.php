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
                                <li><a href="Buyer_Requests.php">Buyer Requests</a></li>
                                <li><a href="FAQ.php">FAQ</a></li>
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
                            <img class="logo" src="images/Buyer_Requests/logo.png" alt="logo">
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
                                <li><a href="Buyer_Requests.php">Buyer Requests</a></li>
                                <li>
                                    <a href="FAQ.php">FAQ</a>
                                </li>

                                <li>
                                    <a href="Contact_Us.php">Contact Us</a>
                                </li>
                                <li><a href="#"><img class="user-img" src="images/User-Profile/user-img.png" width="40" height="40"
                                    alt=""></a></li>
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
    <!-- Buyer Requests -->
    <div id="buyerRequests">
        <div class="container">
            
                <div id="part1">
                    <div class="row">
                        <div class="col-md-5 col-sm-4 col-xs-4">
                            <p>Buyer Requests</p>
                        </div>
                        <div class="col-md-7 col-sm-8 col-xs-8">
                            <input type="text" name="search" id="search" placeholder="Search"><span><img class="search-icon-img" src="./images/Buyer_Requests/search-icon.png"></span>
                            <a href=""><button class="btn btn-primary buyer-requests-search-btn">SEARCH</button></a>
                        </div>
                    </div>
                </div>
                <div id="part2">
                    <div class="row">
                        <div class="col-md-12">
                            <table>
                                <tr>
                                    <th>SR NO.</th>
                                    <th>NOTE TITLE</th>
                                    <th>CATEGORY</th>
                                    <th>BUYER</th>
                                    <th>PHONE NO.</th>
                                    <th>SELL TYPE</th>
                                    <th>PRICE</th>
                                    <th>DOWNLOADED DATE/TIME</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Data Science</td>
                                    <td>Science</td>
                                    <td>testting123@gmail.com</td>
                                    <td>+91 9874563527</td>
                                    <td>Paid</td>
                                    <td>$250</td>
                                    <td>27 Nov 2020, 11:24:34</td>
                                    <td>
                                        <img class="eye-img" src="./images/Buyer_Requests/eye.png">
                                    
                                            <div class="buyer-req-menu-popup">
                                                <a class="buyer-req-menu-check" target="#br1">
                                                    <img class="dots-img" src="./images/Buyer_Requests/dots.png">
                                                </a>
                                                <div id="br1" class="buyer-req-menu-show">
                                                    <p><a href="#">Download Note</a></p>
                                                </div>
                                            </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Accounts</td>
                                    <td>Commerce</td>
                                    <td>testting123@gmail.com</td>
                                    <td>+91 9874563527</td>
                                    <td>Free</td>
                                    <td>$0</td>
                                    <td>27 Nov 2020, 11:24:34</td>
                                    <td>
                                        <img class="eye-img" src="./images/Buyer_Requests/eye.png">
                                    
                                            <div class="buyer-req-menu-popup">
                                                <a class="buyer-req-menu-check" target="#br2">
                                                    <img class="dots-img" src="./images/Buyer_Requests/dots.png">
                                                </a>
                                                <div id="br2" class="buyer-req-menu-show">
                                                    <p><a href="#">Download Note</a></p>
                                                </div>
                                            </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Social Studies</td>
                                    <td>Social</td>
                                    <td>testting123@gmail.com</td>
                                    <td>+91 9874563527</td>
                                    <td>Free</td>
                                    <td>$0</td>
                                    <td>27 Nov 2020, 11:24:34</td>
                                    <td>
                                        <img class="eye-img" src="./images/Buyer_Requests/eye.png">
                                    
                                            <div class="buyer-req-menu-popup">
                                                <a class="buyer-req-menu-check" target="#br3">
                                                    <img class="dots-img" src="./images/Buyer_Requests/dots.png">
                                                </a>
                                                <div id="br3" class="buyer-req-menu-show">
                                                    <p><a href="#">Download Note</a></p>
                                                </div>
                                            </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>AI</td>
                                    <td>IT</td>
                                    <td>testting123@gmail.com</td>
                                    <td>+91 9874563527</td>
                                    <td>Paid</td>
                                    <td>$158</td>
                                    <td>27 Nov 2020, 11:24:34</td>
                                    <td>
                                        <img class="eye-img" src="./images/Buyer_Requests/eye.png">
                                    
                                            <div class="buyer-req-menu-popup">
                                                <a class="buyer-req-menu-check" target="#br4">
                                                    <img class="dots-img" src="./images/Buyer_Requests/dots.png">
                                                </a>
                                                <div id="br4" class="buyer-req-menu-show">
                                                    <p><a href="#">Download Note</a></p>
                                                </div>
                                            </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Lorem ipsum</td>
                                    <td>Lorem</td>
                                    <td>testting123@gmail.com</td>
                                    <td>+91 9874563527</td>
                                    <td>Free</td>
                                    <td>$0</td>
                                    <td>27 Nov 2020, 11:24:34</td>
                                    <td>
                                        <img class="eye-img" src="./images/Buyer_Requests/eye.png">
                                    
                                            <div class="buyer-req-menu-popup">
                                                <a class="buyer-req-menu-check" target="#br5">
                                                    <img class="dots-img" src="./images/Buyer_Requests/dots.png">
                                                </a>
                                                <div id="br5" class="buyer-req-menu-show">
                                                    <p><a href="#">Download Note</a></p>
                                                </div>
                                            </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>Data Science</td>
                                    <td>Science</td>
                                    <td>testting123@gmail.com</td>
                                    <td>+91 9874563527</td>
                                    <td>Paid</td>
                                    <td>$555</td>
                                    <td>27 Nov 2020, 11:24:34</td>
                                    <td>
                                        <img class="eye-img" src="./images/Buyer_Requests/eye.png">
                                    
                                            <div class="buyer-req-menu-popup">
                                                <a class="buyer-req-menu-check" target="#br6">
                                                    <img class="dots-img" src="./images/Buyer_Requests/dots.png">
                                                </a>
                                                <div id="br6" class="buyer-req-menu-show">
                                                    <p><a href="#">Download Note</a></p>
                                                </div>
                                            </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>Accounts</td>
                                    <td>Commerce</td>
                                    <td>testting123@gmail.com</td>
                                    <td>+91 9874563527</td>
                                    <td>Free</td>
                                    <td>$0</td>
                                    <td>27 Nov 2020, 11:24:34</td>
                                    <td>
                                        <img class="eye-img" src="./images/Buyer_Requests/eye.png">
                                    
                                            <div class="buyer-req-menu-popup">
                                                <a class="buyer-req-menu-check" target="#br7">
                                                    <img class="dots-img" src="./images/Buyer_Requests/dots.png">
                                                </a>
                                                <div id="br7" class="buyer-req-menu-show">
                                                    <p><a href="#">Download Note</a></p>
                                                </div>
                                            </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>Social Studies</td>
                                    <td>Social</td>
                                    <td>testting123@gmail.com</td>
                                    <td>+91 9874563527</td>
                                    <td>Free</td>
                                    <td>$0</td>
                                    <td>27 Nov 2020, 11:24:34</td>
                                    <td>
                                        <img class="eye-img" src="./images/Buyer_Requests/eye.png">
                                    
                                            <div class="buyer-req-menu-popup">
                                                <a class="buyer-req-menu-check" target="#br8">
                                                    <img class="dots-img" src="./images/Buyer_Requests/dots.png">
                                                </a>
                                                <div id="br8" class="buyer-req-menu-show">
                                                    <p><a href="#">Download Note</a></p>
                                                </div>
                                            </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>AI</td>
                                    <td>IT</td>
                                    <td>testting123@gmail.com</td>
                                    <td>+91 9874563527</td>
                                    <td>Paid</td>
                                    <td>$250</td>
                                    <td>27 Nov 2020, 11:24:34</td>
                                    <td>
                                        <img class="eye-img" src="./images/Buyer_Requests/eye.png">
                                    
                                            <div class="buyer-req-menu-popup">
                                                <a class="buyer-req-menu-check" target="#br9">
                                                    <img class="dots-img" src="./images/Buyer_Requests/dots.png">
                                                </a>
                                                <div id="br9" class="buyer-req-menu-show">
                                                    <p><a href="#">Download Note</a></p>
                                                </div>
                                            </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>Lorem ipsum</td>
                                    <td>Lorem</td>
                                    <td>testting123@gmail.com</td>
                                    <td>+91 9874563527</td>
                                    <td>Free</td>
                                    <td>$115</td>
                                    <td>27 Nov 2020, 11:24:34</td>
                                    <td>
                                        <img class="eye-img" src="./images/Buyer_Requests/eye.png">
                                    
                                            <div class="buyer-req-menu-popup">
                                                <a class="buyer-req-menu-check" target="#br10">
                                                    <img class="dots-img" src="./images/Buyer_Requests/dots.png">
                                                </a>
                                                <div id="br10" class="buyer-req-menu-show">
                                                    <p><a href="#">Download Note</a></p>
                                                </div>
                                            </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="part3">
                    <div class="row">
                        <!-- Pagination-->
                        <center>
                            <div class="pagination-section">
                                    <ul class="pagination">
                                        <li class="page-item">
                                            <a class="page-link" href="#">
                                                <img class="left-arrow-img" src="./images/My_Sold_Notes/left-arrow.png">
                                            </a>
                                        </li>
                                        <li class="page-item"><a id="one" class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a id="two" class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a id="three" class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a id="four" class="page-link" href="#">4</a></li>
                                        <li class="page-item"><a id="five" class="page-link" href="#">5</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">
                                                <img class="right-arrow-img" src="./images/My_Sold_Notes/right-arrow.png">
                                            </a>
                                        </li>
                                    </ul>
                            </div>
                        </center>
                        <!-- Pagination Ends -->
                    </div>
               
            
        </div>
    </div>
    <!-- Buyer Requests Ends -->
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
                        <li><a href="#"><img src="images/Buyer_Requests/facebook.png"></a></li>
                        <li><a href="#"><img src="images/Buyer_Requests/twitter.png"></a></li>
                        <li><a href="#"><img src="images/Buyer_Requests/linkedin.png"></a></li>
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