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
    <!-- Member Details -->
    <div id="adminMemberDetails">
        <div class="container">
            <div id="section1">
                <div id="part1">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Member Details</p>
                        </div>
                    </div>
                </div>
                <div id="part2">
                    <div class="row">
                        <div class="col-md-6 col-sm-7 col-xs-7">
                            <div class="row">
                                <div class="col-md-4 col-sm-3 col-xs-3">
                                    <img src="./images/Admin/Member_Details/member.png">
                                </div>
                                <div class="col-md-8 col-sm-9 col-xs-9">
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-5 text1">First Name:</div>
                                        <div class="col-md-7 col-sm-7 col-xs-7 text2">Richard</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-xs-5 text1">Last Name:</div>
                                        <div class="col-md-7 col-xs-7 text2">Brown</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-xs-5 text1">Email:</div>
                                        <div class="col-md-7 col-xs-7 text2">richardbrown77@gmail.com</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-xs-5 text1">DOB:</div>
                                        <div class="col-md-7 col-xs-7 text2">13-08-1990</div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-5 col-xs-5 text1">Phone Number:</div>
                                        <div class="col-md-7 col-xs-7 text2">9988731221</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-xs-5 text1">College/University:</div>
                                        <div class="col-md-7 col-xs-7 text2">University of California</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-1 col-xs-1 vl"></div>
                        <div class="col-md-5 col-sm-4 col-xs-4">
                            
                            <div class="row">
                                <div class="col-md-3 col-sm-5 col-xs-5 text1">Address 1:</div>
                                <div class="col-md-9 col-sm-7 col-xs-7 text2">144-Diamond Height</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-5 col-xs-5 text1">Address 2:</div>
                                <div class="col-md-9 col-sm-7 col-xs-7 text2">Star Colony</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-5 col-xs-5 text1">City:</div>
                                <div class="col-md-9 col-sm-7 col-xs-7 text2">New York</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-5 col-xs-5 text1">State:</div>
                                <div class="col-md-9 col-sm-7 col-xs-7 text2">New York State</div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-3 col-sm-5 col-xs-5 text1">Country:</div>
                                <div class="col-md-9 col-sm-7 col-xs-7 text2">United State</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-5 col-xs-5 text1">Zip Code:</div>
                                <div class="col-md-9 col-sm-7 col-xs-7 text2">11004-05</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr style="border-top: 2px solid #d1d1d1;">
            <div id="section2">
                <div id="part1">
                    <p>Notes</p>
                </div>
                <div id="part2">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>SR NO.</th>
                                    <th>NOTE TITLE</th>
                                    <th>CATEGORY</th>
                                    <th>STATUS</th>
                                    <th>DOWNLOADED NOTES</th>
                                    <th>TOTAL<br>EARNING</th>
                                    <th>DATE ADDED</th>
                                    <th>PUBLISHED DATE</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Software Development</td>
                                    <td>IT</td>
                                    <td>Published</td>
                                    <td>22</td>
                                    <td>$177</td>
                                    <td>09-10-2020, 10:10</td>
                                    <td>09-10-2020, 10:10</td>
                                    <td>
                                        <div class="admin-menu-popup">
                                            <a class="admin-menu-check" target="#amd1">
                                                <img class="dots-img" src="./images/Admin/Member_Details/dots.png">
                                            </a>
                                            <div id="amd1" class="admin-menu-show">
                                                <p><a href="#">Download Notes</a></p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Computer Basic</td>
                                    <td>Computer</td>
                                    <td>Published</td>
                                    <td>4</td>
                                    <td>$125</td>
                                    <td>10-10-2020, 11:25</td>
                                    <td>10-10-2020, 11:25</td>
                                    <td>
                                        <div class="admin-menu-popup">
                                            <a class="admin-menu-check" target="#amd2">
                                                <img class="dots-img" src="./images/Admin/Member_Details/dots.png">
                                            </a>
                                            <div id="amd2" class="admin-menu-show">
                                                <p><a href="#">Download Notes</a></p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Human Body</td>
                                    <td>Science</td>
                                    <td>InReview</td>
                                    <td>17</td>
                                    <td>$978</td>
                                    <td>11-10-2020, 01:00</td>
                                    <td>11-10-2020, 01:00</td>
                                    <td>
                                        <div class="admin-menu-popup">
                                            <a class="admin-menu-check" target="#amd3">
                                                <img class="dots-img" src="./images/Admin/Member_Details/dots.png">
                                            </a>
                                            <div id="amd3" class="admin-menu-show">
                                                <p><a href="#">Download Notes</a></p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>World War 2</td>
                                    <td>Histroy</td>
                                    <td>Published</td>
                                    <td>28</td>
                                    <td>$1525</td>
                                    <td>12-10-2020, 10:10</td>
                                    <td>12-10-2020, 10:10</td>
                                    <td>
                                        <div class="admin-menu-popup">
                                            <a class="admin-menu-check" target="#amd4">
                                                <img class="dots-img" src="./images/Admin/Member_Details/dots.png">
                                            </a>
                                            <div id="amd4" class="admin-menu-show">
                                                <p><a href="#">Download Notes</a></p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Accounting</td>
                                    <td>Account</td>
                                    <td>Published</td>
                                    <td>0</td>
                                    <td>$69</td>
                                    <td>13-10-2020, 11:25</td>
                                    <td>NA</td>
                                    <td>
                                        <div class="admin-menu-popup">
                                            <a class="admin-menu-check" target="#amd5">
                                                <img class="dots-img" src="./images/Admin/Member_Details/dots.png">
                                            </a>
                                            <div id="amd5" class="admin-menu-show">
                                                <p><a href="#">Download Notes</a></p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            </table>
                        </div>
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
                                                <img class="left-arrow-img"
                                                    src="./images/Admin/Member_Details/left-arrow.png">
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
                                                    src="./images/Admin/Member_Details/right-arrow.png">
                                            </a>
                                        </li>
                                    </ul>
                            </div>
                        </center>
                        <!-- Pagination Ends -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Member Details Ends -->
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