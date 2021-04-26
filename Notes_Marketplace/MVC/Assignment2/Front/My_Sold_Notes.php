<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();

if(isset($_SESSION['email'])) {
    $user_id = $_SESSION['userid'];



    if(isset($_POST['search-btn'])) {

        $search_result = $_POST['search'];
        
        $select_query = query("SELECT downloads.* , users.EmailID FROM downloads LEFT JOIN users ON downloads.Downloader=users.ID 
        WHERE (downloads.NoteTitle LIKE '%$search_result%' OR downloads.NoteCategory LIKE '%$search_result%' OR downloads.PurchasedPrice LIKE '%$search_result%')
        AND downloads.Downloader=$user_id AND IsSellerHasAllowedDownload = 1 AND AttachementPath IS NOT NULL ORDER BY downloads.AttachementDownloadedDate DESC");
        confirm($select_query);

    }else {

        $select_query = query("SELECT downloads.* , users.EmailID FROM downloads LEFT JOIN users ON downloads.Downloader=users.ID 
        WHERE downloads.Downloader=$user_id AND IsSellerHasAllowedDownload = 1 AND AttachementPath IS NOT NULL ORDER BY downloads.AttachementDownloadedDate DESC");
        confirm($select_query);

    }
}else{
    redirect("Login.php");
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
    <!-- My Sold Notes -->
    <div id="mySoldNotes">
        <div class="container">

            <div id="part1">
                <div class="row">
                    <div class="col-md-5 col-sm-4 col-xs-4">
                        <p>My Sold Notes</p>
                    </div>
                    <div class="col-md-7 col-sm-8 col-xs-8">
                        <form action="" method="POST">
                            <input type="text" name="search" id="search" placeholder="Search"><span><img
                                    class="search-icon-img" src="./images/My_Sold_Notes/search-icon.png"></span>
                            <button type="submit" name="search-btn" class="btn btn-primary my-sold-notes-search-btn">SEARCH</button></a>
                        </form>
                    </div>
                </div>
            </div>
            <div id="part2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table" id="my-sold-note-table">
                                <thead>
                                <tr>
                                    <th>SR NO.</th>
                                    <th>NOTE TITLE</th>
                                    <th>CATEGORY</th>
                                    <th>BUYER</th>
                                    <th>SELL TYPE</th>
                                    <th>PRICE</th>
                                    <th>DOWNLOADED DATE/TIME</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $i=1;
                                    while($buyer_row = mysqli_fetch_assoc($select_query)) {
                                        $note_id       = $buyer_row['NoteID'];
                                        $ispaid        = $buyer_row['IsPaid'];
                                        $price         = $buyer_row['PurchasedPrice'];
                                        $note_title    = $buyer_row['NoteTitle'];
                                        $note_category = $buyer_row['NoteCategory'];
                                        $downloader    = $buyer_row['Downloader'];

                                        $db_download_date = $buyer_row['AttachementDownloadedDate'];
                                        $db_download_date_timestamp = strtotime($db_download_date);
                                        $download_date = date('d M Y, H:i:s', $db_download_date_timestamp); 

                                        $select_email = query("SELECT EmailID FROM users WHERE ID = '{$downloader}' ");
                                        confirm($select_email);

                                        while($email_row = mysqli_fetch_assoc($select_email)) {
                                            $buyer_email = $email_row['EmailID'];
                                        }


                                        if($ispaid == 0) {
                                            $sell_type = 'Free';
                                            $price =0;
                                        }else {
                                            $sell_type = 'Paid';
                                        }
                                ?>
                                
                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $note_title; ?></td>
                                    <td><?php echo $note_category; ?></td>
                                    <td><?php echo $buyer_email; ?></td>
                                    <td><?php echo $sell_type; ?></td>
                                    <td>&#36;<?php echo $price; ?></td>
                                    <td><?php echo $download_date; ?></td>
                                    <td><a href="Note_Details_Page.php?Note_id=<?php echo $note_id; ?>"><img
                                                class="eye-img" src="./images/My_Sold_Notes/eye.png"></a>

                                        <div class="my-sold-menu-popup">
                                            <a class="my-sold-menu-check" target="#ms<?php echo $i;?>">
                                                <img class="dots-img" src="./images/My_Sold_Notes/dots.png">
                                            </a>
                                            <div id="ms<?php echo $i;?>" class="my-sold-menu-show">
                                                <p><a href="#">Download Note</a></p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <?php    
                                $i++;}
                            ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- My Sold Notes Ends -->
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
                            <li><a href="#"><img src="images/My_Sold_Notes/facebook.png"></a></li>
                            <li><a href="#"><img src="images/My_Sold_Notes/twitter.png"></a></li>
                            <li><a href="#"><img src="images/My_Sold_Notes/linkedin.png"></a></li>
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

        <script src="js/datatables.js"></script>

        <!-- Custom JS -->
        <script src="js/script.js"></script>
</body>

</html>