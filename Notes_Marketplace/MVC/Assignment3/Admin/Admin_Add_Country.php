<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();


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
    }
}
?>
<?php include "header.php"; ?>
    <!-- Add Country -->
    <div id="adminAddCountry">
        <form>
            <div class="container">
                <p class="heading">Add Country</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="countryName" for="countryName">Country Name *</label>
                            <input type="text" name="country-name" id="country-name" class="form-control"
                                placeholder="Enter your country" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="countryCode" for="countryCode">Country Code *</label>
                            <input type="text" name="country-code" id="country-code" class="form-control"
                                placeholder="Enter country code" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" name="submit" class="btn btn-primary submit-btn">SUBMIT</button>
                    </div>
                
                </div>
            </div>
        </form>
    </div>
    <!-- Add Country Ends -->
    <?php include "footer.php"; ?>