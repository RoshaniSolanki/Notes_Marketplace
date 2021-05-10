<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();

if(isset($_GET['Member_id'])) {

    $member_id = $_GET['Member_id'];

    $select_query = query("SELECT seller_notes.*, note_categories.Category_Name FROM seller_notes LEFT JOIN note_categories ON seller_notes.Category = note_categories.ID WHERE 
    Status = 10 ORDER BY seller_notes.CreatedDate DESC");
    confirm($select_query);

}

    $select_query = query("SELECT seller_notes.*, note_categories.Category_Name FROM seller_notes LEFT JOIN note_categories ON seller_notes.Category = note_categories.ID WHERE 
    Status = 10 ORDER BY seller_notes.CreatedDate DESC");
    confirm($select_query);



    //download note
    if(isset($_GET['Note_id'])){
        $note_id=$_GET['Note_id'];

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

    //update status to published
    if(isset($_GET['approve_noteid'])) {
        $pub_note_id = $_GET['approve_noteid'];

        $update_to_published = query("UPDATE seller_notes SET Status = 9 WHERE ID = {$pub_note_id} AND Status IN(7,8)");
        confirm($update_to_published);
        redirect("Admin_Rejected_Notes.php");
    }

?>
<?php include "header.php"; ?>
    <!-- Rejected Notes-->
    <div id="adminRejectedNotes">
        <div class="container">
            <div id="part1">
                <div class="row">
                    <div class="col-md-12">
                        <p>Rejected Notes</p>
                    </div>
                </div>
            </div>
            <div id="part2">
                <div class="row">
                    <div class="col-md-12">
                        <label class="seller" for="seller">Seller</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <span><img class="arrow-down-img" src="./images/Admin/Rejected_Notes/down-arrow.png"></span>
                            <select class="form-control" id="seller" name="seller">
                                <option selected disabled hidden>Rahul Shah</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-8 col-xs-8">

                        <span><img class="search-icon-img" src="./images/Admin/Rejected_Notes/search-icon.png"></span>
                        <input type="text" name="search" id="search" placeholder="Search">
                        <a href=""><button class="btn btn-primary search-btn">SEARCH</button></a>

                    </div>
                </div>
            </div>
            <div id="part3">
                <div class="row">
                    <div class="col-md-12">
                    <div class="table-responsive">
                            <table class="table" id="rejected-notes-table">
                            <thead>
                                <tr>
                                    <th>SR NO.</th>
                                    <th>NOTE TITLE</th>
                                    <th>CATEGORY</th>
                                    <th>SELLER</th>
                                    <th>DATE EDITED</th>
                                    <th>REJECTED BY</th>
                                    <th>REMARK</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                            <?php
                            $i=1;
                                while($row = mysqli_fetch_assoc($select_query)) {
                                    $note_id = $row['ID'];
                                    $note_title = $row['Title'];
                                    $note_cat  = $row['Category_Name'];
                                    $seller_id = $row['SellerID'];
                                    $db_date_edited = $row['CreatedDate'];
                                    $rejected_by_id = $row['ActionedBy'];
                                    $remark = $row['AdminRemarks'];

                                    $db_date_timestamp = strtotime($db_date_edited);
                                    $date_edited = date('d-m-Y, H:i', $db_date_timestamp);

                                //admin info
                                $find_admin_info = query("SELECT FirstName, LastName FROM users WHERE ID = '{$rejected_by_id}' ");
                                confirm($find_admin_info);

                                while($row = mysqli_fetch_assoc($find_admin_info )) {
                                    $rejected_by = $row['FirstName'] . " " . $row['LastName'];
                                }

                                //seller
                                $find_seller_info = query("SELECT FirstName, LastName FROM users WHERE ID = '{$seller_id}' ");
                                confirm($find_seller_info);

                                while($row = mysqli_fetch_assoc($find_seller_info)) {
                                    $seller = $row['FirstName'] . " " . $row['LastName'];
                                }

                                
                            ?>
                                <td><?php echo $i; ?></td>
                                <td><a href="Admin_Note_Details.php?Note_id=<?php echo $note_id; ?>"><?php echo $note_title; ?></a></td>
                                <td><?php echo $note_cat; ?></td>
                                <td><?php echo $seller; ?><span><a href="Admin_Member_Details.php?Member_id=<?php echo $seller_id;?>"><img class="eye-img"
                                            src="./images/Admin/Rejected_Notes/eye.png"></a></span></td>
                                <td><?php echo $date_edited; ?></td>
                                <td><?php echo $rejected_by; ?></td>
                                <td><?php echo $remark; ?></td>
                                <td>
                                    <div class="admin-menu-popup">
                                        <a class="admin-menu-check" target="#arn<?php echo $i; ?>">
                                            <img class="dots-img" src="./images/Admin/Rejected_Notes/dots.png">
                                        </a>
                                        <div id="arn<?php echo $i; ?>" class="admin-menu-show">
                                            <p><a style="color:inherit;text-decoration:none;" href="Admin_Rejected_Notes.php?approve_noteid=<?php echo $note_id;?>" onclick='javascript:Approve($(this));return false;'>Approve</a></p>
                                            <p><a href="Admin_Rejected_Notes.php?Note_id=<?php echo $note_id; ?>">Download Notes</a></p>
                                            <p><a href="Admin_Note_Details.php?Note_id=<?php echo $note_id; ?>">View More Details</a></p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; }?>
                        </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            
    function Approve() {
        if(confirm("If you approve the notes – System will publish the notes over portal. Please press yes to continue.")) {
            //txt = "You Pressed Ok!";
            window.location = anchor.attr("href");
        } else {
            txt = "You Pressed Cancel!";
        }
    }
        </script>
        <!-- Rejected Notes Ends -->
        <?php include "footer.php"; ?>