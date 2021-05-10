<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();


if(isset($_POST['search-btn'])) {

    $search_result = $_POST['search'];
    $select_query = query("SELECT * FROM note_types WHERE (Type_Name LIKE '%$search_result%' OR Description LIKE '%$search_result%') ORDER BY CreatedDate DESC");
    confirm($select_query);

}else {

    $select_query = query("SELECT * FROM note_types ORDER BY CreatedDate DESC");
    confirm($select_query);

}
if(isset($_GET['typeid'])) {

    $typeid = $_GET['typeid'];
    
    $delete_type = query("UPDATE note_types SET IsActive = 0 WHERE ID = '$typeid' ");
    confirm($delete_type);
    redirect("Admin_Manage_Type.php");
}
?>
<?php include "header.php"; ?>

    <!-- Manage Type -->
    <div id="adminManageType">
        <div class="container">
                <div id="part1">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Manage Type</p>
                        </div>
                    </div>
                </div>
                <div id="part2">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="Admin_Add_Type.php"><button class="btn btn-primary add-type-btn">ADD TYPE</button></a>
                        </div>
                        <div class="col-md-6">
                        <form action="" method="POST">
                            <span><img class="search-icon-img" src="./images/Admin/Manage_Type/search-icon.png"></span>
                            <input type="text" name="search" id="search" placeholder="Search">
                            <button type="submit" name="search-btn" class="btn btn-primary search-btn">SEARCH</button>
                        </div>
                    </div>
                </div>
                <div id="part3">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table" id="manage-type-table">
                                <thead>
                                    <tr>
                                        <th>SR NO.</th>
                                        <th>TYPE</th>
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

                                        $type_id = $row['ID'];
                                        $type_name = $row['Type_Name'];
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
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $type_name; ?></td>
                                    <td><?php echo $description; ?></td>
                                    <td><?php echo $date_added; ?></td>
                                    <td><?php echo $added_by; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td><a href="Admin_Add_Type.php?type_id=<?php echo $type_id; ?>"><img class="edit-img"
                                            src="./images/Admin/Manage_Type/edit.png"></a>
                                        <a href="Admin_Manage_Type.php?typeid=<?php echo $type_id; ?>" onclick="check_delete()"><img class="delete-img"
                                            src="./images/Admin/Manage_Type/delete.png"></a>
                                    </td>
                                </tr>
                                <?php $i++; }?>
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
            return confirm("Are you sure you want to make this type inactive?");
        }
                
    </script>
    
    <?php include "footer.php"; ?>