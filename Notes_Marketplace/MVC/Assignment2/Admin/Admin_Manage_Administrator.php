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
                    <a href="Home_Page.html">
                        <img class="logo" src="images/Admin/Add_Category/logo.png" alt="logo">
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
    <!-- Manage Administrator -->
    <div id="adminManageAdministrator">
        <div class="container">
                <div id="part1">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Manage Administrator</p>
                        </div>
                    </div>
                </div>
                <div id="part2">
                    <div class="row">
                        <div class="col-md-6">
                            <a href=""><button class="btn btn-primary add-administrator-btn">ADD ADMINISTRATOR</button></a>
                        </div>
                        <div class="col-md-6">
                            <span><img class="search-icon-img" src="./images/Admin/Manage_Administrator/search-icon.png"></span>
                            <input type="text" name="search" id="search" placeholder="Search">
                            <a href=""><button class="btn btn-primary search-btn">SEARCH</button></a>
                        </div>
                    </div>
                </div>
                <div id="part3">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>SR NO.</th>
                                    <th>FIRST NAME</th>
                                    <th>LAST NAME</th>
                                    <th>EMAIL</th>
                                    <th>PHONE NO.</th>
                                    <th>DATE ADDED</th>
                                    <th>ACTIVE</th>
                                    <th>ACTION</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Khayati</td>
                                    <td>Patel</td>
                                    <td>khayatipatel@gmail.com</td>
                                    <td>9897959512</td>
                                    <td>09-10-2020, 10:10</td>
                                    <td>Yes</td>
                                    <td><img class="edit-img"
                                            src="./images/Admin/Manage_Administrator/edit.png">
                                        <img class="delete-img"
                                            src="./images/Admin/Manage_Administrator/delete.png">
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Rahul</td>
                                    <td>Shah</td>
                                    <td>radhulshah@gmail.com</td>
                                    <td>9945321851</td>
                                    <td>10-10-2020, 12:30</td>
                                    <td>Yes</td>
                                    <td><img class="edit-img"
                                        src="./images/Admin/Manage_Administrator/edit.png">
                                    <img class="delete-img"
                                        src="./images/Admin/Manage_Administrator/delete.png">
                                </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Suman</td>
                                    <td>Trivedi</td>
                                    <td>sumantrivedi@gmail.com</td>
                                    <td>7852189120</td>
                                    <td>11-10-2020, 01:00</td>
                                    <td>No</td>
                                    <td><img class="edit-img"
                                        src="./images/Admin/Manage_Administrator/edit.png">
                                    <img class="delete-img"
                                        src="./images/Admin/Manage_Administrator/delete.png">
                                </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Raj</td>
                                    <td>Malhotra</td>
                                    <td>rajmalhotra@gmail.com</td>
                                    <td>9852656874</td>
                                    <td>12-10-2020, 10:10</td>
                                    <td>Yes</td>
                                    <td><img class="edit-img"
                                        src="./images/Admin/Manage_Administrator/edit.png">
                                    <img class="delete-img"
                                        src="./images/Admin/Manage_Administrator/delete.png">
                                </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Niya</td>
                                    <td>Patel</td>
                                    <td>niyapatel12@gmail.com</td>
                                    <td>851694532</td>
                                    <td>13-10-2020, 11:25</td>
                                    <td>No</td>
                                    <td><img class="edit-img"
                                        src="./images/Admin/Manage_Administrator/edit.png">
                                    <img class="delete-img"
                                        src="./images/Admin/Manage_Administrator/delete.png">
                                </td>
                                </tr>
        
                            </table>
                        </div>
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
                                                <img class="left-arrow-img" src="./images/Admin/Manage_Administrator/left-arrow.png">
                                            </a>
                                        </li>
                                        <li class="page-item"><a id="one" class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a id="two" class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a id="three" class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a id="four" class="page-link" href="#">4</a></li>
                                        <li class="page-item"><a id="five" class="page-link" href="#">5</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">
                                                <img class="right-arrow-img" src="./images/Admin/Manage_Administrator/right-arrow.png">
                                            </a>
                                        </li>
                                    </ul>
                            </div>
                        </center>
                        <!-- Pagination Ends -->
                    </div>
                </div>
            
    </div>
    <!-- Manage Administrator Ends -->
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