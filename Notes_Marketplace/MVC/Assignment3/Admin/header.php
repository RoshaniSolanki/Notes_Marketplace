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

        <!-- Datatables -->
        <link rel="stylesheet" href="css/datatables.css">
    
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
                        <a class="navbar-brand" href="Admin_Dashboard.php">
                            <img src="images/Admin/Dashboard/logo.png" alt="logo">
                        </a>
                    </div>

                    <!-- Main Menu -->
                    <div class="container">
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav pull-right">
                                <li><a href="Admin_Dashboard.php">Dashboard</a></li>
                                <li>
                                <div class="admin-notes-popup">
                                        <a class="admin-notes-popup-check" target=".admin-notes-popup-show">Notes</a>
                                        <div class="admin-notes-popup-show">
                                            <p><a href="Admin_Notes_Under_Reb_Page.php">Notes Under Review</a></p>
                                            <p><a href="Admin_Published_Notes.php">Published Notes</a></p>
                                            <p><a href="Admin_Downloads_Notes.php">Downloaded Notes</a></p>
                                            <p><a href="Admin_Rejected_Notes.php">Rejected Notes</a></p>
                                        </div>
                                </div>
                                
                                </li>
                                <li><a href="Admin_Members.php">Members</a></li>
                                <li>
                                <div class="admin-report-popup">
                                        <a class="admin-report-popup-check" target=".admin-report-popup-show">Reports</a>
                                        <div class="admin-report-popup-show">
                                            <p><a href="Admin_Spam_Reports.php">Spam Reports</a></p>
                                        </div>
                                </div>
                                </li>
                                <li>
                                <div class="admin-setting-popup">
                                        <a class="admin-setting-popup-check" target=".admin-setting-popup-show">Settings</a>
                                        <div class="admin-setting-popup-show">
                                            <p><a href="Admin_Manage_System_Configuration.php">Manage System Configuration</a></p>
                                            <p><a href="Admin_Manage_Administrator.php">Manage Administrator</a></p>
                                            <p><a href="Admin_Manage_Category.php">Manage Category</a></p>
                                            <p><a href="Admin_Manage_Type.php">Manage Type</a></p>
                                            <p><a href="Admin_Manage_Country.php">Manage Countries</a></p>
                                        </div>
                                </div>
                                </li>
                                <li>
                                    <div class="admin-user-menu-popup">
                                        <a class="admin-user-menu-check" target=".admin-user-menu-show"><img
                                                src="images/Admin/Dashboard/user-img.png" class="user-img" width="40"
                                                height="40" alt="user-img"></a>
                                        <div class="admin-user-menu-show">
                                            <p><a href="Admin_Profile.php">Update Profile</a></p>
                                            <p><a href="../Front/Change_Password_Page.php">Change Password</a></p>
                                            <p><a href="../Front/Logout.php">LOGOUT</a></p>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="../Front/Logout.php">
                                        <button class="btn btn-primary logout-btn">Logout</button>
                                    </a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Mobile Menu -->
                    <div id="mobile-nav">

                        <!-- Logo -->
                    <a href="Home_Page.php">
                        <img class="logo" src="images/Admin/Add_Category/logo.png" alt="logo">
                    </a>

                        <!-- Mobile Menu close Button -->
                        <span id="mobile-nav-close-btn">&times;</span>

                        <div id="mobile-nav-content">
                            <ul class="nav">
                                <li>
                                    <a href="Admin_Dashboard.php">Dashboard</a>
                                </li>
                                <li>
                                    <a href="Admin_Notes_Under_Reb_Page.php">Notes Under Review</a>
                                </li>
                                <li>
                                    <a href="Admin_Published_Notes.php">Published Notes</a>
                                </li>
                                <li>
                                    <a href="Admin_Downloads_Notes.php">Downloaded Notes</a>
                                </li>
                                <li>
                                    <a href="Admin_Rejected_Notes.php">Rejected Notes</a>
                                </li>
                                <li>
                                    <a href="Admin_Members.php">Members</a>
                                </li>
                                <li>
                                    <a href="Admin_Spam_Reports.php">Spam Reports</a>
                                </li>

                                <li>
                                    <a href="Admin_Manage_System_Configuration.php">Manage System Configuration</a>
                                </li>
                                <li>
                                    <a href="Admin_Manage_Administrator.php">Manage Administrator</a>
                                </li>
                                <li>
                                    <a href="Admin_Manage_Category.php">Manage Category</a>
                                </li>
                                <li>
                                    <a href="Admin_Manage_Type.php">Manage Type</a>
                                </li>
                                <li>
                                    <a href="Admin_Manage_Country.php">Manage Countries</a>
                                </li>
                                <li>
                                    <a href="Admin_Profile.php">Update Profile<img src="images/Admin/Dashboard/user-img.png" class="user-img"
                                            width="40" height="40" alt="user-img"></a>
                                </li>
                                <li>
                                    <a href="../Front/Change_Password_Page.php">Change Password</a>
                                </li>
                                <li>
                                    <a href="../Front/Logout.php">
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