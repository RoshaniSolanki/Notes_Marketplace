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
                            <a href=""><button class="btn btn-primary add-type-btn">ADD TYPE</button></a>
                        </div>
                        <div class="col-md-6">
                            <span><img class="search-icon-img" src="./images/Admin/Manage_Type/search-icon.png"></span>
                            <input type="text" name="search" id="search" placeholder="Search">
                            <a href=""><button class="btn btn-primary search-btn">SEARCH</button></a>
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
                                <tr>
                                    <td>1</td>
                                    <td>val 1</td>
                                    <td>Lorem Ipsum is simply dummy text</td>
                                    <td>09-10-2020, 10:10</td>
                                    <td>Khayati Patel</td>
                                    <td>Yes</td>
                                    <td><img class="edit-img"
                                            src="./images/Admin/Manage_Type/edit.png">
                                        <img class="delete-img"
                                            src="./images/Admin/Manage_Type/delete.png">
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Val 2</td>
                                    <td>Lorem Ipsum is simply dummy text</td>
                                    <td>10-10-2020, 11:25</td>
                                    <td>Rahul Shah</td>
                                    <td>Yes</td>
                                    <td><img class="edit-img"
                                        src="./images/Admin/Manage_Type/edit.png">
                                    <img class="delete-img"
                                        src="./images/Admin/Manage_Type/delete.png">
                                </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Val 3</td>
                                    <td>Lorem Ipsum is simply dummy text</td>
                                    <td>11-10-2020, 01:00</td>
                                    <td>Suman Trivedi</td>
                                    <td>No</td>
                                    <td><img class="edit-img"
                                        src="./images/Admin/Manage_Type/edit.png">
                                    <img class="delete-img"
                                        src="./images/Admin/Manage_Type/delete.png">
                                </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Val 4</td>
                                    <td>Lorem Ipsum is simply dummy text</td>
                                    <td>12-10-2020, 10:10</td>
                                    <td>Raj Malhotra</td>
                                    <td>Yes</td>
                                    <td><img class="edit-img"
                                        src="./images/Admin/Manage_Type/edit.png">
                                    <img class="delete-img"
                                        src="./images/Admin/Manage_Type/delete.png">
                                </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Val 5</td>
                                    <td>Lorem Ipsum is simply dummy text</td>
                                    <td>13-10-2020, 11:25</td>
                                    <td>Niya Patel</td>
                                    <td>No</td>
                                    <td><img class="edit-img"
                                        src="./images/Admin/Manage_Type/edit.png">
                                    <img class="delete-img"
                                        src="./images/Admin/Manage_Type/delete.png">
                                </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            
    </div>
    <!-- Manage Category Ends -->
    
    <?php include "footer.php"; ?>