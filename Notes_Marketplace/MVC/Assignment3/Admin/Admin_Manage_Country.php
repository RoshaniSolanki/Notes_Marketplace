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
                            <a href=""><button class="btn btn-primary add-country-btn">ADD COUNTRY</button></a>
                        </div>
                        <div class="col-md-6">
                            <span><img class="search-icon-img" src="./images/Admin/Manage_Country/search-icon.png"></span>
                            <input type="text" name="search" id="search" placeholder="Search">
                            <a href=""><button class="btn btn-primary search-btn">SEARCH</button></a>
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
                                <tr>
                                    <td>1</td>
                                    <td>India</td>
                                    <td>11</td>
                                    <td>09-10-2020, 10:10</td>
                                    <td>Khayati Patel</td>
                                    <td>Yes</td>
                                    <td><img class="edit-img"
                                            src="./images/Admin/Manage_Country/edit.png">
                                        <img class="delete-img"
                                            src="./images/Admin/Manage_Country/delete.png">
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Australia</td>
                                    <td>24</td>
                                    <td>10-10-2020, 11:25</td>
                                    <td>Rahul Shah</td>
                                    <td>Yes</td>
                                    <td><img class="edit-img"
                                        src="./images/Admin/Manage_Country/edit.png">
                                    <img class="delete-img"
                                        src="./images/Admin/Manage_Country/delete.png">
                                </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>USA</td>
                                    <td>04</td>
                                    <td>11-10-2020, 01:00</td>
                                    <td>Suman Trivedi</td>
                                    <td>No</td>
                                    <td><img class="edit-img"
                                        src="./images/Admin/Manage_Country/edit.png">
                                    <img class="delete-img"
                                        src="./images/Admin/Manage_Country/delete.png">
                                </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>United Kingdom</td>
                                    <td>12</td>
                                    <td>12-10-2020, 10:10</td>
                                    <td>Raj Malhotra</td>
                                    <td>Yes</td>
                                    <td><img class="edit-img"
                                        src="./images/Admin/Manage_Country/edit.png">
                                    <img class="delete-img"
                                        src="./images/Admin/Manage_Country/delete.png">
                                </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Canada</td>
                                    <td>13</td>
                                    <td>13-10-2020, 11:25</td>
                                    <td>Niya Patel</td>
                                    <td>No</td>
                                    <td><img class="edit-img"
                                        src="./images/Admin/Manage_Country/edit.png">
                                    <img class="delete-img"
                                        src="./images/Admin/Manage_Country/delete.png">
                                </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            
    </div>
    <!-- Manage Country Ends -->

    <?php include "footer.php"; ?>