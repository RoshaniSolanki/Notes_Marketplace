<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();


if(isset($_SESSION['email']) && $_SESSION['roleid']==3) {
    $user_id = $_SESSION['userid'];



if(isset($_POST['progress_notes_search_btn'])) {

    $search = $_POST['search_progress_notes'];

    $select_in_progress_notes = query("SELECT * FROM seller_notes WHERE Title LIKE '%$search%' AND Status IN(6,7,8) AND IsActive = 1 ORDER BY CreatedDate DESC");
    confirm($select_in_progress_notes);


}else {   

$select_in_progress_notes = query("SELECT * FROM seller_notes WHERE Status IN(6,7,8) AND IsActive = 1 ORDER BY CreatedDate DESC");
confirm($select_in_progress_notes);
                            
}


if(isset($_POST['published_notes_search_btn'])) {

    $search = $_POST['search_published_notes'];

    $select_published_notes = query("SELECT * FROM seller_notes WHERE Title LIKE '%$search%' AND Status=9 AND IsActive = 1 ORDER BY CreatedDate DESC");
    confirm($select_published_notes); 


}else {   

    $select_published_notes = query("SELECT * FROM seller_notes WHERE Status=9 AND IsActive = 1 ORDER BY CreatedDate DESC");
    confirm($select_published_notes);
                          
}

}else{
    redirect("Login.php");
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $update_query = query("UPDATE seller_notes SET IsActive = 0 WHERE ID = '$id' ");
    confirm($update_query);
    redirect("Dashboard.php");
}


?>

    <?php include "header.php"; ?>

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
                                                    <?php 
                                                        $find_sold_count = query("SELECT DISTINCT seller_notes.ID FROM seller_notes LEFT JOIN downloads ON seller_notes.ID = downloads.NoteID WHERE 
                                                        seller_notes.SellerID = '$user_id' AND downloads.IsAttachementDownloaded = 1 ");
                                                        confirm($find_sold_count);

                                                        $sold_count = mysqli_num_rows($find_sold_count);
                                                    ?>
                                                    <p><a href="My_Sold_Notes.php"><?php echo $sold_count; ?></a></p>
                                                </div>
                                                <div class="row text2">
                                                    <p>Number of Notes Sold</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <div class="row text1">
                                                <?php 
                                                    $find_total_earning = query("SELECT SUM(SellingPrice) as earning FROM seller_notes LEFT JOIN downloads ON seller_notes.ID = downloads.NoteID WHERE 
                                                    seller_notes.SellerID = '$user_id' AND downloads.IsAttachementDownloaded = 1 ");
                                                    confirm($find_total_earning);

                                                    while($row = mysqli_fetch_assoc($find_total_earning)) {
                                                        $total_earning = $row['earning'];
                                                    }
                                                ?>
                                                    <p><a href="My_Sold_Notes.php">&#36;<?php echo $total_earning; ?></a></p>
                                                </div>
                                                <div class="row text2">
                                                    <p>Money Earned</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-4 box3">
                                            <div class="row text1">
                                            <?php 
                                               $find_download_count = query("SELECT DISTINCT seller_notes.ID FROM seller_notes LEFT JOIN downloads ON seller_notes.ID = downloads.NoteID 
                                               WHERE downloads.Seller = '$user_id' AND downloads.IsAttachementDownloaded = 1 ");
                                               confirm($find_download_count);

                                               $download_count = mysqli_num_rows($find_download_count);    
                                            ?>
                                                <p><a href="My_Downloads.php"><?php echo $download_count; ?></a></p>
                                            </div>
                                            <div class="row text2">
                                                <p>My Downloads</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-4 box3">
                                            <div class="row text1">
                                            <?php 
                                                $find_reject_count = query("SELECT seller_notes.ID FROM seller_notes WHERE seller_notes.SellerID = '$user_id' AND 
                                                seller_notes.Status = 10 ");
                                                confirm($find_reject_count);

                                                $reject_count = mysqli_num_rows($find_reject_count);
                                            ?>
                                                <p><a href="My_Rejected_Notes.php"><?php echo $reject_count; ?></a></p>
                                            </div>
                                            <div class="row text2">
                                                <p>My Rejected<br>Notes</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-4 box3">
                                            <div class="row text1">
                                            <?php 
                                               $find_buyer_requests_count = query("SELECT DISTINCT seller_notes.ID FROM seller_notes LEFT JOIN downloads ON 
                                               seller_notes.ID = downloads.NoteID WHERE downloads.Seller = '$user_id' AND downloads.IsSellerHasAllowedDownload = 1 ");
                                               confirm($find_buyer_requests_count);

                                               $buyer_requests_count = mysqli_num_rows($find_buyer_requests_count);    
                                            ?>
                                                <p><a href="Buyer_Requests.php"><?php echo $buyer_requests_count; ?></a></p>
                                            </div>
                                            <div class="row text2">
                                                <p>Buyer Requests</p>
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
                                    <a href=""><button type="submit" name="progress_notes_search_btn"
                                            class="btn btn-primary dashboard-search-btn">SEARCH</button></a>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div id="part2">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    <table class="table" id="in-progress-notes-table">
                                        <?php 
                                    ?>
                                        <thead>
                                        <tr>
                                            <th style="display:none;"></th>
                                            <th>ADDED DATE</th>
                                            <th>TITLE</th>
                                            <th>CATEGORY</th>
                                            <th>STATUS</th>
                                            <th>ACTION</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <?php 
                                    $i=1;
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
                                            <td style="display:none;"><?php echo $i;?></td>
                                            <td><?php echo $added_date ?></td>
                                            <td><?php echo $title ?></td>
                                            <td><?php echo $Category ?></td>
                                            <td><?php echo $Status ?></td>
                                            <?php if($Status == 'Draft') { ?>
                                            <td><a href="add_notes.php?note_id=<?php echo $note_id; ?>"><img
                                                        class="edit-img" src="./images/Dashboard/edit.png"></a>
                                                <a href="Dashboard.php?id=<?php echo $note_id; ?>"
                                                    onclick="return check_delete()"><img
                                                        src="./images/Dashboard/delete.png"></a></td>
                                            <?php } ?>
                                            <?php if($Status != 'Draft') { ?>
                                            <td><a href="Note_Details_Page.php?Note_id=<?php echo $note_id; ?>"><img
                                                        src="./images/Dashboard/eye.png"></a></td>
                                            <?php } ?>
                                        </tr>

                                        <?php
                                    $i++;}?>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
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
                                    <input type="text" name="search_published_notes" class="search"
                                        placeholder="Search">
                                    <a href=""><button name="published_notes_search_btn"
                                            class="btn btn-primary dashboard-search-btn">SEARCH</button></a>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="part2">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    <table class="table" id="published-notes-table">
                                        <thead>
                                        <tr>
                                            <th style="display:none;"></th>
                                            <th>ADDED DATE</th>
                                            <th>TITLE</th>
                                            <th>CATEGORY</th>
                                            <th>SELL TYPE</th>
                                            <th>PRICE</th>
                                            <th>ACTION</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <?php 
                                            $i=1;
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
                                            <td style="display:none;"><?php echo $i;?></td>
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
                                            <td><a href="Note_Details_Page.php?Note_id=<?php echo $note_id; ?>"><img
                                                        src="./images/Dashboard/eye.png"></a></td>
                                        </tr>

                                        <?php
                                   $i++; }
                                    
                                    
                                    ?>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Dashboard Ends -->
        <script>
        
            function check_delete() {
                return confirm("Are you sure, you want to delete this note?");
            }
                
        </script>
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


        <script src="js/datatables.js"></script>

        <!-- Custom JS -->
        <script src="js/script.js"></script>
    </section>
</body>

</html>
