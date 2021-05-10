<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();


if(isset($_POST['search-btn'])) {

    $search_result = $_POST['search'];
    $select_query = query("SELECT * FROM countries WHERE (Country_Name LIKE '%$search_result%' OR CountryCode LIKE '%$search_result%') ORDER BY CreatedDate DESC");
    confirm($select_query);

}else {

    $select_query = query("SELECT * FROM countries ORDER BY CreatedDate DESC");
    confirm($select_query);

}
if(isset($_GET['countryid'])) {

    $countryid = $_GET['countryid'];
    
    $delete_country = query("UPDATE countries SET IsActive = 0 WHERE ID = '$countryid' ");
    confirm($delete_country);
    redirect("Admin_Manage_Country.php");
}
?>
<?php include "header.php"; ?>

    <!-- Manage Country -->
    <div id="adminManageCountry">
        <div class="container">
                <div id="part1">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Manage Country</p>
                        </div>
                    </div>
                </div>
                <div id="part2">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="Admin_Add_Country.php"><button class="btn btn-primary add-country-btn">ADD COUNTRY</button></a>
                        </div>
                        <div class="col-md-6">
                        <form action="" method="POST">
                            <span><img class="search-icon-img" src="./images/Admin/Manage_Country/search-icon.png"></span>
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
                            <table class="table" id="manage-country-table">
                                <thead>
                                    <tr>
                                        <th>SR NO.</th>
                                        <th>COUNTRY NAME</th>
                                        <th>COUNTRY CODE</th>
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

                                        $country_id = $row['ID'];
                                        $country_name = $row['Country_Name'];
                                        $country_code = $row['CountryCode'];
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
                                    <td><?php echo $country_name; ?></td>
                                    <td><?php echo $country_code; ?></td>
                                    <td><?php echo $date_added ;?></td>
                                    <td><?php echo $added_by; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <a href="Admin_Add_Country.php?country_id=<?php echo $country_id;?>"><img class="edit-img"
                                            src="./images/Admin/Manage_Country/edit.png"></a>
                                        <a href="Admin_Manage_Country.php?countryid=<?php echo $country_id;?>" onclick="check_delete()"><img class="delete-img"
                                            src="./images/Admin/Manage_Country/delete.png"></a>
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
    <!-- Manage Country Ends -->

    <script>
                
        function check_delete() {
            return confirm("Are you sure you want to make this country inactive?");
        }
                
    </script>

    <?php include "footer.php"; ?>