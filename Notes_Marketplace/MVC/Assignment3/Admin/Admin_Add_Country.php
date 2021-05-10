<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();

if(isset($_SESSION['userid'])) {
    $admin_id = $_SESSION['userid'];

    if(isset($_GET['country_id'])) {
        $country_id = $_GET['country_id'];

        $select = query("SELECT * FROM countries WHERE ID = '{$country_id}' ");
        confirm($select);

        while($row = mysqli_fetch_assoc($select)) {
            $db_country_name = $row['Country_Name'];
            $db_country_code = $row['CountryCode'];
        }

        if(isset($_POST['submit1'])) {
            $country_name = escape_string($_POST['country-name']);
            $country_code   = escape_string($_POST['country-code']);
    
            $modifiedDate = date("Y-m-d H:i:s");
    
            $insert_query = query("UPDATE countries SET Country_Name = '{$country_name}', CountryCode = '{$country_code}', ModifiedDate = '{$modifiedDate}',
            ModifiedBy = '{$admin_id}' WHERE ID = '{$country_id}' ");
            confirm($insert_query);
    
        }
    }else {

        if(isset($_POST['submit2'])) {
            $country_name = escape_string($_POST['country-name']);
            $country_code   = escape_string($_POST['country-code']);
    
            $createdDate = date("Y-m-d H:i:s");
            $modifiedDate = date("Y-m-d H:i:s");
    
            $insert_query = query("INSERT INTO countries(Country_Name, CountryCode, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy) 
            VALUES('{$country_name}', '{$country_code}', '{$createdDate}', '{$admin_id}', '{$modifiedDate}', '{$admin_id}')");
            confirm($insert_query);
    
            if($insert_query) {
                echo "<script>alert('Inserted Successfully..........');</script>";
            }
        }

    }
    
    
}
if(isset($_SESSION['userid'])) {
    $admin_id = $_SESSION['userid'];
    
    if(isset($_POST['submit'])) {
        $category_name = escape_string($_POST['country-name']);
        $description   = escape_string($_POST['country-code']);

        $createdDate = date("Y-m-d H:i:s");
        $modifiedDate = date("Y-m-d H:i:s");

        $insert_query = query("INSERT INTO countries(Country_Name, CountryCode, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy) 
        VALUES('{$category_name}', '{$description}', '{$createdDate}', '{$admin_id}', '{$modifiedDate}', '{$admin_id}')");
        confirm($insert_query);

        if($insert_query) {
            echo "<script>alert('Inserted Successfully..........');</script>";
        }
    }
}
?>
<?php include "header.php"; ?>
    <!-- Add Country -->
    <div id="adminAddCountry">
        <form action="" method="POST">
            <div class="container">
                <p class="heading">Add Country</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="countryName" for="countryName">Country Name *</label>
                            <input type="text" name="country-name" id="country-name" class="form-control"
                                placeholder="Enter your country" value="<?php if(isset($_GET['country_id'])) { echo $db_country_name; }?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="countryCode" for="countryCode">Country Code *</label>
                            <input type="text" name="country-code" id="country-code" class="form-control"
                                placeholder="Enter country code" value="<?php if(isset($_GET['country_id'])) { echo $db_country_code; }?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <?php if(isset($_GET['country_id'])) { ?>
                        <button type="submit" name="submit1" class="btn btn-primary submit-btn">SUBMIT</button>
                    <?php }else {?>
                        <button type="submit" name="submit2" class="btn btn-primary submit-btn">SUBMIT</button>
                    <?php    }?>
                    </div>
                
                </div>
            </div>
        </form>
    </div>
    <!-- Add Country Ends -->
    <?php include "footer.php"; ?>