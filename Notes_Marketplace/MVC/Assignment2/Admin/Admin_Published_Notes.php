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
                        <a class="navbar-brand" href="Admin_Dashboard.html">
                            <img src="images/Admin/Dashboard/logo.png" alt="logo">
                        </a>
                    </div>

                    <!-- Main Menu -->
                    <div class="container">
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav pull-right">
                                <li><a href="Admin_Dashboard.html">Dashboard</a></li>
                                <li><a href="#">Notes</a></li>
                                <li><a href="#">Members</a></li>
                                <li><a href="#">Reports</a></li>
                                <li><a href="#">Settings</a></li>
                                <li>
                                    <div class="admin-user-menu-popup">
                                        <a class="admin-user-menu-check" target=".admin-user-menu-show"><img
                                                src="images/Admin/Dashboard/user-img.png" class="user-img" width="40"
                                                height="40" alt="user-img"></a>
                                        <div class="admin-user-menu-show">
                                            <p><a href="#">Update Profile</a></p>
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
                        <a href="Admin_Dashboard.html">
                            <img class="logo" src="images/Admin/Dashboard/logo.png" alt="logo">
                        </a>
                        
                        <!-- Mobile Menu close Button -->
                        <span id="mobile-nav-close-btn">&times;</span>
                        
                        <div id="mobile-nav-content">
                            <ul class="nav">
                                <li>
                                    <a href="Admin_Dashboard.html">Dashboard</a>
                                </li>
                                <li>
                                    <a href="#">Notes</a>
                                </li>
                                <li><a href="#">Members</a></li>
                                <li>
                                    <a href="#">Reports</a>
                                </li>

                                <li>
                                    <a href="#">Settings</a>
                                </li>
                                <li><a href="#"><img src="images/Admin/Dashboard/user-img.png" class="user-img" width="40" height="40"
                                    alt="user-img"></a></li>
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
    <!-- Published Notes-->
    <div id="adminPublishedNotes">
        <div class="container">
            <div id="part1">
                <div class="row">
                    <div class="col-md-12">
                        <p>Published Notes</p>
                    </div>
                </div>
            </div>
            <div id="part2">
                <div class="row">
                    <div class="col-md-12">
                        <label class="seller" for="seller">Seller</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <span><img class="arrow-down-img"
                                    src="./images/Admin/Published_Notes/down-arrow.png"></span>
                            <select class="form-control" id="seller" name="seller">
                                <option selected disabled hidden>Khayati</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-8 col-xs-8">
                        
                            <span><img class="search-icon-img"
                                    src="./images/Admin/Published_Notes/search-icon.png"></span>
                            <input type="text" name="search" id="search" placeholder="Search">
                            <a href=""><button class="btn btn-primary search-btn">SEARCH</button></a>
                        
                    </div>
                </div>
            </div>
            <div id="part3">
                <div class="row">
                    <div class="col-md-12">
                        <table>
                            <tr>
                                <th>SR NO.</th>
                                <th>NOTE TITLE</th>
                                <th>CATEGORY</th>
                                <th>SELL TYPE</th>
                                <th>PRICE</th>
                                <th>SELLER</th>
                                <th>PUBLISHED DATE</th>
                                <th>APPROVED BY</th>
                                <th>NUMBER OF<br>DOWNLOADS</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Software Engineer</td>
                                <td>IT</td>
                                <td>Paid</td>
                                <td>$145</td>
                                <td>Rahul Shah<span><img class="eye-img" src="./images/Admin/Published_Notes/eye.png"></span></td>
                                <td>25-11-2020, 11:08</td>
                                <td>Raj Sheth</td>
                                <td>75</td>
                                <td>
                                    <div class="admin-menu-popup">
                                        <a class="admin-menu-check" target="#apn1">
                                            <img class="dots-img" src="images/Admin/Spam_Reports/dots.png">
                                        </a>
                                        <div id="apn1" class="admin-menu-show">
                                            <p><a href="#">Download Notes</a></p>
                                            <p><a href="#">View More Details</a></p>
                                            <p><a href="#">Unpublish</a></p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Computer Basic</td>
                                <td>Computer</td>
                                <td>Free</td>
                                <td>$0</td>
                                <td>Rahul Shah<span><img class="eye-img" src="./images/Admin/Published_Notes/eye.png"></span></td>
                                <td>10-10-2020, 12:30</td>
                                <td>Khayati Patel</td>
                                <td>20</td>
                                <td>
                                    <div class="admin-menu-popup">
                                        <a class="admin-menu-check" target="#apn2">
                                            <img class="dots-img" src="images/Admin/Spam_Reports/dots.png">
                                        </a>
                                        <div id="apn2" class="admin-menu-show">
                                            <p><a href="#">Download Notes</a></p>
                                            <p><a href="#">View More Details</a></p>
                                            <p><a href="#">Unpublish</a></p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Human Body</td>
                                <td>Science</td>
                                <td>Paid</td>
                                <td>$204</td>
                                <td>Rahul Shah<span><img class="eye-img" src="./images/Admin/Published_Notes/eye.png"></span></td>
                                <td>8-11-2020, 04:07</td>
                                <td>Raj Sheth</td>
                                <td>45</td>
                                <td>
                                    <div class="admin-menu-popup">
                                        <a class="admin-menu-check" target="#apn3">
                                            <img class="dots-img" src="images/Admin/Spam_Reports/dots.png">
                                        </a>
                                        <div id="apn3" class="admin-menu-show">
                                            <p><a href="#">Download Notes</a></p>
                                            <p><a href="#">View More Details</a></p>
                                            <p><a href="#">Unpublish</a></p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>world war 2</td>
                                <td>History</td>
                                <td>Paid</td>
                                <td>$58</td>
                                <td>Rahul Shah<span><img class="eye-img" src="./images/Admin/Published_Notes/eye.png"></span></td>
                                <td>17-10-2020, 12:30</td>
                                <td>Raj Sheth</td>
                                <td>25</td>
                                <td>
                                    <div class="admin-menu-popup">
                                        <a class="admin-menu-check" target="#apn4">
                                            <img class="dots-img" src="images/Admin/Spam_Reports/dots.png">
                                        </a>
                                        <div id="apn4" class="admin-menu-show">
                                            <p><a href="#">Download Notes</a></p>
                                            <p><a href="#">View More Details</a></p>
                                            <p><a href="#">Unpublish</a></p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Accounting</td>
                                <td>Account</td>
                                <td>Free</td>
                                <td>$0</td>
                                <td>Rahul Shah<span><img class="eye-img" src="./images/Admin/Published_Notes/eye.png"></span></td>
                                <td>12-12-2020, 17:45</td>
                                <td>Niya Patel</td>
                                <td>8</td>
                                <td>
                                    <div class="admin-menu-popup">
                                        <a class="admin-menu-check" target="#apn5">
                                            <img class="dots-img" src="images/Admin/Spam_Reports/dots.png">
                                        </a>
                                        <div id="apn5" class="admin-menu-show">
                                            <p><a href="#">Download Notes</a></p>
                                            <p><a href="#">View More Details</a></p>
                                            <p><a href="#">Unpublish</a></p>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
            <div id="part4">
                <div class="row">
                    <!-- Pagination-->
                    <center>
                        <div class="pagination-section">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="#">
                                            <img class="left-arrow-img"
                                                src="./images/Admin/Published_Notes/left-arrow.png">
                                        </a>
                                    </li>
                                    <li class="page-item"><a id="one" class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a id="two" class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a id="three" class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a id="four" class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a id="five" class="page-link" href="#">5</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">
                                            <img class="right-arrow-img"
                                                src="./images/Admin/Published_Notes/right-arrow.png">
                                        </a>
                                    </li>
                                </ul>
                        </div>
                    </center>
                    <!-- Pagination Ends -->
                </div>
            </div>

        </div>
        <!-- Published Notes Ends -->
        <!-- Footer -->
        <footer class="admin-footer">
            <hr>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="footer-text-left">Version : 1.1.24</p>
                    </div>
                    <div class="col-md-6">
                        <p class="footer-text-right">
                            Copyright &copy; TatvaSoft All rights reserved.
                        </p>
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