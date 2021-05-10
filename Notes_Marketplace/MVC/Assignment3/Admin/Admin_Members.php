<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();
    if(isset($_POST['search-btn'])) {

        $search_result = $_POST['search'];
        $select_query = query("SELECT * FROM users WHERE (FirstName LIKE '%$search_result%' OR LastName LIKE '%$search_result%' OR EmailID LIKE '%$search_result%' OR CreatedDate LIKE 
        '%$search_result%') AND RoleID = 3 AND IsActive = 1 ORDER BY CreatedDate DESC");
        confirm($select_query);

    }else {
        $select_query = query("SELECT * FROM users WHERE RoleID = 3 AND IsActive = 1 ORDER BY CreatedDate DESC");
        confirm($select_query);
    }

    
if(isset($_GET['member_id'])) {
   
    $member_id = $_GET['member_id'];
    
    $deacivate_member = query("UPDATE users SET IsActive = 0 WHERE ID = '$member_id' ");
    confirm($deacivate_member);
    
    $update_status = query("UPDATE seller_notes SET Status = 11 WHERE SellerID = '$member_id' AND Status = 9 ");
    confirm($update_status);

    redirect("Admin_Members.php");
    
    }
?>

<?php include "header.php"; ?>
    <!-- Members -->
    <div id="adminMembers">
        <div class="container">
                <div id="part1">
                    <div class="row">
                        <div class="col-md-5 col-sm-4 col-xs-4">
                            <p>Members</p>
                        </div>
                        <div class="col-md-7 col-sm-8 col-xs-8">
                            <form action="" method="POST">
                                <span><img class="search-icon-img" src="./images/Admin/Manage_Administrator/search-icon.png"></span>
                                <input type="text" name="search" id="search" placeholder="Search">
                                <button type="submit" name="search-btn" class="btn btn-primary search-btn">SEARCH</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="part2">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table" id="members-notes-table">
                                <thead>
                                    <tr>
                                        <th>SR NO.</th>
                                        <th>FIRST NAME</th>
                                        <th>LAST NAME</th>
                                        <th>EMAIL</th>
                                        <th>JOINING DATE</th>
                                        <th>UNDER REVIEW<br>NOTES</th>
                                        <th>PUBLISHED<br>NOTES</th>
                                        <th>DOWNLOADED<br>NOTES</th>
                                        <th>TOTAL<br>EXPENSES</th>
                                        <th>TOTAL<br>EARNING</th>
                                        <th></th>
                                    </tr>
                                <thead>
                                <tbody>
                                    <?php 
                                        $i = 1;
                                        while($row = mysqli_fetch_assoc($select_query)){
                                            $member_id    = $row['ID'];
                                            $first_name = $row['FirstName'];
                                            $last_name  = $row['LastName'];
                                            $email      = $row['EmailID'];
                                            $db_date    = $row['CreatedDate'];

                                            $db_date_timestamp = strtotime($db_date);
                                            $joining_date      = date('d-m-Y, H:i', $db_date_timestamp); 

                                            //under review notes
                                            $under_review = query("SELECT DISTINCT seller_notes.Title FROM seller_notes LEFT JOIN downloads ON seller_notes.ID = downloads.NoteID LEFT JOIN 
                                            reference_data ON seller_notes.Status = reference_data.ID WHERE reference_data.Value = 'In Review' AND downloads.Seller = '{$member_id}' ");
                                            confirm($under_review);

                                            $un_count = mysqli_num_rows($under_review);

                                            //published notes
                                            $published = query("SELECT DISTINCT seller_notes.Title FROM seller_notes LEFT JOIN downloads ON seller_notes.ID = downloads.NoteID LEFT JOIN 
                                            reference_data ON seller_notes.Status = reference_data.ID WHERE reference_data.Value = 'Published' AND downloads.Seller = '{$member_id}' ");
                                            confirm($published);

                                            $pub_count = mysqli_num_rows($published);

                                            //downloaded notes
                                            $downloaded = query("SELECT DISTINCT seller_notes.Title FROM seller_notes LEFT JOIN downloads ON seller_notes.ID = downloads.NoteID WHERE 
                                            downloads.IsAttachementDownloaded = 1 AND downloads.downloader = '{$member_id}' ");
                                            confirm($downloaded);

                                            $download_count = mysqli_num_rows($downloaded);

                                            //total expenses
                                            $find_total_expenses = query("SELECT SUM(PurchasedPrice) AS total_expenses FROM downloads WHERE downloads.IsAttachementDownloaded = 1 AND IsPaid = 1 AND
                                            downloads.downloader = '{$member_id}'");
                                            confirm($find_total_expenses);

                                            while($row = mysqli_fetch_assoc($find_total_expenses)) {
                                                $total_expenses = $row['total_expenses'];
                                            }

                                            //total earning
                                            $find_total_earning = query("SELECT SUM(PurchasedPrice) AS total_earning FROM downloads WHERE downloads.IsAttachementDownloaded = 1 AND IsPaid = 1 AND
                                            downloads.seller = '{$member_id}'");
                                            confirm($find_total_earning);

                                            while($row = mysqli_fetch_assoc($find_total_earning)) {
                                                $total_earning = $row['total_earning'];
                                            }
                                            

                                        ?>
                                        <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $first_name; ?></td>
                                        <td><?php echo $last_name; ?></td>
                                        <td><?php echo $email; ?></td>
                                        <td><?php echo $joining_date; ?></td>
                                        <td><a href="Admin_Notes_Under_Reb_Page.php?Member_id=<?php echo $member_id; ?>"><?php echo $un_count; ?></a></td>
                                        <td><a href="Admin_Published_Notes.php?Member_id=<?php echo $member_id; ?>"><?php echo $pub_count; ?></a></td>
                                        <td><a href="Admin_Downloads_Notes.php?Member_id=<?php echo $member_id; ?>"><?php echo $download_count; ?></a></td>
                                        <td><a href="Admin_Downloads_Notes.php?Member_id=<?php echo $member_id; ?>">&#36;<?php echo $total_expenses; ?></a></td>
                                        <td>&#36;<?php echo $total_earning; ?></td>
                                        <td>
                                            <div class="admin-menu-popup">
                                                <a class="admin-menu-check" target="#am<?php echo $i; ?>">
                                                    <img class="dots-img"
                                                src="./images/Admin/Members/dots.png">
                                                </a>
                                                <div id="am<?php echo $i; ?>" class="admin-menu-show">
                                                    <p><a href="Admin_Member_Details.php?Member_id=<?php echo $member_id; ?>">View More Details</a></p>
                                                    <p><a href="Admin_Members.php?member_id=<?php echo $member_id; ?>" onclick="deactivate_member()">Deactivate</a></p>
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
    <!-- Members Ends -->

    <script>
                
        function deactivate_member() {
            return confirm("Are you sure you want to make this member inactive?");
        }
                
    </script>
   
    <?php include "footer.php"; ?>