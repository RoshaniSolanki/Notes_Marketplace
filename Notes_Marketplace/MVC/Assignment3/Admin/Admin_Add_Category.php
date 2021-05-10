<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();

if(isset($_SESSION['userid'])) {
    $admin_id = $_SESSION['userid'];

    if(isset($_GET['cat_id'])) {
        $cat_id = $_GET['cat_id'];

        $select = query("SELECT * FROM note_categories WHERE ID = '{$cat_id}' ");
        confirm($select);

        while($row = mysqli_fetch_assoc($select)) {
            $db_cat = $row['Category_Name'];
            $db_description = $row['Description'];
        }

        if(isset($_POST['submit1'])) {
            $category_name = escape_string($_POST['category-name']);
            $description   = escape_string($_POST['description']);
    
            $modifiedDate = date("Y-m-d H:i:s");
    
            $insert_query = query("UPDATE note_categories SET Category_Name = '{$category_name}', Description = '{$description}', ModifiedDate = '{$modifiedDate}',
            ModifiedBy = '{$admin_id}' WHERE ID = '{$cat_id}' ");
            confirm($insert_query);
    
        }
    }else {

        if(isset($_POST['submit2'])) {
            $category_name = escape_string($_POST['category-name']);
            $description   = escape_string($_POST['description']);
    
            $createdDate = date("Y-m-d H:i:s");
            $modifiedDate = date("Y-m-d H:i:s");
    
            $insert_query = query("INSERT INTO note_categories(Category_Name, Description, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy) 
            VALUES('{$category_name}', '{$description}', '{$createdDate}', '{$admin_id}', '{$modifiedDate}', '{$admin_id}')");
            confirm($insert_query);
    
            if($insert_query) {
                echo "<script>alert('Inserted Successfully..........');</script>";
            }
        }

    }
    
    
}
?>

<?php include "header.php"; ?>
    <!-- Add Category -->
    <div id="adminAddCategory">
        <form action="" method="post">
            <div class="container">
                <p class="heading">Add Category</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="categoryName" for="categoryName">Category Name *</label>
                            <input type="text" name="category-name" id="category-name" class="form-control"
                                placeholder="Enter your category" value="<?php if(isset($_GET['cat_id'])) { echo $db_cat; }?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="description" for="description">Description *</label>
                            <input type="text" name="description" id="description" class="form-control"
                                placeholder="Enter your description"value="<?php if(isset($_GET['cat_id'])) { echo $db_description; }?>"  required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <?php if(isset($_GET['cat_id'])) {?>
                        <button type="submit" name="submit1" class="btn btn-primary submit-btn">SUBMIT</button>
                    <?php }else {?>
                        <button type="submit" name="submit2" class="btn btn-primary submit-btn">SUBMIT</button>
                    <?php } ?>   
                    </div>
                
                </div>
            </div>
        </form>
    </div>
    <!-- Add Category Ends -->
    <?php include "footer.php"; ?>