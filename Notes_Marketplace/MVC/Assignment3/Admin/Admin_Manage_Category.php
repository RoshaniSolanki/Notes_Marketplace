<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();

if(isset($_POST['search-btn'])) {

    $search_result = $_POST['search'];
    $select_query = query("SELECT * FROM note_categories WHERE (Category_Name LIKE '%$search_result%' OR Description LIKE '%$search_result%') ORDER BY CreatedDate DESC");
    confirm($select_query);

}else {

    $select_query = query("SELECT * FROM note_categories ORDER BY CreatedDate DESC");
    confirm($select_query);

}
if(isset($_GET['catid'])) {

    $catid = $_GET['catid'];
    
    $delete_cat = query("UPDATE note_categories SET IsActive = 0 WHERE ID = '$catid' ");
    confirm($delete_cat);
    redirect("Admin_Manage_Category.php");
}
?>
<?php include "header.php"; ?>

    <!-- Manage Category -->
    <div id="adminManageCategory">
        <div class="container">
                <div id="part1">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Manage Category</p>
                        </div>
                    </div>
                </div>
                <div id="part2">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="Admin_Add_Category.php"><button class="btn btn-primary add-category-btn">ADD CATEGORY</button></a>
                        </div>
                        <div class="col-md-6">
                            <form action="" method="POST">
                            <span><img class="search-icon-img" src="./images/Admin/Manage_Category/search-icon.png"></span>
                            <input type="text" name="search" id="search" placeholder="Search">
                            <button type="submit" name="search-btn" class="btn btn-primary search-btn">SEARCH</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="part3">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table" id="manage-category-table">
                                <thead>
                                    <tr>
                                        <th>SR NO.</th>
                                        <th>CATEGORY</th>
                                        <th>DESCRIPTION</th>
                                        <th>DATE ADDED</th>
                                        <th>ADDED BY</th>
                                        <th>ACTIVE</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>  
                                <tbody>  
                                <?php
                                $i=1;
                                    while($row = mysqli_fetch_assoc($select_query)) {

                                        $cat_id = $row['ID'];
                                        $cat_name = $row['Category_Name'];
                                        $description = $row['Description'];
                                        $db_date_added = $row['CreatedDate'];
                                        $added_by_id   = $row['CreatedBy'];
                                        $isactive = $row['IsActive'];

                                        $db_date_timestamp = strtotime($db_date_added);
                                        $date_added = date('d-m-Y, H:i', $db_date_timestamp);

                                            //added_by info
                                            $find_added_by_info = query("SELECT FirstName, LastName FROM users WHERE ID = '{$added_by_id}' ");
                                            confirm($find_added_by_info);

                                            while($row = mysqli_fetch_assoc($find_added_by_info)) {
                                                $added_by = $row['FirstName'] . " " . $row['LastName'];
                                            }

                                            if($isactive == 0){
                                                $active = 'No';
                                            }else {
                                                $active = 'Yes';
                                            }
                                    ?>

                                <tr>
                                    <td><?php echo $i ;?></td>
                                    <td><?php echo $cat_name ;?></td>
                                    <td><?php echo $description ;?></td>
                                    <td><?php echo $date_added ;?></td>
                                    <td><?php echo $added_by ;?></td>
                                    <td><?php echo $active ;?></td>
                                    <td><a href="Admin_Add_Category.php?cat_id=<?php echo $cat_id;?>"><img class="edit-img"
                                            src="./images/Admin/Manage_Category/edit.png"></a>
                                        <a href="Admin_Manage_Category.php?catid=<?php echo $cat_id;?>" onclick="return check_delete()"><img class="delete-img"
                                            src="./images/Admin/Manage_Category/delete.png"></a>
                                    </td>
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
    <!-- Manage Category Ends -->

    <script>
                
        function check_delete() {
            return confirm("Are you sure you want to make this category inactive?");
        }
                
    </script>

    <?php include "footer.php"; ?>