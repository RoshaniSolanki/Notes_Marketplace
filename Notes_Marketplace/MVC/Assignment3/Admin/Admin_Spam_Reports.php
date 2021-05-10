<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();
?>
<?php include "header.php"; ?>
    <!-- Spam Reports -->
    <div id="adminSpamReports">
        <div class="container">
            <div id="part1">
                <div class="row">
                    <div class="col-md-6">
                        <p>Spam Reports</p>
                    </div>
                    <div class="col-md-6">
                        <span><img class="search-icon-img" src="./images/Admin/Spam_Reports/search-icon.png"></span>
                        <input type="text" name="search" id="search" placeholder="Search">
                        <a href=""><button class="btn btn-primary search-btn">SEARCH</button></a>
                    </div>
                </div>
            </div>
            <div id="part2">
                <div class="row">
                    <div class="col-md-12">
                    <div class="table-responsive">
                            <table class="table">
                            <tr>
                                <th>SR NO.</th>
                                <th>REPORTED BY</th>
                                <th>NOTE TITLE</th>
                                <th>CATEGORY</th>
                                <th>DATE EDITED</th>
                                <th>REMARK</th>
                                <th>ACTION</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Khayati Patel</td>
                                <td>Software Development</td>
                                <td>IT</td>
                                <td>09-10-2020, 10:10</td>
                                <td>Lorem Ipsum is simply dummy text</td>
                                <td><img src="images/Admin/Spam_Reports/delete.png"></td>
                                <td>
                                    <div class="admin-menu-popup">
                                        <a class="admin-menu-check" target="#asr1">
                                            <img class="dots-img" src="images/Admin/Spam_Reports/dots.png">
                                        </a>
                                        <div id="asr1" class="admin-menu-show">
                                            <p><a href="#">Download Notes</a></p>
                                            <p><a href="#">View More Details</a></p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Rahul Shah</td>
                                <td>Computer Basic</td>
                                <td>Computer</td>
                                <td>10-10-2020, 11:25</td>
                                <td>Lorem Ipsum is simply dummy text</td>
                                <td><img src="images/Admin/Spam_Reports/delete.png"></td>
                                <td>
                                    <div class="admin-menu-popup">
                                        <a class="admin-menu-check" target="#asr2">
                                            <img class="dots-img" src="images/Admin/Spam_Reports/dots.png">
                                        </a>
                                        <div id="asr2" class="admin-menu-show">
                                            <p><a href="#">Download Notes</a></p>
                                            <p><a href="#">View More Details</a></p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Suman Trivedi</td>
                                <td>Human Body</td>
                                <td>Science</td>
                                <td>11-10-2020, 01:00</td>
                                <td>Lorem Ipsum is simply dummy text</td>
                                <td><img src="images/Admin/Spam_Reports/delete.png"></td>
                                <td>
                                    <div class="admin-menu-popup">
                                        <a class="admin-menu-check" target="#asr3">
                                            <img class="dots-img" src="images/Admin/Spam_Reports/dots.png">
                                        </a>
                                        <div id="asr3" class="admin-menu-show">
                                            <p><a href="#">Download Notes</a></p>
                                            <p><a href="#">View More Details</a></p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Raj Malhotra</td>
                                <td>world war 2</td>
                                <td>History</td>
                                <td>12-10-2020, 10:10</td>
                                <td>Lorem Ipsum is simply dummy text</td>
                                <td><img src="images/Admin/Spam_Reports/delete.png"></td>
                                <td>
                                    <div class="admin-menu-popup">
                                        <a class="admin-menu-check" target="#asr4">
                                            <img class="dots-img" src="images/Admin/Spam_Reports/dots.png">
                                        </a>
                                        <div id="asr4" class="admin-menu-show">
                                            <p><a href="#">Download Notes</a></p>
                                            <p><a href="#">View More Details</a></p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Niya Patel</td>
                                <td>Accounting</td>
                                <td>Account</td>
                                <td>13-10-2020, 11:25</td>
                                <td>Lorem Ipsum is simply dummy text</td>
                                <td><img src="images/Admin/Spam_Reports/delete.png"></td>
                                <td>
                                    <div class="admin-menu-popup">
                                        <a class="admin-menu-check" target="#asr5">
                                            <img class="dots-img" src="images/Admin/Spam_Reports/dots.png">
                                        </a>
                                        <div id="asr5" class="admin-menu-show">
                                            <p><a href="#">Download Notes</a></p>
                                            <p><a href="#">View More Details</a></p>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        </table>
                    </div>
                    </div>
                </div>
            </div>
            <div id="part3">
                <div class="row">
                    <!-- Pagination-->
                    <center>
                        <div class="pagination-section">
                            
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="#">
                                            <img class="left-arrow-img"
                                                src="./images/Admin/Spam_Reports/left-arrow.png">
                                        </a>
                                    </li>
                                    <li class="page-item"><a id="one" class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a id="two" class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a id="three" class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a id="four" class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a id="five" class="page-link" href="#">5</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">
                                            <img class="right-arrow-img"
                                                src="./images/Admin/Spam_Reports/right-arrow.png">
                                        </a>
                                    </li>
                                </ul>
                            
                        </div>
                    </center>
                    <!-- Pagination Ends -->
                </div>
            </div>

        </div>
        <!-- Spam Reports Ends -->
        <?php include "footer.php"; ?>