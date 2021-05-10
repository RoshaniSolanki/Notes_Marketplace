<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();

if(isset($_POST['search-btn'])) {

    $search_result = $_POST['search'];

    $select_admin = query("SELECT users.*, user_profile.PhoneNumber, countries.CountryCode FROM users LEFT JOIN user_profile ON users.ID = user_profile.UserID LEFT JOIN 
    countries ON user_profile.PhoneNumberCountryCode = countries.ID WHERE (FirstName LIKE '%$search_result%' OR LastName LIKE '%$search_result%' OR EmailID LIKE '%$search_result%' 
    OR PhoneNumber LIKE '%$search_result%' OR users.CreatedDate LIKE '%$search_result%') AND  RoleID = 2 AND users.IsActive = 1 ORDER BY users.CreatedDate DESC");
    confirm($select_admin);
    
}else {

    $select_admin = query("SELECT users.*, user_profile.PhoneNumber, countries.CountryCode FROM users LEFT JOIN user_profile ON users.ID = user_profile.UserID LEFT JOIN 
    countries ON user_profile.PhoneNumberCountryCode = countries.ID WHERE RoleID = 2 AND users.IsActive = 1 ORDER BY users.CreatedDate DESC");
    confirm($select_admin);
}


if(isset($_GET['admin_id'])) {

    $adminID = $_GET['admin_id'];
    
    $delete_admin = query("UPDATE users SET IsActive = 0 WHERE ID = '$adminID' ");
    confirm($delete_admin);
    redirect("Admin_Manage_Administrator.php");
}

?>

<?php include "header.php"; ?>


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
                            <a href="Admin_Add_Administrator.php"><button class="btn btn-primary add-administrator-btn">ADD ADMINISTRATOR</button></a>
                        </div>
                        <div class="col-md-6">
                            <form action="" method="post">
                                <span><img class="search-icon-img" src="./images/Admin/Manage_Administrator/search-icon.png"></span>
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
                            <table class="table" id="manage-administrator-table">
                                <thead>
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
                                </thead>
                                <tbody>
                                    <?php
                                    $i=1;
                                    while($row = mysqli_fetch_assoc($select_admin)) {

                                        $admin_id     = $row['ID'];
                                        $first_name   = $row['FirstName'];
                                        $last_name    = $row['LastName'];
                                        $email        = $row['EmailID'];
                                        $country_code = $row['CountryCode'];
                                        $phone_number = $row['PhoneNumber'];
                                        $isactive     = $row['IsActive'];
                                        $db_date      = $row['CreatedDate'];

                                        $db_date_timestamp = strtotime($db_date);
                                        $date_added        = date('d-m-Y, H:i', $db_date_timestamp);

                                        if($isactive == 1) {
                                            $active = 'Yes';
                                        }else {
                                            $active = 'No';
                                        }
                                    
                                    ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $first_name; ?></td>
                                    <td><?php echo $last_name; ?></td>
                                    <td><?php echo $email; ?></td>
                                    <td><?php echo $country_code." ".$phone_number; ?></td>
                                    <td><?php echo $date_added; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <a href="Admin_Add_Administrator.php?Admin_id=<?php echo $admin_id;?>"><img class="edit-img"
                                            src="./images/Admin/Manage_Administrator/edit.png"></a>
                                        <a href="Admin_Manage_Administrator.php?admin_id=<?php echo $admin_id;?>" onclick="check_delete()"><img class="delete-img"
                                            src="./images/Admin/Manage_Administrator/delete.png"></a>
                                    </td>
                                </tr>
                                    <?php $i++; } ?>
                            </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            
    </div>
    <!-- Manage Administrator Ends -->
    <script>
                
        function check_delete() {
            return confirm("Are you sure you want to make this administrator inactive?");
        }
                
    </script>
    <?php include "footer.php"; ?>