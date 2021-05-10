<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();

if(isset($_SESSION['userid'])) {
    $admin_id = $_SESSION['userid'];

    if(isset($_GET['type_id'])) {
        $type_id = $_GET['type_id'];

        $select = query("SELECT * FROM note_types WHERE ID = '{$type_id}' ");
        confirm($select);

        while($row = mysqli_fetch_assoc($select)) {
            $db_type = $row['Type_Name'];
            $db_description = $row['Description'];
        }

        if(isset($_POST['submit1'])) {
            $type_name     = escape_string($_POST['type']);
            $description   = escape_string($_POST['description']);
    
            $modifiedDate = date("Y-m-d H:i:s");
    
            $insert_query = query("UPDATE note_types SET Type_Name = '{$type_name}', Description = '{$description}', ModifiedDate = '{$modifiedDate}',
            ModifiedBy = '{$admin_id}' WHERE ID = '{$type_id}' ");
            confirm($insert_query);
    
        }
    }else {

        if(isset($_POST['submit2'])) {
            $type_name     = escape_string($_POST['type']);
            $description   = escape_string($_POST['description']);
    
            $createdDate = date("Y-m-d H:i:s");
            $modifiedDate = date("Y-m-d H:i:s");
    
            $insert_query = query("INSERT INTO note_types(Type_Name, Description, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy) 
            VALUES('{$type_name}', '{$description}', '{$createdDate}', '{$admin_id}', '{$modifiedDate}', '{$admin_id}')");
            confirm($insert_query);
    
            if($insert_query) {
                echo "<script>alert('Inserted Successfully..........');</script>";
            }
        }

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
                                placeholder="Enter your type" value="<?php if(isset($_GET['type_id'])) { echo $db_type; }?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="description" for="description">Description *</label>
                            <input type="text" name="description" id="description" class="form-control"
                                placeholder="Enter your description" value="<?php if(isset($_GET['type_id'])) { echo $db_description; }?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?php if(isset($_GET['type_id'])) {?>
                            <button type="submit" name="submit1" class="btn btn-primary submit-btn">SUBMIT</button>
                        <?php }else {?>
                            <button type="submit" name="submit2" class="btn btn-primary submit-btn">SUBMIT</button>
                        <?php } ?>  
                    </div>
                
                </div>
            </div>
        </form>
    </div>
    <!-- Add Type Ends -->
    <?php include "footer.php"; ?>