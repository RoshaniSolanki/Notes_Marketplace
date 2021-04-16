<?php
include "../includes/db.php";
include "../includes/functions.php";

if(isset($_GET['order'])) {
    $order = $_GET['order'];
}else {
    $order = 'CreatedDate';
}

if(isset($_GET['sort'])) {
    $sort = $_GET['sort'];
}else {
    $sort = 'DESC';
}


/* In Progress Notes */
if(isset($_GET['page_t1'])) {

    $page_t1 = $_GET['page_t1'];
}else {
    $page_t1 = 1;
}

$item_per_page_t1 = 5;
$start_from_t1 = ($page_t1-1)*5;

if(isset($_POST['progress_notes_search_btn'])) {

    $search = $_POST['search_progress_notes'];

    $select_in_progress_notes = query("SELECT * FROM seller_notes WHERE Title LIKE '%$search%' AND Status IN(6,7,8) ORDER BY CreatedDate DESC LIMIT $start_from_t1,$item_per_page_t1");
    confirm($select_in_progress_notes);

    $total_progress_notes = mysqli_num_rows($select_in_progress_notes);
    $total_page_t1 = ceil($total_progress_notes/$item_per_page_t1);
                                    
    $count = mysqli_num_rows($select_in_progress_notes);

    if($count == 0) {
        echo "<script>alert('No record found');</script>";
    }

}else {   

$select_in_progress_notes = query("SELECT * FROM seller_notes WHERE Status IN(6,7,8) ORDER BY $order $sort LIMIT $start_from_t1,$item_per_page_t1");
confirm($select_in_progress_notes);
                            
    $total_progress_notes = mysqli_num_rows($select_in_progress_notes);
    $total_page_t1 = ceil($total_progress_notes/$item_per_page_t1); 
                            
}


/* Published Notes */
if(isset($_GET['page_t2'])) {

    $page_t2 = $_GET['page_t2'];
}else {
    $page_t2 = 1;
}

$item_per_page_t2 = 5;
$start_from_t2 = ($page_t2-1)*5;

if(isset($_POST['published_notes_search_btn'])) {

    $search = $_POST['search_published_notes'];

    $select_published_notes = query("SELECT * FROM seller_notes WHERE Title LIKE '%$search%' AND Status=9 ORDER BY CreatedDate LIMIT $start_from_t1,$item_per_page_t1");
    confirm($select_published_notes); 

    $total_published_notes = mysqli_num_rows($select_published_notes);
    $total_page_t1 = ceil($total_published_notes/$item_per_page_t1);
                                    
    $count = mysqli_num_rows($select_published_notes);

    if($count == 0) {
        echo "<script>alert('No record found');</script>";
    }

}else {   

    $select_published_notes = query("SELECT * FROM seller_notes WHERE Status=9 ORDER BY CreatedDate DESC LIMIT $start_from_t2,$item_per_page_t2");
    confirm($select_published_notes);
                            
    $total_published_notes = mysqli_num_rows($select_published_notes);
    $total_page_t2 = ceil($total_published_notes/$item_per_page_t2);
                            
}

 /*                           
$p_query_t2 = query("SELECT * FROM seller_notes");
confirm($p_query_t2);
$total_progress_notes_t2 = mysqli_num_rows($p_query_t2);
$total_page_t2 = ceil($total_progress_notes_t2/$item_per_page_t2);
*/



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

    <!-- Font Awesome CSS -->
    <!--link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'-->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/paper/bootstrap.min.css" /-->

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
</head>

<body>
    <section id="dashboard">
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
                                    <li><a href="Buyer_Requests.html">Buyer Requests</a></li>
                                    <li><a href="FAQ.html">FAQ</a></li>
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
        <!-- Header Ends -->
        <!-- Dashboard -->
        <div id="dashboard">
            <div class="container">
                <div id="section1">
                    <div id="part1">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <h1>Dashboard</h1>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <a href="Add_Notes.php"><button class="btn btn-primary dashboard-add-note-btn">ADD
                                        NOTE</button></a>
                            </div>
                        </div>
                    </div>
                    <div id="part2">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-7 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-4 box1">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12"><img
                                                        src="images/Dashboard/my-earning.png"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12 text1">
                                                    <p>My Earning</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-xs-8 box2">
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <div class="row text1">
                                                    <p>100</p>
                                                </div>
                                                <div class="row text2">
                                                    <p><a href="My_Sold_Notes.php">Number of Notes Sold</a></p>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <div class="row text1">
                                                    <p>$10,00,000</p>
                                                </div>
                                                <div class="row text2">
                                                    <p><a href="My_Sold_Notes.php">Money Earned</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-4 box3">
                                            <div class="row text1">
                                                <p>38</p>
                                            </div>
                                            <div class="row text2">
                                                <p><a href="My_Downloads.php">My Downloads</a></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-4 box3">
                                            <div class="row text1">
                                                <p>12</p>
                                            </div>
                                            <div class="row text2">
                                                <p><a href="My_Rejected_Notes.php">My Rejected<br>Notes</a></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-4 box3">
                                            <div class="row text1">
                                                <p>102</p>
                                            </div>
                                            <div class="row text2">
                                                <p><a href="Buyer_Requests.php">Buyer Requests</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="section2">
                    <div id="part1">
                        <div class="row">
                            <div class="col-md-6 col-sm-4 col-xs-4">
                                <p>In Progress Notes</p>
                            </div>
                            
                            <div class="col-md-6 col-sm-8 col-xs-8">
                            <form action="" method="POST">
                                <span><img class="dashboard-search-icon-img"
                                        src="./images/My_Download/search-icon.png"></span>
                                <input type="text" name="search_progress_notes" class="search" placeholder="Search">
                                <a href=""><button type="submit" name="progress_notes_search_btn" class="btn btn-primary dashboard-search-btn">SEARCH</button></a>
                                </form></div>
                            
                        </div>
                    </div>
                    <div id="part2">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <table>

                                    <?php 
                                        $sort == 'DESC' ? $sort = 'ASC' : $sort = 'DESC';
                                    ?>
                                    <tr>
                                        <th><a href="Dashboard.php?order=CreatedDate&&sort=<?php $sort ?>">ADDED DATE</a></th>
                                        <th><a href="Dashboard.php?order=Title&&sort=<?php $sort ?>">TITLE</a></th>
                                        <th><a href="Dashboard.php?order=Category&&sort=<?php $sort ?>">CATEGORY</a></th>
                                        <th><a href="Dashboard.php?order=Status&&sort=<?php $sort ?>">STATUS</a></th>
                                        <th><a>ACTION</a></th>
                                    </tr>
                                    <tr>
                                    <?php 

                                    while($row = mysqli_fetch_assoc($select_in_progress_notes)) {

                                        $note_id    = $row['ID'];
                                        $created_date = $row['CreatedDate'];
                                        $date = new DateTime($created_date);
                                        $added_date = $date->format('Y-m-d');
                                        $title      = $row['Title'];
                                        $category   = $row['Category'];
                                        $status     = $row['Status'];
                                    
                                        $select_category = query("SELECT * FROM note_categories WHERE ID = '$category' ");
                                        confirm($select_category);
                                        while($category_row = mysqli_fetch_assoc($select_category))
                                        {
                                            $Category = $category_row['Category_Name'];
                                        }

                                        $select_status = query("SELECT * FROM reference_data WHERE ID = '$status' ");
                                        confirm($select_status);
                                        while($status_row = mysqli_fetch_assoc($select_status))
                                        {
                                            $Status = $status_row['Value'];
                                        }
                                    
                                    ?>
                                                <td><?php echo $added_date ?></td>
                                                <td><?php echo $title ?></td>
                                                <td><?php echo $Category ?></td>
                                                <td><?php echo $Status ?></td>
                                                <?php if($Status == 'Draft') { ?>
                                                <td><a href="add_notes.php?note_id=<?php echo $note_id; ?>"><img class="edit-img" src="./images/Dashboard/edit.png"></a>
                                                <a href="delete_note.php?id=<?php echo $note_id; ?>" onclick="return check_delete()"><img
                                                src="./images/Dashboard/delete.png"></a></td>
                                                <?php } ?>
                                                <?php if($Status != 'Draft') { ?>
                                                <td><a href="Note_Details_Page.php?Note_id=<?php echo $note_id; ?>"><img src="./images/Dashboard/eye.png"></a></td>
                                                <?php } ?>
                                            </tr>
                                    
                                    <?php
                                    }?>
                                    
                                    <?php
                                    /*if(isset($_POST['progress_notes_search_btn'])) {

                                        $search = $_POST['search_progress_notes'];
                                    
                                        $find_status = query("SELECT * FROM reference_data");
                                        confirm($find_status);
                                    
                                        $search_query = query("SELECT * FROM seller_notes WHERE Title LIKE '%$search%' ORDER BY CreatedDate LIMIT $start_from_t1,$item_per_page_t1");
                                        confirm($search_query);
                                    
                                        $count = mysqli_num_rows($search_query);
                                    
                                        if($count == 0) {
                                            echo "<script>alert('No record found');</script>";
                                        }else {
                                            //echo "<script>alert('record found');</script>";
                                            while($srow = mysqli_fetch_assoc($search_query)) {

                                                $note_id1    = $srow['ID'];
                                                $created_date1 = $srow['CreatedDate'];
                                                $date1 = new DateTime($created_date1);
                                                $added_date1 = $date1->format('Y-m-d');
                                                $title1      = $srow['Title'];
                                                $category1   = $srow['Category'];
                                                $status1     = $srow['Status'];
                                            
                                                $search_category = query("SELECT * FROM note_categories WHERE ID = '$category1' ");
                                                confirm($search_category);
                                                while($search_cat_row = mysqli_fetch_assoc($search_category))
                                                {
                                                    $Cat = $search_cat_row['Category_Name'];
                                                }
        
                                                $search_status = query("SELECT * FROM reference_data WHERE ID = '$status1' ");
                                                confirm($search_status);
                                                while($search_status_row = mysqli_fetch_assoc($search_status))
                                                {
                                                    $Sta = $search_status_row['Value'];
                                                }
                                            
                                            ?>
                                                        <td><?php echo $added_date1 ?></td>
                                                        <td><?php echo $title1 ?></td>
                                                        <td><?php echo $Cat ?></td>
                                                        <td><?php echo $Sta ?></td>
                                                        <?php if($Sta == 'Draft') { ?>
                                                        <td><a href="add_notes.php?note_id=<?php echo $note_id1; ?>"><img class="edit-img" src="./images/Dashboard/edit.png"></a>
                                                        <a href="delete_note.php?id=<?php echo $note_id1; ?>" onclick="return check_delete()"><img
                                                        src="./images/Dashboard/delete.png"></a></td>
                                                        <?php } ?>
                                                        <?php if($Sta != 'Draft') { ?>
                                                        <td><a href="Note_Details_Page.php"><img src="./images/Dashboard/eye.png"></a></td>
                                                        <?php } ?>
                                                    </tr>
                                            
                                            <?php
                                            }
                                        }
                                    
                                    }*/
                                    
                                    ?>
                                    
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

                                            <?php 
                                            if($page_t1>1){
                                             echo "<a class='page-link' href='Dashboard.php?page_t1=".($page_t1-1)."'>
                                             <img class='left-arrow-img' src='./images/search-page/left-arrow.png'></a>";
                                            }
                                            ?>
                                            
                                        </li>
                                        <?php 

                                            for($i=1;$i<=$total_page_t1;$i++) {

                                                if($i==$page_t1){
                                                    
                                                    echo "<li class='page-item'><a class='page-link active-link' href='Dashboard.php?page_t1=".$i."'>$i</a></li>";

                                                }else {

                                                    echo "<li class='page-item'><a class='page-link' href='Dashboard.php?page_t1=".$i."'>$i</a></li>";

                                                }
                                                
                                            }

                                        ?>
                                        
                                        <li class="page-item">

                                        <?php 
                                             if($i>$page_t1){
                                             echo "<a class='page-link' href='Dashboard.php?page_t1=".($page_t1+1)."'>
                                             <img class='right-arrow-img' src='./images/search-page/right-arrow.png'></a>";
                                             }
                                        ?>

                                        </li>
                                    </ul>

                                </div>
                            </center>
                            <!-- Pagination Ends -->
                        </div>
                    </div>
                </div>
                <div id="section3">
                    <div id="part1">
                        <div class="row">
                            <div class="col-md-6 col-sm-4 col-xs-4">
                                <p>Published Notes</p>
                            </div>
                            <div class="col-md-6 col-sm-8 col-xs-8">
                            <form action="" method="POST">
                                <span><img class="dashboard-search-icon-img"
                                        src="./images/My_Download/search-icon.png"></span>
                                <input type="text" name="search_published_notes" class="search" placeholder="Search">
                                <a href=""><button name="published_notes_search_btn" class="btn btn-primary dashboard-search-btn">SEARCH</button></a>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="part2">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <table>
                                    <tr>
                                        <th><a href="">ADDED DATE</a></th>
                                        <th><a href="">TITLE</a></th>
                                        <th><a href="">CATEGORY</a></th>
                                        <th><a href="">SELL TYPE</a></th>
                                        <th><a href="">PRICE</a></th>
                                        <th><a href="">ACTION</a></th>
                                    </tr>
                                    <tr>
                                    <?php 
                                    while($row1 = mysqli_fetch_assoc($select_published_notes)) {

                                        $note_id = $row1['ID'];
                                        $created_date = $row1['CreatedDate'];
                                        $date = new DateTime($created_date);
                                        $added_date = $date->format('Y-m-d');
                                        $title      = $row1['Title'];
                                        $category   = $row1['Category'];
                                        $ispaid     = $row1['IsPaid'];
                                        $price      = $row1['SellingPrice'];

                                        $select_category = query("SELECT * FROM note_categories WHERE ID = '$category' ");
                                        confirm($select_category);
                                        while($category_row = mysqli_fetch_assoc($select_category))
                                        {
                                            $Category = $category_row['Category_Name'];
                                        }
                                    
                                    ?>
                                                <td><?php echo $added_date ?></td>
                                                <td><?php echo $title ?></td>
                                                <td><?php echo $Category ?></td>
                                                <?php if($ispaid = 1) { ?>
                                                <td>Paid</td>
                                                <?php } ?>
                                                <?php if($ispaid = 0) { ?>
                                                <td>Free</td>
                                                <?php } ?>
                                                <td><?php echo $price ?></td>
                                                <td><a href="Note_Details_Page.php?Note_id=<?php echo $note_id; ?>"><img src="./images/Dashboard/eye.png"></a></td>
                                            </tr>
                                    
                                    <?php
                                    }
                                    
                                    
                                    ?>
                                    
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

                                            <?php
                                            if($page_t2>1){
                                             echo "<a class='page-link' href='Dashboard.php?page_t2=".($page_t2-1)."'>
                                             <img class='left-arrow-img' src='./images/search-page/left-arrow.png'></a>";
                                            }
                                            ?>
                                            
                                        </li>
                                        <?php 

                                            for($i=1;$i<=$total_page_t2;$i++) {

                                                if($i==$page_t2){
                                                    
                                                    echo "<li class='page-item'><a class='page-link active-link' href='Dashboard.php?page_t2=".$i."'>$i</a></li>";

                                                }else {

                                                    echo "<li class='page-item'><a class='page-link' href='Dashboard.php?page_t2=".$i."'>$i</a></li>";

                                                }
                                                
                                            }

                                        ?>
                                        
                                        <li class="page-item">

                                        <?php 
                                            if($i>$page_t2){
                                             echo "<a class='page-link' href='Dashboard.php?page_t2=".($page_t2+1)."'>
                                             <img class='right-arrow-img' src='./images/search-page/right-arrow.png'></a>";
                                            }
                                        ?>

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
        <!-- Dashboard Ends -->
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
<script>
    function check_delete() {
        return confirm("Are you sure, you want to delete this note?");
    }
</script>