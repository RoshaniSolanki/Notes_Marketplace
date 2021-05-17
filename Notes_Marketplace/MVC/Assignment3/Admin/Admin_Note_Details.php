<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();
    if(isset($_GET['Note_id'])) {
        $note_id = $_GET['Note_id'];

        
        $select_query = query("SELECT * FROM seller_notes WHERE ID = '$note_id' ");
        confirm($select_query);
    }

    if(isset($_POST['single_attachement'])) {

       
    $find_file_path = query("SELECT FilePath FROM seller_notes_attachements WHERE NoteID = '{$note_id}' ");
    confirm($find_file_path);
    while($ar = mysqli_fetch_assoc($find_file_path)){

        $file_path = $ar['FilePath'];

    }

    header('Cache-Control: public');
    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename=' . $file_path. '.pdf');
    header('Content-Type: application/pdf');
    header('Content-Transfer-Encoding:binary');
    readfile($file_path);
    
    }
    
    if(isset($_POST['multiple_attachement'])) {
    
        $find_title = query("SELECT DISTINCT Title FROM seller_notes WHERE ID = '{$note_id}' ");
        confirm($find_title);
    
        while($tr = mysqli_fetch_assoc($find_title)) {
            $title = $tr['Title'];
        }
        $zipname = $title . '.zip';
        $zip = new ZipArchive;
        $zip->open($zipname, ZipArchive::CREATE);
        $path_query = query("SELECT FilePath FROM seller_notes_attachements WHERE NoteID = '{$note_id}' ");
        confirm($path_query);
        while($path_row = mysqli_fetch_assoc($path_query)){
            $attact_id = $path_row['FilePath'];
            $zip->addFile($attact_id);
        }
        $zip->close();
        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename=' . $zipname);
        header('Content-Length: ' . filesize($zipname));
        readfile($zipname);
    

    }
?>

<?php include "header.php"; ?>
    <!-- Note Details -->
    <div id="adminNoteDetails">
        <div id="note-details-section1">
            <div class="container">
                <p class="NDS1MH">Notes Details</p>
                <div class="row">
                    <div class="col-md-7 col-sm-12 col-xs-12">
                        <div class="row">
                        <?php 
                            
                            while($row = mysqli_fetch_assoc($select_query)) {
                                $ispaid       = $row['IsPaid'];
                                $title        = $row['Title'];
                                $description  = $row['Description'];
                                $price        = $row['SellingPrice'];
                                $category_id  = $row['Category'];
                                $university   = $row['UniversityName'];
                                $country_id   = $row['Country'];
                                $course_name  = $row['Course'];
                                $course_code  = $row['CourseCode'];
                                $professor    = $row['Professor'];
                                $no_of_pages  = $row['NumberOfPages'];
                                $approve_date = $row['PublishedDate'];
                                $note_preview = $row['NotesPreview'];
                                $display_picture = $row['DisplayPicture'];
                            
                            $get_cat = query("SELECT Category_Name FROM note_categories WHERE ID = '$category_id' ");
                            confirm($get_cat);
                            while($crow = mysqli_fetch_assoc($get_cat)) {
                                $category = $crow['Category_Name'];
                            }

                            $get_country = query("SELECT Country_Name FROM countries WHERE ID = '$country_id' ");
                            confirm($get_country);
                            while($country_row = mysqli_fetch_assoc($get_country)) {
                                $country = $country_row['Country_Name'];
                            }

                            ?>
                            <div class="col-md-5 col-sm-5 col-xs-5">
                            <img src="<?php echo $display_picture; ?>" alt="note-display-picture">
                            </div>
                            <div class="col-md-7 col-sm-7 col-xs-7">
                                <p class="NDS1LH"><?php echo $title; ?></p>
                                <p class="NDS1LT1"><?php echo $category; ?></p>
                                <p class="NDS1LT2"><?php echo $description; ?></p>
                                <?php 

                                    $find_attachement_count = query("SELECT NoteID FROM seller_notes_attachements WHERE NoteID = '{$note_id}' ");
                                    confirm($find_attachement_count); 
                                    $count = mysqli_num_rows($find_attachement_count);
                                    if($ispaid == 0) {

                                        if($count == 1){ ?>
                                            <form action="" method="post">
                                                <button class="download-btn" name="single_attachement">DOWNLOAD</button>
                                            </form>
                                       <?php }
                                        if($count>1) { ?>
                                            <form action="" method="post">
                                                <button class="download-btn" name="multiple_attachement">DOWNLOAD</button>
                                            </form>
                                       <?php 
                                       }
                                    }else {
                                        if($count == 1){ ?>
                                            <form action="" method="post">
                                                <button class="download-btn" name="single_attachement">DOWNLOAD/&#36;<?php echo $price; ?></button>
                                            </form>
                                       <?php }
                                        if($count>1) { ?>
                                            <form action="" method="post">
                                                <button class="download-btn" name="multiple_attachement">DOWNLOAD/&#36;<?php echo $price; ?></button>
                                            </form>
                                       <?php 
                                        }
                                    }?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT1">Institution:</p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT2"><?php echo $university; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT1">Country:</p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT2"><?php echo $country; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT1">Course Name:</p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT2"><?php echo $course_name; ?></P>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT1">Course Code:</p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT2"><?php echo $course_code; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT1">Professor:</p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT2"><?php echo $professor; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT1">Number of Pages:</p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT2"><?php echo $no_of_pages; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT1">Approved Date:</p>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT2"><?php echo $approve_date; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-6">
                                <p class="NDS1RT1">Rating:</p>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-6">
                        <div class="row">
                            <?php 
                                     $find_rating = query("SELECT AVG(Ratings) as rating FROM seller_notes_review WHERE NoteID = '{$note_id}' ");
                                     confirm($find_rating);
 
                                     $find_rating_count = query("SELECT ID FROM seller_notes_review WHERE NoteID = '{$note_id}' ");
                                     confirm($find_rating_count);
 
                                     $review_count = mysqli_num_rows($find_rating_count);
 
                                     while($row = mysqli_fetch_assoc($find_rating)) {
                                         $avg_rating = $row['rating'];
                                     }
 
                                    ?>
                            <div class="col-md-6  col-sm-6 col-xs-6">
                                <div class="Rating">
                                    <?php 
                                                for($i=1;$i<=ceil($avg_rating);$i++) {?>
                                    <img src="images/Admin/Note_Details/star.png" class="Rating-Star">
                                    <?php    } 
                                                for($i=1;$i<=(5-ceil($avg_rating));$i++) { ?>
                                    <img src="images/Admin/Note_Details/star-white.png" class="Rating-Star">
                                    <?php }?>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <p class="NDS1RT2"><?php echo $review_count; ?> Reviews</p>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6  col-sm-6 col-xs-12">
                        <?php 
                                $find_user_count = query("SELECT DISTINCT ReportedByID FROM seller_notes_reported_issues WHERE NoteID = '{$note_id}' ");
                                confirm($find_user_count);

                                $user_count = mysqli_num_rows($find_user_count);

                                if($user_count){?>
                        <p class="NDS1RT3"><?php  echo $user_count; ?> Users marked this note as inappropriate</p>
                        <?php }
                                ?>

                    </div>

                </div>
                    </div>
                </div>
            
            </div>
        </div>

        <div class="container">
            <hr>
        </div>
        <div id="note-details-section2">
            <div class="container">
                <div class="row">

                    <div class="col-md-6 col-sm-12">
                        <p class="NDS2LMH">Notes Preview</p>
                        <div id="Iframe-Cicis-Menu-To-Go"
                            class="set-margin-cicis-menu-to-go set-padding-cicis-menu-to-go set-border-cicis-menu-to-go set-box-shadow-cicis-menu-to-go center-block-horiz">
                            <div class="responsive-wrapper 
                               responsive-wrapper-padding-bottom-90pct"
                                style="-webkit-overflow-scrolling: touch; overflow: auto;">
                                <iframe src="<?php echo $note_preview; ?>">
                                    
                                </iframe>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                    <div class="col-md-6 col-sm-12">
                        <p class="NDS2RMH">Customer Reviews</p>
                        <div class="NDS2RC" style="overflow-y:scroll">
                            <?php 
                                $find_cutomers_review = query("SELECT Comments, Ratings, users.FirstName, users.LastName, user_profile.ProfilePicture FROM seller_notes_review LEFT JOIN 
                                users ON seller_notes_review.ReviewedByID = users.ID LEFT JOIN user_profile ON user_profile.UserID = users.ID WHERE 
                                seller_notes_review.NoteID = '{$note_id}' ORDER BY Ratings DESC, seller_notes_review.CreatedDate DESC");
                                confirm($find_cutomers_review);

                                if(mysqli_num_rows($find_cutomers_review)) {
                                    while($row = mysqli_fetch_assoc($find_cutomers_review)) {
                                        $rating = $row['Ratings'];
                                        $comments= $row['Comments'];
                                        $name = $row['FirstName']. " " . $row['LastName'];
                                        $pro_pic = $row['ProfilePicture'];
                                                
                            ?>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-md-1 col-sm-1 col-xs-1">
                                            <img src="<?php echo $pro_pic; ?>">
                                        </div>
                                        <div class="col-md-10 col-sm-10 col-xs-10">
                                            <p class="NDS2RT1"><?php echo $name; ?></p>
                                            <div class="Rating">
                                                <?php
                                                        for($i=1;$i<=$rating;$i++) {?>
                                                <img src="images/Admin/Note_Details/star.png" class="Rating-Star">
                                                <?php    } 
                                                        for($i=1;$i<=(5-$rating);$i++) { ?>
                                                <img src="images/Admin/Note_Details/star-white.png" class="Rating-Star">
                                                <?php }?>
                                            </div>
                                            <p class="NDS2RT2"><?php echo $comments; ?>
                                            </p>
                                        </div>
                                        <div class="col-md-1 col-sm-1 col-xs-1">
                                            <img src="images/Admin/Note_Details/delete.png" height="20" width="20">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <hr>
                            <?php } ?>
                        </div>
                        <?php 
                                } else {
                        ?>
                            <p class="NDS2RT1">No Reviews Yet</p>
                        <?php }
                                ?>
                    </div>
                </div>
            </div>
        </div>
    <!-- Note Details ends -->

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
                        <li><a href="#"><img src="images/Admin/Note_Details/facebook.png"></a></li>
                        <li><a href="#"><img src="images/Admin/Note_Details/twitter.png"></a></li>
                        <li><a href="#"><img src="images/Admin/Note_Details/linkedin.png"></a></li>
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

    <!-- Custom JS -->
    <script src="js/script.js"></script>
</body>

</html>