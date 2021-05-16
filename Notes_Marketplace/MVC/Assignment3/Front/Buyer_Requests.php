<?php
include "../includes/db.php";
include "../includes/functions.php";

session_start();

if(isset($_SESSION['email']) && $_SESSION['roleid']==3) {
    $user_id = $_SESSION['userid'];


    if(isset($_POST['search-btn'])) {

        $search_result = $_POST['search'];
        
        $select_query = query("SELECT downloads.* , users.EmailID, user_profile.PhoneNumber, countries.CountryCode FROM downloads LEFT JOIN users ON downloads.Downloader=users.ID 
        LEFT JOIN user_profile ON downloads.Downloader=user_profile.UserID LEFT JOIN countries ON user_profile.PhoneNumberCountryCode=countries.ID WHERE (downloads.NoteTitle 
        LIKE '%$search_result%' OR downloads.NoteCategory LIKE '%$search_result%' OR users.EmailID LIKE '%$search_result%' OR downloads.PurchasedPrice LIKE '%$search_result%') 
        AND downloads.Downloader=$user_id AND IsSellerHasAllowedDownload = 0  ORDER BY downloads.AttachementDownloadedDate DESC");
        confirm($select_query);

    }else {

        $select_query = query("SELECT downloads.* , users.EmailID, user_profile.PhoneNumber, countries.CountryCode FROM downloads LEFT JOIN users ON downloads.Downloader=users.ID 
        LEFT JOIN user_profile ON downloads.Downloader=user_profile.UserID LEFT JOIN countries ON user_profile.PhoneNumberCountryCode=countries.ID WHERE downloads.Downloader=$user_id 
        AND IsSellerHasAllowedDownload = 0  ORDER BY downloads.AttachementDownloadedDate DESC");
        confirm($select_query);

    }

    
    if(isset($_GET['Note_id'])){
        $note_id=$_GET['Note_id'];

        $modified_date = date("Y-m-d H:i:s");

        $update_query = query("UPDATE downloads SET IsSellerHasAllowedDownload = 1, ModifiedDate = '$modified_date', ModifiedBy = $user_id WHERE NoteID = $note_id AND IsPaid = 1");
        confirm($update_query);

        // find Seller Information
        $find_seller_name = query("SELECT FirstName, LastName FROM users WHERE ID = '{$user_id}' ");
        confirm($find_seller_name);

        while($sr = mysqli_fetch_assoc($find_seller_name)) {
            $seller_name = $sr['FirstName'] . " " .$sr['LastName']; 
        }

        //find buyer information
        $find_buyer_id = query("SELECT Downloader FROM downloads WHERE NoteID = '{$note_id}' ");
        confirm($find_buyer_id);

        while($br = mysqli_fetch_assoc($find_buyer_id)) {
            $buyer_id = $br['Downloader']; 
        }

        $find_buyer_info = query("SELECT FirstName, LastName, EmailID FROM users WHERE ID = '{$buyer_id}' ");
        confirm($find_buyer_info);

        while($br = mysqli_fetch_assoc($find_buyer_info)) {
            $buyer_name = $br['FirstName'] . " " .$br['LastName']; 
            $buyer_email = $br['EmailID'];
        }


        $subject = $buyer_name." Allows you to download a note";
        $email = "sroshani025@gmail.com";
        $body = "Hello ".$buyer_name.","."\r\n"."\r\n"."We would like to inform you that, " .$seller_name. "  Allows you to download a note. Please login and see My Download tabs to download particular note." . "\r\n"."\r\n"."Regards,"."\r\n". "Notes Marketplace";
        $sender_email = "Email From: {$email}";
        $result = mail($buyer_email, $subject, $body, $sender_email);
             
            if(!$result) {
                echo "<script>alert('Email sending failed....')</script>";
            }

    }

}else{
    redirect("Login.php");
}

?>

    <?php include "header.php"; ?>

    <!-- Buyer Requests -->
    <div id="buyerRequests">
        <div class="container">

            <div id="part1">
                <div class="row">
                    <div class="col-md-5 col-sm-4 col-xs-4">
                        <p>Buyer Requests</p>
                    </div>
                    <div class="col-md-7 col-sm-8 col-xs-8">
                        <form action="" method="POST">
                            <input type="text" name="search" id="search" placeholder="Search">
                            <span><img class="search-icon-img" src="./images/Buyer_Requests/search-icon.png"></span>
                            <button type="submit" name="search-btn" class="btn btn-primary buyer-requests-search-btn">SEARCH</button>
                        </form>
                    </div>
                </div>
            </div>
            <div id="part2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table" id="buyer-requests-table">
                                <thead>
                                <tr>
                                    <th>SR NO.</th>
                                    <th>NOTE TITLE</th>
                                    <th>CATEGORY</th>
                                    <th>BUYER</th>
                                    <th>PHONE NO.</th>
                                    <th>SELL TYPE</th>
                                    <th>PRICE</th>
                                    <th>DOWNLOADED DATE/TIME</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i=1;
                                    while($buyer_row = mysqli_fetch_assoc($select_query)) {
                                        
                                        $note_id           = $buyer_row['NoteID'];
                                        $ispaid            = $buyer_row['IsPaid'];
                                        $price             = $buyer_row['PurchasedPrice'];
                                        $note_title        = $buyer_row['NoteTitle'];
                                        $note_category     = $buyer_row['NoteCategory'];
                                        $downloader        = $buyer_row['Downloader'];
                                        $buyer_email       = $buyer_row['EmailID'];
                                        $buyer_phone       = $buyer_row['PhoneNumber'];
                                        $buyer_cc          = $buyer_row['CountryCode'];
                                        $note_created_date = $buyer_row['CreatedDate'];

                                        $db_download_date = $buyer_row['AttachementDownloadedDate'];
                                        if($db_download_date == NULL) {
                                            $db_download_date = $note_created_date;
                                        }
                                        $db_download_date_timestamp = strtotime($db_download_date);
                                        $download_date = date('d M Y, H:i:s', $db_download_date_timestamp); 

                                       /* $select_email = query("SELECT EmailID FROM users WHERE ID = '{$downloader}' ");
                                        confirm($select_email);

                                        while($email_row = mysqli_fetch_assoc($select_email)) {
                                            $buyer_email = $email_row['EmailID'];
                                        }

                                        $select_phone_number = query("SELECT c.CountryCode, u.PhoneNumber FROM user_profile u JOIN countries c ON u.PhoneNumberCountryCode = c.ID WHERE u.UserID = '{$downloader}' ");
                                        confirm($select_phone_number);

                                        while($phone_row = mysqli_fetch_assoc($select_phone_number)) {
                                            $buyer_phone = $phone_row['PhoneNumber'];
                                            $buyer_cc    = $phone_row['CountryCode'];
                                        }*/

                                        if($ispaid == 0) {
                                            $sell_type = 'Free';
                                            $price = 0;
                                        }else {
                                            $sell_type = 'Paid';
                                        }

                                ?>
                                
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $note_title; ?></td>
                                    <td><?php echo $note_category; ?></td>
                                    <td><?php echo $buyer_email; ?></td>
                                    <td><?php echo $buyer_cc. " " .$buyer_phone; ?></td>
                                    <td><?php echo $sell_type; ?></td>
                                    <td>&#36;<?php echo $price; ?></td>
                                    <td><?php echo $download_date; ?></td>
                                    <td><a href="Note_Details_Page.php?Note_id=<?php echo $note_id; ?>">
                                            <img class="eye-img" src="./images/Buyer_Requests/eye.png"></a>

                                        <div class="buyer-req-menu-popup">
                                            <a class="buyer-req-menu-check" target="#br<?php echo $i; ?>">
                                                <img class="dots-img" src="./images/Buyer_Requests/dots.png">
                                            </a>
                                            <div id="br<?php echo $i; ?>" class="buyer-req-menu-show">
                                                <p><a href="Buyer_Requests.php?Note_id=<?php echo $note_id; ?>">Yes, I Received</a></p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <?php   
                                $i++; }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Buyer Requests Ends -->
        <!-- Footer -->
        <footer class="footer">
            <hr>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <p class="footer-text">
                            Copyright &copy; TatvaSoft All Rights Reserved.
                        </p>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <ul class="social-list">
                            <li><a href="#"><img src="images/Buyer_Requests/facebook.png"></a></li>
                            <li><a href="#"><img src="images/Buyer_Requests/twitter.png"></a></li>
                            <li><a href="#"><img src="images/Buyer_Requests/linkedin.png"></a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </footer>
        <!-- Footer Ends -->

        <!-- JQuery -->
        <script src="js/jquery-3.5.1.min.js"></script>

        <!-- Bootstrap JS -->
        <script src="js/bootstrap/bootstrap.min.js"></script>


        <script src="js/datatables.js"></script>

        <!-- Custom JS -->
        <script src="js/script.js"></script>
</body>

</html>