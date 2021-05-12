<?php
include "../includes/db.php";
include "../includes/functions.php";

    //pagination
    if(isset($_GET['page'])) {

       echo $page = $_GET['page'];
    }else {
        $page = 1;
    }

    $item_per_page = 9;
    $start_from = ($page-1)*9;


    //searching and filtering
    if(isset($_GET['selected_search'])){
        $selected_search=$_GET['selected_search'];
    }
    else {
        $selected_search="";
    }
    if(isset($_GET['selected_type'])&&!empty($_GET['selected_type'])){
        $selected_type=$_GET['selected_type'];
    }
    else{
        $selected_type="";
    }
    if(isset($_GET['selected_category'])&&!empty($_GET['selected_category'])){
        $selected_category=$_GET['selected_category'];
    }
    else{
        $selected_category="";
    }
    if(isset($_GET['selected_university'])&&!empty($_GET['selected_university'])){
        $selected_university=$_GET['selected_university'];
    }
    else{
        $selected_university="";
    }
    if(isset($_GET['selected_course'])&&!empty($_GET['selected_course'])){
        $selected_course=$_GET['selected_course'];
    }
    else{
        $selected_course="";
    }
    if(isset($_GET['selected_country'])&&!empty($_GET['selected_country'])){
        $selected_country=$_GET['selected_country'];
    }
    else{
        $selected_country="";
    }
    if(isset($_GET['selected_rating'])&&!empty($_GET['selected_rating'])){
        $selected_rating=$_GET['selected_rating'];
    }
    else{
        $selected_rating="";
    }

    $select_query = "";

    $select_query = "SELECT DISTINCT seller_notes_review.NoteID, seller_notes.*, note_categories.Category_Name FROM seller_notes LEFT JOIN note_categories ON seller_notes.Category = note_categories.ID LEFT JOIN seller_notes_review ON 
    seller_notes.ID = seller_notes_review.NoteID WHERE(seller_notes.Title LIKE '%$selected_search%' OR note_categories.Category_Name LIKE '%$selected_search%') AND 
    seller_notes.IsActive = 1 ";

    $select_query .= (!empty($selected_type)&&$selected_type!="")? "AND NoteType =$selected_type ":"";
    $select_query .= (!empty($selected_category)&&$selected_category!="")? "AND Category =$selected_category ":"";
    $select_query .= (!empty($selected_university)&&$selected_university!="")? "AND UniversityName = '$selected_university' ":"";
    $select_query .= (!empty($selected_course)&&$selected_course!="")? "AND Course = '$selected_course' ":"";
    $select_query .= (!empty($selected_country)&&$selected_country!="")? "AND Country =$selected_country ":"";
    $select_query .= (!empty($selected_rating)&&$selected_rating!="")? "AND seller_notes_review.Ratings =$selected_rating ":"";
    $select_query .= " LIMIT $start_from,$item_per_page";
    $select_query = query($select_query);
    confirm($select_query);

    $total_notes = mysqli_num_rows($select_query);
    $total_page = ceil($total_notes/$item_per_page);
    
    


?>
<!-- Section 2-->
<div class="search-page-section2">
            <div class="container">
                <p class="SPS2MH">Total <?php echo mysqli_num_rows($select_query); ?> notes</p>
                <div class="row">
                    <?php 
               while($row = mysqli_fetch_assoc($select_query)) {
                $note_id = $row['ID'];
                $title = $row['Title'];
                $category = $row['Category_Name'];
                $university = $row['UniversityName'];
                $country_id = $row['Country'];
                $no_of_pages = $row['NumberOfPages'];
                $display_picture = $row['DisplayPicture'];
                $db_published_date = $row['PublishedDate'];
                $db_pub_date_timestamp = strtotime($db_published_date);
                $published_date = date('D, M d Y', $db_pub_date_timestamp); 

                $get_country = query("SELECT Country_Name FROM countries WHERE ID = '$country_id' ");
                confirm($get_country);

                while($crow = mysqli_fetch_assoc($get_country)) {
                    $country = $crow['Country_Name'];
                }    
                ?>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <img class="search1-img" src="<?php echo $display_picture;?>">
                        <div id="search1">
                            <a href="Note_details_Page.php?Note_id=<?php echo $note_id; ?>">
                                <p class="SPS2H"><?php echo $title. "-" . $category; ?></p>
                            </a>
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-3">
                                    <img class="university-img" src="./images/search-page/university.png">
                                </div>
                                <div class="col-md-10 col-sm-10 col-xs-9">
                                    <p class="SPS2T1"><?php echo $university; ?>, <?php echo $country; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-3">
                                    <img class="page-img" src="./images/search-page/pages.png">
                                </div>
                                <div class="col-md-10 col-sm-10 col-xs-9">
                                    <p class="SPS2T2"><?php echo $no_of_pages; ?> Pages</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-3">
                                    <img class="date-img" src="./images/search-page/date.png">
                                </div>
                                <div class="col-md-10 col-sm-10 col-xs-9">
                                    <p class="SPS2T3"><?php echo $published_date; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-3">
                                    <img class="flag-img" src="./images/search-page/flag.png">
                                </div>
                                <div class="col-md-10 col-sm-10 col-xs-9">
                                    <?php 
                                $find_user_count = query("SELECT DISTINCT ReportedByID FROM seller_notes_reported_issues WHERE NoteID = '{$note_id}' ");
                                confirm($find_user_count);

                                $user_count = mysqli_num_rows($find_user_count);

                                if($user_count){?>
                                    <p class="SPS2T4"><?php  echo $user_count; ?> Users marked this note as
                                        inappropriate</p>
                                    <?php }
                                ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="Rating">
                                    <?php 
                                    $find_rating = query("SELECT AVG(Ratings) as rating FROM seller_notes_review WHERE NoteID = '{$note_id}' ");
                                    confirm($find_rating);

                                    $find_rating_count = query("SELECT ID FROM seller_notes_review WHERE NoteID = '{$note_id}' ");
                                    confirm($find_rating_count);

                                    $review_count = mysqli_num_rows($find_rating_count);

                                    while($row = mysqli_fetch_assoc($find_rating)) {
                                        $avg_rating = $row['rating'];
                                    }

                                    for($i=1;$i<=ceil($avg_rating);$i++) {?>
                                        <img src="./images/search-page/star.png" class="Rating-Star">
                                        <?php    } 
                                    for($i=1;$i<=(5-ceil($avg_rating));$i++) { ?>
                                        <img src="./images/search-page/star-white.png" class="Rating-Star">
                                        <?php }?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <p class="SPS2T5"><?php echo $review_count; ?> reviews</p>
                                </div>
                            </div>
                        </div>
                    </div><?php }?>
                </div>
                <!-- Pagination-->
                <center>
                    <div class="pagination-section">
                        <ul class="pagination">

                        <li class="page-item">

                                            <?php 
                                            
                                             echo "<a class='page-link' href='Search_Notes_Page_Ajax.php?page=".($page-1)."'>
                                             <img class='left-arrow-img' src='./images/search-page/left-arrow.png'></a>";
                                            
                                            ?>
                                            
                                        </li>
                                        <?php 

                                            for($i=1;$i<=$total_page;$i++) {

                                                if($i==$page){
                                                    
                                                    echo "<li class='page-item'><a class='page-link active-link' href='Search_Notes_Page_Ajax?page=".$i."'>$i</a></li>";

                                                }else {

                                                    echo "<li class='page-item'><a class='page-link' href='Search_Notes_Page_Ajax.php?page=".$i."'>$i</a></li>";

                                                }
                                                
                                            }

                                        ?>
                                        
                                        <li class="page-item">

                                        <?php 
                                             
                                             echo "<a class='page-link' href='Search_Notes_Page_Ajax?page=".($page+1)."'>
                                             <img class='right-arrow-img' src='./images/search-page/right-arrow.png'></a>";
                                             
                                        ?>

                                        </li>
                           
                        </ul>
                    </div>
                </center>
                <!-- Pagination Ends -->