<?php
include "../includes/db.php";
include "../includes/functions.php";

session_start();

if(isset($_SESSION['email'])) {
    $user_id = $_SESSION['userid'];


    if(isset($_POST['search-btn'])) {

        $search_result = $_POST['search'];
        
        $select_query = query("SELECT seller_notes.ID, downloads.NoteTitle, downloads.NoteCategory, reference_data.Value, seller_notes.AdminRemarks, seller_notes.CreatedDate FROM 
        downloads LEFT JOIN users ON downloads.Downloader=users.ID LEFT JOIN seller_notes ON downloads.NoteID = seller_notes.ID LEFT JOIN reference_data ON 
        seller_notes.Status=reference_data.ID WHERE (downloads.NoteTitle LIKE '%$search_result%' OR downloads.NoteCategory LIKE '%$search_result%' OR seller_notes.AdminRemarks 
        LIKE '%$search_result%') AND downloads.Downloader=$user_id AND reference_data.Value = 'Rejected' ORDER BY downloads.AttachementDownloadedDate DESC");
        confirm($select_query);

    }else {

        $select_query = query("SELECT seller_notes.ID, downloads.NoteTitle, downloads.NoteCategory, reference_data.Value, seller_notes.AdminRemarks, seller_notes.CreatedDate FROM downloads LEFT JOIN users ON downloads.Downloader=users.ID LEFT JOIN seller_notes 
        ON downloads.NoteID = seller_notes.ID LEFT JOIN reference_data ON seller_notes.Status=reference_data.ID WHERE downloads.Downloader=$user_id AND reference_data.Value = 'Rejected' ORDER BY downloads.AttachementDownloadedDate DESC");
        confirm($select_query);

    }
    //download note 
    if(isset($_GET['Note_id'])){
        $note_id=$_GET['Note_id'];

        $find_path = query("SELECT * FROM seller_notes_attachements WHERE NoteID = '{$note_id}' ");
        confirm($find_path);

        $find_attachement_count = mysqli_num_rows($find_path);

        while($row = mysqli_fetch_assoc($find_path)) {
            $file_path = $row['FilePath'];
        }

        $find_note_title = query("SELECT Title FROM seller_notes WHERE ID = '{$note_id}' ");
        confirm($find_note_title);

        while($row = mysqli_fetch_assoc($find_note_title)) {
            $title = $row['Title'];
        }

        
        if($find_attachement_count==1){
        header('Cache-Control:public');
        header('Content-Description:File Transfer');
        header('Content-Disposition:attachment; filename='.$title.'.pdf');
        header('Control-Type:application/pdf');
        header('Content-Transfer-Encoding:binary');
        readfile($file_path);
        $date = date('Y-m-d H:i:s');

        $update_entry = query("UPDATE downloads SET AttachementDownloadedDate='$date', IsAttachementDownloaded = 1 WHERE NoteID = $note_id AND Downloader = $user_id AND IsSellerHasAllowedDownload = 1");
        confirm($update_entry);

        }
        else{
            
            $zipname = $title . '.zip';
            $zip = new ZipArchive;
            $zip->open($zipname, ZipArchive::CREATE);
            $find_path = query("SELECT * FROM seller_notes_attachements WHERE NoteID = '{$note_id}' ");
            confirm($find_path);
            while($row = mysqli_fetch_assoc($find_path)) {
                $attach_id = $row['FilePath'];
                $zip->addFile($attach_id);
            }
            $zip->close();
            header('Content-Type: application/zip');
            header('Content-disposition: attachment; filename=' . $zipname);
            header('Content-Length: ' . filesize($zipname));
            readfile($zipname);
            $date = date('Y-m-d H:i:s');
            $update_entry = query("UPDATE downloads SET AttachementDownloadedDate='$date', IsAttachementDownloaded = 1 WHERE NoteID = $note_id AND Downloader = $user_id AND IsSellerHasAllowedDownload = 1");
            confirm($update_entry);
        }

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
                            <img  class="logo" src="images/home/logo.png" alt="logo">
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
    <!-- My Rejected Notes -->
    <div id="myRejectedNotes">
        <div class="container">

            <div id="part1">
                <div class="row">
                    <div class="col-md-5 col-sm-4 col-xs-4">
                        <p>My Rejected Notes</p>
                    </div>
                    <div class="col-md-7 col-sm-8 col-xs-8">
                        <form action="" method="POST">
                        <input type="text" name="search" id="search" placeholder="Search">
                        <span><img class="search-icon-img" src="./images/My_Rejected_Notes/search-icon.png"></span>
                        <button type="submit" name="search-btn" class="btn btn-primary my-rejected-notes-search-btn">SEARCH</button>
                        </form>
                    </div>
                </div>
            </div>
            <div id="part2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                        <table class="table" id="my-rejected-notes-table">
                            <thead>
                            <tr>
                                <th>SR NO.</th>
                                <th>NOTE TITLE</th>
                                <th>CATEGORY</th>
                                <th>REMARKS</th>
                                <th>Date Edited</th>
                                <th>CLONE</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 

                            $i=1;
                            while($row = mysqli_fetch_assoc($select_query)){

                                $note_id = $row['ID'];
                                $note_title = $row['NoteTitle'];
                                $note_category = $row['NoteCategory'];
                                $remarks = $row['AdminRemarks'];
                                $db_date_edited = $row['CreatedDate'];

                                $db_date_timestamp = strtotime($db_date_edited);
                                $date_edited = date('d M Y, H:i:s', $db_date_timestamp); 

                                ?>

                                <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $note_title; ?></td>
                                <td><?php echo $note_category; ?></td>
                                <td><?php echo $remarks; ?></td>
                                <td><?php echo $date_edited; ?></td>
                                <td>Clone</td>
                                <td>
                                    <div class="my-rej-menu-popup">
                                        <a class="my-rej-menu-check" target="#mr<?php echo $i;?>">
                                            <img class="dots-img" src="./images/My_Rejected_Notes/dots.png">
                                        </a>
                                        <div id="mr<?php echo $i; ?>" class="my-rej-menu-show">
                                            <p><a href="My_Rejected_Notes.php?Note_id=<?php echo $note_id; ?>">Download Note</a></p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            }
                            $i++;
                            ?>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- My Rejected Notes Ends -->
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
                            <li><a href="#"><img src="images/My_Rejected_Notes/facebook.png"></a></li>
                            <li><a href="#"><img src="images/My_Rejected_Notes/twitter.png"></a></li>
                            <li><a href="#"><img src="images/My_Rejected_Notes/linkedin.png"></a></li>
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