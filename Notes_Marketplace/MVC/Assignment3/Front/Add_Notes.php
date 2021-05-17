<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();

if(isset($_SESSION['email'])  && $_SESSION['roleid']==3) {

$seller_id = $_SESSION['userid'];


if(isset($_POST['save'])) {

        $sell_for_radio_btn = escape_string($_POST['sellfor-radio']);
        if($sell_for_radio_btn == "free") {
            $ispaid = false;
            $selling_price = null;
        }else {
            $selling_price = escape_string($_POST['sell-price']);
            $ispaid = true;
        }
       
        $title                     = escape_string($_POST['title']);
        $category                  = escape_string($_POST['category']);
        $type                      = escape_string($_POST['type']);
        $display_picture           = "../Members/Default/Admin_default_img.png";
        $number_of_pages           = escape_string($_POST['number-of-pages']);
        $description               = escape_string($_POST['description']);
        $country                   = escape_string($_POST['country']);
        $institute_name            = escape_string($_POST['institution-name']);
        $course_name               = escape_string($_POST['course-name']);
        $course_code               = escape_string($_POST['course-code']);
        $professor                 = escape_string($_POST['professor']);
        //$ispaid                    = escape_string($_POST['sellfor-radio']);
        $note_preview              = "../Members/Default/Admin_default_img.png";
        $created_date              = date("Y-m-d H:i:s");
        $modified_date             = date("Y-m-d H:i:s");


        $query  = query("INSERT INTO seller_notes(SellerID, Status, Title, Category, DisplayPicture, NoteType, NumberOfPages, Description, Country, UniversityName, Course, CourseCode, Professor, IsPaid, SellingPrice, NotesPreview, CreatedDate, CreatedBy, ModifiedDate, ModifiedBy) VALUES('{$seller_id}', 6, '{$title}', '{$category}', '{$display_picture}', '{$type}', '{$number_of_pages}', '{$description}', '{$country}', '{$institute_name}', '{$course_name}', '{$course_code}', '{$professor}', '{$ispaid}','{$selling_price}', '{$note_preview}', '{$created_date}', '{$seller_id}', '{$modified_date}', '{$seller_id}')");
        confirm($query);
        if($query){
            echo "<script>alert('Inserted Sucessfully...........');</script>";
        }
        

        /* Diplay Picture */
        global $connection;
        $note_id = mysqli_insert_id($connection);
        $display_picture           = $_FILES['display-picture'];
        $display_picture_name      = $display_picture['name'];
        $display_picture_tmp_loc   = $display_picture['tmp_name'];
        $display_picture_extension = explode('.',$display_picture_name);
        $display_picture_check     = strtolower(end($display_picture_extension));
        $display_picture_extstored = array('png', 'jpg', 'jpeg');

            if(in_array($display_picture_check, $display_picture_extstored)) {
                if(!is_dir("../Members/")) {
                    mkdir('../Members/');
                }
                if(!is_dir("../Members/" . $seller_id)) {
                    mkdir('../Members/' . $seller_id);
                }
                if(!is_dir("../Members/" . $seller_id . "/" . $note_id)) {
                    mkdir('../Members/' . $seller_id . '/' . $note_id);
                }
                $display_picture_destination = '../Members/' . $seller_id . '/' . $note_id . '/' . "DP_" . time() . '.' .$display_picture_check;
                move_uploaded_file($display_picture_tmp_loc, $display_picture_destination);
                $display_picture_query = query("UPDATE seller_notes SET DisplayPicture='$display_picture_destination' WHERE ID=$note_id");
                confirm($display_picture_query);

            }else {
                echo "Display Picture Upload failed";
            }
        

        /* Note Preview */
        $note_preview           = $_FILES['note-preview'];
        $note_preview_name      = $note_preview['name'];
        $note_preview_tmp_loc   = $note_preview['tmp_name'];
        $note_preview_extension = explode('.',$note_preview_name);
        $note_preview_check     = strtolower(end($note_preview_extension));
        $note_preview_extstored = array('pdf');

            if(in_array($note_preview_check, $note_preview_extstored)) {
                if(!is_dir("../Members/")) {
                    mkdir('../Members/');
                }
                if(!is_dir("../Members/" . $seller_id)) {
                    mkdir('../Members/' . $seller_id);
                }
                if(!is_dir("../Members/" . $seller_id . "/" . $note_id)) {
                    mkdir('../Members/' . $seller_id . '/' . $note_id);
                }
                $note_preview_destination = '../Members/' . $seller_id . '/' . $note_id . '/' . "Preview_" . time() . '.' .$note_preview_check;
                move_uploaded_file($note_preview_tmp_loc, $note_preview_destination);
                $note_preview_query = query("UPDATE seller_notes SET NotesPreview='$note_preview_destination' WHERE ID=$note_id");
                confirm($note_preview_query);
            }else {
                echo "Notes Preview Upload failed";
            }

        /* Upload Multiple Notes */
    
        $upload_notes=$_FILES['upload-notes']['name'];
		
        foreach($_FILES['upload-notes']['name'] as $key=>$val) {
            $upload_notes=$_FILES['upload-notes']['name'][$key];
            
        $upload_notes_extension=explode('.',$upload_notes);
        $upload_notes_check=strtolower(end($upload_notes_extension));
        $upload_notes_extstored=array('pdf');
        
    
            if (in_array($upload_notes_check, $upload_notes_extstored)) {
                
                $upload_notes_insert = query("INSERT INTO seller_notes_attachements(NoteID, CreatedBy, CreatedDate, ModifiedDate, ModifiedBy) VALUES('{$note_id}', '{$seller_id}', '{$created_date}', '{$modified_date}', '{$seller_id}')");
                confirm($upload_notes_insert);
                $attach_id=mysqli_insert_id($connection);
                
                if (!is_dir("../Members/")) {
                    mkdir('../Members/');
                }
                if (!is_dir("../Members/" . $seller_id)) {
                    mkdir("../Members/" . $seller_id);
                }
                if (!is_dir("../Members/" . $seller_id . "/" . $note_id)) {
                    mkdir('../Members/' . $seller_id . '/' . $note_id);
                }
                if (!is_dir("../Members/" . $seller_id . "/" . $note_id . "/" . "Attachements")) {
                        mkdir('../Members/' . $seller_id . '/' . $note_id . '/' . 'Attachements');
                }
    
                $multiple_file_name = '../Members/' . $seller_id . '/' . $note_id . '/' . 'Attachements/' . $attach_id . '_' . time() . '.' . $upload_notes_check;
                move_uploaded_file($_FILES['upload-notes']['tmp_name'][$key], $multiple_file_name);
                $attached_name = $attach_id . "_" . time() . $upload_notes_check;
                
                $query= query("UPDATE seller_notes_attachements SET FileName='$attached_name' , FilePath='$multiple_file_name'  WHERE ID=$attach_id");
                confirm($query);
                
            } else {
                echo "Upload Notes failed";
            }
        }
}
        
        if(isset($_GET['note_id'])) {

            $get_note_id = $_GET['note_id'];

            $select_query = query("SELECT * FROM seller_notes WHERE ID = '$get_note_id' ");
            confirm($select_query);

            while($row = mysqli_fetch_assoc($select_query)) {
                $db_title           = escape_string($row['Title']);
                $db_category_id     = escape_string($row['Category']);
                $db_display_pic     = escape_string($row['DisplayPicture']);
                $db_type_id         = escape_string($row['NoteType']);
                $db_no_of_page      = escape_string($row['NumberOfPages']);
                $db_description     = escape_string($row['Description']);
                $db_country_id      = escape_string($row['Country']);
                $db_university_name = escape_string($row['UniversityName']);
                $db_course_name     = escape_string($row['Course']);
                $db_course_code     = escape_string($row['CourseCode']);
                $db_professor       = escape_string($row['Professor']);
                $db_ispaid          = escape_string($row['IsPaid']);
                $db_sell_price      = escape_string($row['SellingPrice']);
                $db_note_preview    = escape_string($row['NotesPreview']);

            }
            if(isset($_POST['save2'])) {

            $title                     = escape_string($_POST['title']);
            $category                  = escape_string($_POST['category']);
            $type                      = escape_string($_POST['type']);
            $display_picture           = "../Members/Default/Admin_default_img.png";
            $upload_notes              = escape_string($_FILES['upload-notes']['name']);
            $upload_notes_tmp_loc      = escape_string($_FILES['upload-notes']['tmp_name']);
            $number_of_pages           = escape_string($_POST['number-of-pages']);
            $description               = escape_string($_POST['description']);
            $country                   = escape_string($_POST['country']);
            $institute_name            = escape_string($_POST['institution-name']);
            $course_name               = escape_string($_POST['course-name']);
            $course_code               = escape_string($_POST['course-code']);
            $professor                 = escape_string($_POST['professor']);
            $note_preview              = "../Members/Default/Admin_default_img.png";
            $ispaid                    = escape_string($_POST['sellfor-radio']);
            $sell_price                = escape_string($_POST['sell-price']);

            if($ispaid == "free") {
                $ispaid = false;
                $sell_price = null;
            }else {
                $sell_price = escape_string($_POST['sell-price']);
                $ispaid = true;
            }

        unlink($db_display_pic);
        unlink($db_note_preview);

        $modified_date = date('Y-m-d H:i:s');
        $update_query ="UPDATE seller_notes SET ";
        $update_query .="Title             = '{$title}'             , ";
        $update_query .="Category          = '{$category}'          , ";
        $update_query .="NoteType          = '{$type}'              , ";
        $update_query .="NumberOfPages     = '{$number_of_pages}'   , ";
        $update_query .="Description       = '{$description}'       , ";
        $update_query .="Country           = '{$country}'           , ";
        $update_query .="UniversityName    = '{$institute_name}'    , ";
        $update_query .="Course            = '{$course_name}'       , ";
        $update_query .="CourseCode        = '{$course_code}'       , ";
        $update_query .="Professor         = '{$professor}'         , ";
        $update_query .="IsPaid            = '{$ispaid}'            , ";
        $update_query .="SellingPrice      = '{$sell_price}'        , ";
        $update_query .="ModifiedDate      = '{$modified_date}'      ";
        $update_query .="WHERE ID= '{$get_note_id}' ";

        $update_notes = query($update_query);
        confirm($update_notes);


        /* Diplay Picture */
        $display_picture           = $_FILES['display-picture'];
        $display_picture_name      = $display_picture['name'];
        $display_picture_tmp_loc   = $display_picture['tmp_name'];
        $display_picture_extension = explode('.',$display_picture_name);
        $display_picture_check     = strtolower(end($display_picture_extension));
        $display_picture_extstored = array('png', 'jpg', 'jpeg');

            if(in_array($display_picture_check, $display_picture_extstored)) {
                if(!is_dir("../Members/")) {
                    mkdir('../Members/');
                }
                if(!is_dir("../Members/" . $seller_id)) {
                    mkdir('../Members/' . $seller_id);
                }
                if(!is_dir("../Members/" . $seller_id . "/" . $get_note_id)) {
                    mkdir('../Members/' . $seller_id . '/' . $get_note_id);
                }
                $display_picture_destination = '../Members/' . $seller_id . '/' . $get_note_id . '/' . "DP_" . time() . '.' .$display_picture_check;
                move_uploaded_file($display_picture_tmp_loc, $display_picture_destination);
                $display_picture_query = query("UPDATE seller_notes SET DisplayPicture='$display_picture_destination' WHERE ID = '$get_note_id' ");
                confirm($display_picture_query);

            }else {
                echo "Display Picture Upload failed";
            }
        

        /* Note Preview */
        $note_preview           = $_FILES['note-preview'];
        $note_preview_name      = $note_preview['name'];
        $note_preview_tmp_loc   = $note_preview['tmp_name'];
        $note_preview_extension = explode('.',$note_preview_name);
        $note_preview_check     = strtolower(end($note_preview_extension));
        $note_preview_extstored = array('pdf');

            if(in_array($note_preview_check, $note_preview_extstored)) {
                if(!is_dir("../Members/")) {
                    mkdir('../Members/');
                }
                if(!is_dir("../Members/" . $seller_id)) {
                    mkdir('../Members/' . $seller_id);
                }
                if(!is_dir("../Members/" . $seller_id . "/" . $get_note_id)) {
                    mkdir('../Members/' . $seller_id . '/' . $get_note_id);
                }
                $note_preview_destination = '../Members/' . $seller_id . '/' . $get_note_id . '/' . "Preview_" . time() . '.' .$note_preview_check;
                move_uploaded_file($note_preview_tmp_loc, $note_preview_destination);
                $note_preview_query = query("UPDATE seller_notes SET NotesPreview='$note_preview_destination' WHERE ID = '$get_note_id' ");
                confirm($note_preview_query);
            }else {
                echo "Notes Preview Upload failed";
            }

           /* Upload Multiple Notes */
           $select_upload_notes = query("SELECT ID,FilePath FROM seller_notes_attachements WHERE NoteID = '{$get_note_id}' ");
           confirm($select_upload_notes);

           while($r = mysqli_fetch_assoc($select_upload_notes)){

                $db_file_path = $r['FilePath'];
                unlink($db_file_path);

           }
           
        $upload_notes=$_FILES['upload-notes']['name'];
		
        foreach($_FILES['upload-notes']['name'] as $key=>$val) {
            $upload_notes=$_FILES['upload-notes']['name'][$key];
            
        $upload_notes_extension=explode('.',$upload_notes);
        $upload_notes_check=strtolower(end($upload_notes_extension));
        $upload_notes_extstored=array('pdf');
        

            if (in_array($upload_notes_check, $upload_notes_extstored)) {
                
                if (!is_dir("../Members/")) {
                    mkdir('../Members/');
                }
                if (!is_dir("../Members/" . $seller_id)) {
                    mkdir("../Members/" . $seller_id);
                }
                if (!is_dir("../Members/" . $seller_id . "/" . $get_note_id)) {
                    mkdir('../Members/' . $seller_id . '/' . $get_note_id);
                }
                if (!is_dir("../Members/" . $seller_id . "/" . $get_note_id . "/" . "Attachements")) {
                        mkdir('../Members/' . $seller_id . '/' . $get_note_id . '/' . 'Attachements');
                }
    
                $multiple_file_name = '../Members/' . $seller_id . '/' . $get_note_id . '/' . 'Attachements/' . $attach_id . '_' . time() . '.' . $upload_notes_check;
                move_uploaded_file($_FILES['upload-notes']['tmp_name'][$key], $multiple_file_name);
                $attached_name = $attach_id . "_" . time() . $upload_notes_check;
                
                $query= query("UPDATE seller_notes_attachements SET FileName='$attached_name' , FilePath='$multiple_file_name',  ModifiedDate = '$modified_date'  WHERE ID='$attach_id' ");
                confirm($query);
                
            } else {
                echo "Upload Notes failed";
            }
        }

    }

    if(isset($_POST['publish'])) {
        $get_note_id = $_GET['note_id'];

        $title                     = escape_string($_POST['title']);
        $category                  = escape_string($_POST['category']);
        $type                      = escape_string($_POST['type']);
        $display_picture           = "../Members/Default/Admin_default_img.png";
        $upload_notes              = escape_string($_FILES['upload-notes']['name']);
        $upload_notes_tmp_loc      = escape_string($_FILES['upload-notes']['tmp_name']);
        $number_of_pages           = escape_string($_POST['number-of-pages']);
        $description               = escape_string($_POST['description']);
        $country                   = escape_string($_POST['country']);
        $institute_name            = escape_string($_POST['institution-name']);
        $course_name               = escape_string($_POST['course-name']);
        $course_code               = escape_string($_POST['course-code']);
        $professor                 = escape_string($_POST['professor']);
        $note_preview              = "../Members/Default/Admin_default_img.png";
        $ispaid                    = escape_string($_POST['sellfor-radio']);
        $sell_price                = escape_string($_POST['sell-price']);

        if($ispaid == "free") {
            $ispaid = false;
            $sell_price = null;
        }else {
            $sell_price = escape_string($_POST['sell-price']);
            $ispaid = true;
        }

    unlink($db_display_pic);
    unlink($db_note_preview);

    $modified_date = date('Y-m-d H:i:s');
    $update_status_query ="UPDATE seller_notes SET ";
    $update_status_query .="Title             = '{$title}'             , ";
    $update_status_query .="Category          = '{$category}'          , ";
    $update_status_query .="NoteType          = '{$type}'              , ";
    $update_status_query .="NumberOfPages     = '{$number_of_pages}'   , ";
    $update_status_query .="Description       = '{$description}'       , ";
    $update_status_query .="Country           = '{$country}'           , ";
    $update_status_query .="UniversityName    = '{$institute_name}'    , ";
    $update_status_query .="Course            = '{$course_name}'       , ";
    $update_status_query .="CourseCode        = '{$course_code}'       , ";
    $update_status_query .="Professor         = '{$professor}'         , ";
    $update_status_query .="IsPaid            = '{$ispaid}'            , ";
    $update_status_query .="SellingPrice      = '{$sell_price}'        , ";
    $update_status_query .="Status            = 9                      , ";
    $update_status_query .="ModifiedDate      = '{$modified_date}'      ";
    $update_status_query .="WHERE ID= '{$get_note_id}' ";

    $update_notes_status = query($update_status_query);
    confirm($update_notes_status);

    if($update_notes_status) {
                $select_id = query("SELECT Title,SellerID FROM seller_notes WHERE ID='{$get_note_id}' ");
                confirm($select_id);
                while($note_row=mysqli_fetch_assoc($select_id)) {
                   $note_title = $note_row['Title'];
                   $seller_id = $note_row['SellerID'];
                }

                $select_seller_name = query("SELECT * FROM users WHERE ID='$seller_id' ");
                confirm($select_seller_name);
                while($seller_row=mysqli_fetch_assoc($select_seller_name)) {
                   $seller_fname = $seller_row['FirstName'];
                   $seller_lname = $seller_row['LastName'];
                   $seller_email = $seller_row['EmailID'];
                }

              
                $subject = $seller_fname." ".$seller_lname." sent his note for review";
                $email = "sroshani025@gmail.com";
                $body = "Hello Admins, "."\r\n"."\r\n"."We want to inform you that, " .$seller_fname." ".$seller_lname. " sent his note"."\r\n".$note_title." for review. Please look at the notes and take required actions. " ."\r\n"."\r\n"."Regards,"."\r\n". "Notes Marketplace";
                $sender_email = "Email From: {$email}";
                $result = mail($seller_email, $subject, $body, $sender_email);
         
                if(!$result) {
                echo "<script>alert('Email sending failed....')</script>";
                }else {
                    redirect("Dashboard.php");
                }

    }


    /* Diplay Picture */
    $display_picture           = $_FILES['display-picture'];
    $display_picture_name      = $display_picture['name'];
    $display_picture_tmp_loc   = $display_picture['tmp_name'];
    $display_picture_extension = explode('.',$display_picture_name);
    $display_picture_check     = strtolower(end($display_picture_extension));
    $display_picture_extstored = array('png', 'jpg', 'jpeg');

        if(in_array($display_picture_check, $display_picture_extstored)) {
            if(!is_dir("../Members/")) {
                mkdir('../Members/');
            }
            if(!is_dir("../Members/" . $seller_id)) {
                mkdir('../Members/' . $seller_id);
            }
            if(!is_dir("../Members/" . $seller_id . "/" . $get_note_id)) {
                mkdir('../Members/' . $seller_id . '/' . $get_note_id);
            }
            $display_picture_destination = '../Members/' . $seller_id . '/' . $get_note_id . '/' . "DP_" . time() . '.' .$display_picture_check;
            move_uploaded_file($display_picture_tmp_loc, $display_picture_destination);
            $display_picture_query = query("UPDATE seller_notes SET DisplayPicture='$display_picture_destination' WHERE ID = '$get_note_id' ");
            confirm($display_picture_query);

        }else {
            echo "Display Picture Upload failed";
        }
    

    /* Note Preview */
    $note_preview           = $_FILES['note-preview'];
    $note_preview_name      = $note_preview['name'];
    $note_preview_tmp_loc   = $note_preview['tmp_name'];
    $note_preview_extension = explode('.',$note_preview_name);
    $note_preview_check     = strtolower(end($note_preview_extension));
    $note_preview_extstored = array('pdf');

        if(in_array($note_preview_check, $note_preview_extstored)) {
            if(!is_dir("../Members/")) {
                mkdir('../Members/');
            }
            if(!is_dir("../Members/" . $seller_id)) {
                mkdir('../Members/' . $seller_id);
            }
            if(!is_dir("../Members/" . $seller_id . "/" . $get_note_id)) {
                mkdir('../Members/' . $seller_id . '/' . $get_note_id);
            }
            $note_preview_destination = '../Members/' . $seller_id . '/' . $get_note_id . '/' . "Preview_" . time() . '.' .$note_preview_check;
            move_uploaded_file($note_preview_tmp_loc, $note_preview_destination);
            $note_preview_query = query("UPDATE seller_notes SET NotesPreview='$note_preview_destination' WHERE ID = '$get_note_id' ");
            confirm($note_preview_query);
        }else {
            echo "Notes Preview Upload failed";
        }

       /* Upload Multiple Notes */
       $select_upload_notes = query("SELECT ID,FilePath FROM seller_notes_attachements WHERE NoteID = '{$get_note_id}' ");
       confirm($select_upload_notes);

       while($r = mysqli_fetch_assoc($select_upload_notes)){

            $db_file_path = $r['FilePath'];
            unlink($db_file_path);

       }
       
    $upload_notes=$_FILES['upload-notes']['name'];
    
    foreach($_FILES['upload-notes']['name'] as $key=>$val) {
        $upload_notes=$_FILES['upload-notes']['name'][$key];
        
    $upload_notes_extension=explode('.',$upload_notes);
    $upload_notes_check=strtolower(end($upload_notes_extension));
    $upload_notes_extstored=array('pdf');
    

        if (in_array($upload_notes_check, $upload_notes_extstored)) {
            
            if (!is_dir("../Members/")) {
                mkdir('../Members/');
            }
            if (!is_dir("../Members/" . $seller_id)) {
                mkdir("../Members/" . $seller_id);
            }
            if (!is_dir("../Members/" . $seller_id . "/" . $get_note_id)) {
                mkdir('../Members/' . $seller_id . '/' . $get_note_id);
            }
            if (!is_dir("../Members/" . $seller_id . "/" . $get_note_id . "/" . "Attachements")) {
                    mkdir('../Members/' . $seller_id . '/' . $get_note_id . '/' . 'Attachements');
            }

            $multiple_file_name = '../Members/' . $seller_id . '/' . $get_note_id . '/' . 'Attachements/' . $attach_id . '_' . time() . '.' . $upload_notes_check;
            move_uploaded_file($_FILES['upload-notes']['tmp_name'][$key], $multiple_file_name);
            $attached_name = $attach_id . "_" . time() . $upload_notes_check;
            
            $query= query("UPDATE seller_notes_attachements SET FileName='$attached_name' , FilePath='$multiple_file_name',  ModifiedDate = '$modified_date'  WHERE ID='$attach_id' ");
            confirm($query);
            
        } else {
            echo "Upload Notes failed";
        }
    }

}

}
}else {
    redirect("Login.php");
}
?>

    <?php include "header.php"; ?>

    <!-- Add Notes -->
    <div id="addNotes">
        <div class="add-notes-img">
            <img src="images/Add-notes/banner-with-overlay.jpg">
            <div class="add-notes-img-text">Add Notes</div>
        </div>

        <form action="" method="POST" enctype="multipart/form-data" onsubmit="return add_notes()">
            <div class="container">
                <p class="add-notes-headings"></p>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="title" for="title">Title *</label>
                            <input type="text" name="title" id="title" class="form-control"
                                placeholder="Enter your notes title" value="<?php if(isset($_GET['note_id'])){echo $db_title;}?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="category" for="category">Category *</label>
                            <span><img class="add-notes-arrow-down-img" src="./images/Add-notes/arrow-down.svg"></span>
                            <select class="form-control" id="category" name="category">
                                <?php
                                $show_category_query = query("SELECT Category_Name FROM note_categories WHERE ID='$db_category_id' ");
                                confirm($show_category_query);

                                while($show_category_row = mysqli_fetch_assoc($show_category_query)) {
                                    $category_title=$show_category_row['Category_Name'];
                                    }
                                ?>
                                <option selected value="<?php if(isset($_GET['note_id'])){echo $db_category_id;}?>"><?php if(isset($_GET['note_id'])){echo $category_title;}?><?php if(!isset($_GET['note_id'])){?>Select Your Category<?php }?></option>

                                <?php 
                                $category_query = query("SELECT ID,Category_Name FROM note_categories");
                                confirm($category_query);

                                while($category_row = mysqli_fetch_assoc($category_query)) {
                                $category_id=$category_row['ID'];
                                $category_name=$category_row['Category_Name'];
                                echo "<option value='$category_id'>$category_name</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="displayPicture" for="displayPicture">Display Picture</label>
                            <label for="display-picture"><img class="add-notes-upload-file-img1"
                                    src="./images/Add-notes/upload-file.png"></label>
                            <span class="dp-text">Upload a picture</span>
                            <div style="border:1px solid #d1d1d1;border-radius: 3px;height: 110px;">
                            <input type="file" id="display-picture" name="display-picture" class="form-control"
                                placeholder="Upload a picture" value="<?php if(isset($_GET['note_id'])){echo $db_display_picture;}?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="uploadNotes" for="uploadNotes">Upload your notes *</label>
                            <label for="upload-notes"><img class="add-notes-upload-notes-img"
                                    src="./images/Add-notes/upload-note.png"></label>
                            <span class="un-text">Upload your notes</span>
                            <div style="border:1px solid #d1d1d1;border-radius: 3px;height: 110px;">
                            <input type="file" accept=".pdf" id="upload-notes" name="upload-notes[]" class="form-control"
                                placeholder="Upload your notes" multiple value="<?php if(isset($_GET['note_id'])){echo $db_upload_notes;}?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="type" for="type">Type</label>
                            <label for="type"><img class="add-notes-arrow-down-img" src="./images/Add-notes/arrow-down.svg"></label>
                            <select class="form-control" id="type" name="type">
                            <?php
                                $show_type_query = query("SELECT Type_Name FROM note_types WHERE ID='$db_type_id' ");
                                confirm($show_type_query);

                                while($show_type_row = mysqli_fetch_assoc($show_type_query)) {
                                    $note_type_title = $show_type_row['Type_Name'];
                                    }
                            ?>
                                <option selected value="<?php if(isset($_GET['note_id'])){echo $db_type_id;}?>"><?php if(isset($_GET['note_id'])){echo $note_type_title;}?><?php if(!isset($_GET['note_id'])){?>Select your notes type<?php }?></option>

                                <?php  
                                $type_query = query("SELECT ID,Type_Name FROM note_types");
                                confirm($type_query);

                               while($type_row = mysqli_fetch_assoc($type_query)) {
                               $type_id=$type_row['ID'];
                               $type_name=$type_row['Type_Name'];
                               echo "<option value='$type_id'>$type_name</option>";
                               }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="noOfPages" for="noOfPages">Number of Pages</label>
                            <input type="text" name="number-of-pages" id="number-of-pages" class="form-control"
                                placeholder="Enter number of notes pages" value="<?php if(isset($_GET['note_id'])){echo $db_no_of_page;}?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="description" for="description">Description *</label>
                            <input type="text" id="description" name="description" placeholder="Enter your description" value="<?php if(isset($_GET['note_id'])){echo $db_description;}?>" required>
                        </div>
                    </div>
                </div>
                <p class="add-notes-headings">Institution information</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="country" for="country">Country </label>
                            <span><img class="add-notes-arrow-down-img" src="./images/Add-notes/arrow-down.svg"></span>
                            <select class="form-control" id="country" name="country">

                            <?php
                                $show_country_query = query("SELECT Country_Name FROM countries WHERE ID='$db_country_id' ");
                                confirm($show_country_query);

                                while($show_country_row = mysqli_fetch_assoc($show_country_query)) {
                                    $country_title = $show_country_row['Country_Name'];
                                    }
                            ?>
                            <option selected value="<?php if(isset($_GET['note_id'])){echo $db_country_id;}?>"><?php if(isset($_GET['note_id'])){echo $country_title;}?><?php if(!isset($_GET['note_id'])){?>Select your country<?php }?></option>

                                <?php 
                                $country = query("SELECT ID,Country_Name FROM countries");
                                confirm($country);

                                while($country_row = mysqli_fetch_assoc($country)) {
                                $country_id=$country_row['ID'];
                                $country_name=$country_row['Country_Name'];
                                echo "<option value='$country_id'>$country_name</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="institutionName" for="institutionName">Institution Name</label>
                            <input type="text" name="institution-name" id="institution-name" class="form-control"
                                placeholder="Enter your institution name" value="<?php if(isset($_GET['note_id'])){echo $db_university_name;}?>">
                        </div>
                    </div>
                </div>
                <p class="add-notes-headings">Course Details</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="courseName" for="courseName">Course Name</label>
                            <input type="text" name="course-name" id="course-name" class="form-control"
                                placeholder="Enter your course name" value="<?php if(isset($_GET['note_id'])){echo $db_course_name;}?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="courseCode" for="courseCode">Course Code</label>
                            <input type="text" name="course-code" id="course-code" class="form-control"
                                placeholder="Enter your course code" value="<?php if(isset($_GET['note_id'])){echo $db_course_code;}?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="professor" for="professor">Professor / Lecturer</label>
                            <input type="text" name="professor" id="professor" class="form-control"
                                placeholder="Enter your professor name" value="<?php if(isset($_GET['note_id'])){echo $db_professor;}?>">
                        </div>
                    </div>
                </div>
                <p class="add-notes-headings">Selling Information</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12"><label class="sellFor" for="sellFor">Sell For *</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-2 col-xs-4">
                                            <label for="free" class="radio">
                                                <?php 
                                                if(isset($_GET['note_id'])){?>
                                                    <input type="radio" name="sellfor-radio" id="free" value="free"
                                                    class="radio-input form-control" <?php if($db_ispaid == 0) {echo 'checked';}?> onChange="getValue(this)">
                                                    <?php

                                                    }else {
                                                       
                                                ?>
                                                <input type="radio" name="sellfor-radio" id="free" value="free"
                                                    class="radio-input form-control" onChange="getValue(this)">
                                                    <?php }
                                                ?>
                                                
                                                <div class="internal-circle"></div>
                                                Free
                                            </label>
                                        </div>
                                        <div class="col-md-9 col-sm-10 col-xs-8">
                                            <label for="paid" class="radio">
                                            <?php 

                                                if(isset($_GET['note_id'])){?>
                                                    <input type="radio" name="sellfor-radio" id="paid" value="paid"
                                                    class="radio-input form-control" <?php if($db_ispaid == 1) {echo 'checked';}?> onChange="getValue(this)">
                                                    <?php

                                                    }else {
                                                    
                                                ?>
                                                <input type="radio" name="sellfor-radio" id="paid" value="paid"
                                                    class="radio-input form-control" onChange="getValue(this)">
                                                    <?php }
                                           ?>
                                                
                                                   
                                                <div class="internal-circle"></div>
                                                Paid
                                            </label>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" id="sell-price-field">
                                    <label class="sellPrice" for="sellPrice">Sell Price *</label>
                                    <input type="text" name="sell-price" id="sell-price" class="form-control"
                                        placeholder="Enter your price" value="<?php if(isset($_GET['note_id'])){echo $db_sell_price;}?>" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="notePreview" for="notePreview">Note Preview</label>
                            <label for="note-preview"><img class="add-notes-upload-file-img2"
                                    src="./images/Add-notes/upload-file.png"></label>
                            <span class="np-text">Upload a file</span>
                            <div style="border:1px solid #d1d1d1;border-radius: 3px;height: 130px;">
                            <input type="file" id="note-preview" name="note-preview" class="form-control"
                                placeholder="Upload a file" value="<?php if(isset($_GET['note_id'])){echo $db_note_preview;}?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">

                    <?php 
                        if(isset($_GET['note_id'])){
                            $get_noteid = $_GET['note_id'];
                            ?>
                            
                            <div class="col-md-2 col-sm-3 col-xs-6">
                                <button type="submit" name="save2" class="btn btn-primary add-notes-save-btn">SAVE</button>
                            </div>
                            <div class="col-md-10 col-sm-9 col-xs-6">
                                <button type="submit" class="btn btn-primary add-notes-publish-btn" onclick='javascript:Publish($(this));return false;' name="publish">PUBLISH</button>
                            </div>

                     <?php }else{
                     ?>
                    <div class="col-md-2 col-sm-3 col-xs-6">
                        <button type="submit" name="save" class="btn btn-primary add-notes-save-btn">SAVE</button>
                    </div>
                    <div class="col-md-10 col-sm-9 col-xs-6">
                                <a><button type="submit" name="publish" class="btn btn-primary add-notes-publish-btn" disabled>PUBLISH</button></a>
                            </div>
                    <?php }?>
                </div>
            </div>

        </form>
    </div>
    <!-- Add Notes Ends -->

    <script>
    
    /* Show & Hide Sell Price Field */
    
    function getValue(x) {
        if(x.value == 'free') {
            document.getElementById("sell-price-field").style.display = 'none';
        }else {
            document.getElementById("sell-price-field").style.display = 'block';
        }
    }
    </script>
    
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
                        <li><a href="#"><img src="images/Add-notes/facebook.png"></a></li>
                        <li><a href="#"><img src="images/Add-notes/twitter.png"></a></li>
                        <li><a href="#"><img src="images/Add-notes/linkedin.png"></a></li>
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

    <!-- Datatables JS -->
    <script src="js/datatables.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
</body>

</html>
<script>
/*
const title       = document.getElementById('title');
const description = document.getElementById('description');

function add_notes() {
    var x= checkInputs();
        if(x) {
            return true;
        }else{
            return false;
        }
}

    function checkInputs(){
        var flag =0;
        const titleValue       = title.value.trim();
        const descriptionValue = description.value.trim();

        if (titleValue === '') {
            setErrorFor(title, 'Title cannot be blank');
            flag=0;
        }else {
            setSuccessFor(title);
            flag=1;
        }

        
        if (descriptionValue === '') {
            setErrorFor(description, 'Description cannot be blank');
            flag=0;
        }
        else {
            setSuccessFor(description);
            flag=1;
        }

        if(flag == 1) {
            return true;
        }else {
            return false;
        }

    }

    function setErrorFor(input, message) {
        const formGroup = input.parentElement;
        const small = formGroup.querySelector('small');
        formGroup.className = 'form-group error';
        small.innerText = message;
        
    }

    function setSuccessFor(input) {
        const formGroup = input.parentElement;
        formGroup.className = 'form-group';
       
    }
  */

</script>
