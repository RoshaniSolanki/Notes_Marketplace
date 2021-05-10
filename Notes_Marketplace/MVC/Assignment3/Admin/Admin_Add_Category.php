<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();

if(isset($_SESSION['userid'])) {
    $admin_id = $_SESSION['userid'];
    
    if(isset($_POST['submit'])) {
        $category_name = escape_string($_POST['category-name']);
        $description   = escape_string($_POST['description']);

        $createdDate = date("Y-m-d H:i:s");
        $modifiedDate = date("Y-m-d H:i:s");

        $insert_query = query("INSERT INTO note_categories(Category_Name, Description, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy) 
        VALUES('{$category_name}', '{$description}', '{$createdDate}', '{$admin_id}', '{$modifiedDate}', '{$admin_id}')");
        confirm($insert_query);
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
                                placeholder="Enter your category" required>
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
    <!-- Add Category Ends -->
    <?php include "footer.php"; ?>