<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();

//if(isset($_SESSION['user_id'])) {

   // $admin_id = $_SESSION['user_id'];
    //$admin_id = 48;

    if(isset($_GET['Member_id'])) {
        $member_id = $_GET['Member_id'];

        $select_member_details = query("SELECT users.FirstName, users.LastName, users.EmailID, user_profile.*, countries.CountryCode FROM users LEFT JOIN user_profile ON users.ID = user_profile.UserID 
        LEFT JOIN countries ON user_profile.PhoneNumberCountryCode = countries.ID WHERE users.ID = '$member_id' ");
        confirm($select_member_details);
            
        if(isset($_POST['search-btn'])) {
            $search_result = $_POST['search'];

            $select_notes = query("SELECT seller_notes.ID, seller_notes.Title, note_categories.Category_Name, reference_data.Value, seller_notes.CreatedDate, seller_notes.PublishedDate FROM seller_notes 
            LEFT JOIN note_categories ON seller_notes.Category = note_categories.ID LEFT JOIN reference_data ON seller_notes.Status = reference_data.ID WHERE(seller_notes.Title LIKE 
            '%$search_result%' OR note_categories.Category_Name LIKE '%$search_result%' OR reference_data.Value LIKE '%$search_result%' OR seller_notes.CreatedDate LIKE '%$search_result%' 
            OR seller_notes.PublishedDate LIKE '%$search_result%') AND seller_notes.sellerID = '$member_id' AND NOT(reference_data.Value = 'Removed' OR reference_data.Value = 'Draft')
            ORDER BY CreatedDate DESC");
            confirm($select_notes);

        }else {

            $select_notes = query("SELECT seller_notes.ID, seller_notes.Title, note_categories.Category_Name, reference_data.Value, seller_notes.CreatedDate, seller_notes.PublishedDate FROM seller_notes 
            LEFT JOIN note_categories ON seller_notes.Category = note_categories.ID LEFT JOIN reference_data ON seller_notes.Status = reference_data.ID WHERE 
            seller_notes.sellerID = '$member_id' AND NOT(reference_data.Value = 'Removed' OR reference_data.Value = 'Draft') ORDER BY CreatedDate DESC");
            confirm($select_notes);

        }
      
    }    
        
        

    if(isset($_GET['noteid'])){
        $note_id=$_GET['noteid'];

        $find_path = query("SELECT * FROM seller_notes_attachements WHERE NoteID = '{$note_id}' ");
        confirm($find_path);

        $find_attachement_count = mysqli_num_rows($find_path);

        while($row = mysqli_fetch_assoc($find_path)) {
            $file_path = $row['FilePath'];
        }

        $find_note_title = query("SELECT Title FROM seller_notes WHERE ID = '{$note_id}' ");
        confirm($find_note_title);

        while($row = mysqli_fetch_assoc($find_note_title)) {
            $title = $row['Title'];
        }
        
        if($find_attachement_count==1){
        header('Cache-Control:public');
        header('Content-Description:File Transfer');
        header('Content-Disposition:attachment; filename='.$title.'.pdf');
        header('Control-Type:application/pdf');
        header('Content-Transfer-Encoding:binary');
        readfile($file_path);
        

        }
        else{
            
            $zipname = $title . '.zip';
            $zip = new ZipArchive;
            $zip->open($zipname, ZipArchive::CREATE);
            $find_path = query("SELECT * FROM seller_notes_attachements WHERE NoteID = '{$note_id}' ");
            confirm($find_path);
            while($row = mysqli_fetch_assoc($find_path)) {
                $attach_id = $row['FilePath'];
                $zip->addFile($attach_id);
            }
            $zip->close();
            header('Content-Type: application/zip');
            header('Content-disposition: attachment; filename=' . $zipname);
            header('Content-Length: ' . filesize($zipname));
            readfile($zipname);
            
        }

    }


//}
?>
<?php include "header.php"; ?>
    <!-- Member Details -->
    <div id="adminMemberDetails">
        <div class="container">
            <div id="section1">
                <div id="part1">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Member Details</p>
                        </div>
                    </div>
                </div>
                <div id="part2">
                    <div class="row">
                        <div class="col-md-6 col-sm-7 col-xs-7">
                            <div class="row">
                                <?php
                                    while($row = mysqli_fetch_assoc($select_member_details)) {
                                        $first_name = $row['FirstName'];
                                        $last_name = $row['LastName'];
                                        $email = $row['EmailID'];
                                        $db_dob = $row['DOB'];
                                        $phone_number = $row['PhoneNumber'];
                                        $country_code = $row['CountryCode'];
                                        $college = $row['College'];
                                        $university = $row['University'];
                                        $address_line1 = $row['AddressLine1'];
                                        $address_line2 = $row['AddressLine2'];
                                        $city = $row['City'];
                                        $state = $row['State'];
                                        $country = $row['Country'];
                                        $zipcode = $row['ZipCode'];
                                        $profile_picture = $row['ProfilePicture'];

                                        $db_dob_timestamp = strtotime($db_dob);
                                        $dob              = date('d-m-Y', $db_dob_timestamp); 

                                      ?>
                                     
                                <div class="col-md-4 col-sm-3 col-xs-3">
                                    <img src="<?php echo $profile_picture; ?>">
                                </div>
                                <div class="col-md-8 col-sm-9 col-xs-9">
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-5 text1">First Name:</div>
                                        <div class="col-md-7 col-sm-7 col-xs-7 text2"><?php echo $first_name; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-xs-5 text1">Last Name:</div>
                                        <div class="col-md-7 col-xs-7 text2"><?php echo $last_name; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-xs-5 text1">Email:</div>
                                        <div class="col-md-7 col-xs-7 text2"><?php echo $email; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-xs-5 text1">DOB:</div>
                                        <div class="col-md-7 col-xs-7 text2"><?php echo $dob; ?></div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-5 col-xs-5 text1">Phone Number:</div>
                                        <div class="col-md-7 col-xs-7 text2"><?php echo $country_code." ".$phone_number; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5 col-xs-5 text1">College/University:</div>
                                        <div class="col-md-7 col-xs-7 text2"><?php echo $university; ?></div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-1 col-sm-1 col-xs-1 vl"></div>
                        <div class="col-md-5 col-sm-4 col-xs-4">
                            
                            <div class="row">
                                <div class="col-md-3 col-sm-5 col-xs-5 text1">Address 1:</div>
                                <div class="col-md-9 col-sm-7 col-xs-7 text2"><?php echo $address_line1; ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-5 col-xs-5 text1">Address 2:</div>
                                <div class="col-md-9 col-sm-7 col-xs-7 text2"><?php echo $address_line2; ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-5 col-xs-5 text1">City:</div>
                                <div class="col-md-9 col-sm-7 col-xs-7 text2"><?php echo $city; ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-5 col-xs-5 text1">State:</div>
                                <div class="col-md-9 col-sm-7 col-xs-7 text2"><?php echo $state; ?></div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-3 col-sm-5 col-xs-5 text1">Country:</div>
                                <div class="col-md-9 col-sm-7 col-xs-7 text2"><?php echo $country; ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-5 col-xs-5 text1">Zip Code:</div>
                                <div class="col-md-9 col-sm-7 col-xs-7 text2"><?php echo $zipcode; ?></div>
                            </div>
                        </div>
                        <?php  
                            }
                        ?>
                    </div>
                </div>
            </div>
            <hr style="border-top: 2px solid #d1d1d1;">
            <div id="section2">
            <div id="part1">
                    <div class="row">
                        <div class="col-md-5 col-sm-4 col-xs-4">
                            <p>Notes</p>
                        </div>
                        <div class="col-md-7 col-sm-8 col-xs-8">
                            <form action="" method="POST">
                                <span><img class="search-icon-img" src="./images/Admin/Manage_Administrator/search-icon.png"></span>
                                <input type="text" name="search" id="search" placeholder="Search">
                                <button type="submit" name="search-btn" class="btn btn-primary search-btn">SEARCH</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div id="part2">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table" id="member-details-table">
                                <thead>
                                    <tr>
                                        <th>SR NO.</th>
                                        <th>NOTE TITLE</th>
                                        <th>CATEGORY</th>
                                        <th>STATUS</th>
                                        <th>DOWNLOADED NOTES</th>
                                        <th>TOTAL<br>EARNING</th>
                                        <th>DATE ADDED</th>
                                        <th>PUBLISHED DATE</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $i=1;
                                    while($row = mysqli_fetch_assoc($select_notes)) {

                                        $note_id           = $row['ID'];
                                        $note_title        = $row['Title'];
                                        $note_cat          = $row['Category_Name'];
                                        $status            = $row['Value'];
                                        $db_date_added     = $row['CreatedDate'];
                                        $db_published_date = $row['PublishedDate'];

                                        $db_date_added_timestamp = strtotime($db_date_added);
                                        $date_added              = date('d-m-Y, H:i', $db_date_added_timestamp); 

                                        $db_published_date_timestamp = strtotime($db_published_date);
                                        $published_date              = date('d-m-Y, H:i', $db_published_date_timestamp); 

                                        //downloaded notes
                                        $downloaded = query("SELECT seller_notes.ID FROM seller_notes LEFT JOIN downloads ON seller_notes.ID = downloads.NoteID WHERE 
                                        downloads.IsAttachementDownloaded = 1 AND downloads.NoteID = '{$note_id}' ");
                                        confirm($downloaded);

                                        $download_count = mysqli_num_rows($downloaded);

                                        //total earning
                                        $find_total_earning = query("SELECT SUM(PurchasedPrice) AS total_earning FROM downloads WHERE downloads.IsAttachementDownloaded = 1 AND 
                                        IsPaid = 1 AND downloads.NoteID = '{$note_id}'");
                                        confirm($find_total_earning);

                                        while($row = mysqli_fetch_assoc($find_total_earning)) {
                                            $total_earning = $row['total_earning'];
                                        }
                                        ?>

                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><a href="Admin_Note_Details.php?Note_id=<?php echo $note_id; ?>"><?php echo $note_title;?></a></td>
                                        <td><?php echo $note_cat;?></td>
                                        <td><?php echo $status;?></td>
                                        <td><a href="Admin_Downloads_Notes.php?download_note_id=<?php echo $note_id;?>"><?php echo $download_count;?></a></td>
                                        <td>&#36;<?php echo $total_earning;?></td>
                                        <td><?php echo $date_added;?></td>
                                        <td><?php echo $published_date;?></td>
                                        <td> 
                                            <div class="admin-menu-popup">
                                                <a class="admin-menu-check" target="#amd<?php echo $i;?>">
                                                    <img class="dots-img" src="./images/Admin/Member_Details/dots.png">
                                                </a>
                                                <div id="amd<?php echo $i;?>" class="admin-menu-show">
                                                    <p><a href="Admin_Member_Details.php?noteid=<?php echo $note_id;?>">Download Notes</a></p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;}
                                ?>
                                
                                    
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Member Details Ends -->
    
    <?php include "footer.php"; ?>