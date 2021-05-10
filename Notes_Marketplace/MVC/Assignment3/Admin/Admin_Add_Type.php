<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();


if(isset($_SESSION['userid'])) {
    $admin_id = $_SESSION['userid'];
    
    if(isset($_POST['submit'])) {
        $type_name     = escape_string($_POST['type']);
        $description   = escape_string($_POST['description']);

        $createdDate = date("Y-m-d H:i:s");
        $modifiedDate = date("Y-m-d H:i:s");

        $insert_query = query("INSERT INTO note_types(Type_Name, Description, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy) 
        VALUES('{$type_name}', '{$description}', '{$createdDate}', '{$admin_id}', '{$modifiedDate}', '{$admin_id}')");
        confirm($insert_query);
    }
}
?>

<?php include "header.php"; ?>

    <!-- Add Country -->
    <div id="adminAddType">
        <form action="" method="POST">
            <div class="container">
                <p class="heading">Add Type</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="type" for="type">Type *</label>
                            <input type="text" name="type" id="type" class="form-control"
                                placeholder="Enter your type" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="description" for="description">Description *</label>
                            <input type="text" name="description" id="description" class="form-control"
                                placeholder="Enter your description" required>
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
    <!-- Add Type Ends -->
    <?php include "footer.php"; ?>