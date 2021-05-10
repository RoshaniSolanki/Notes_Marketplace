<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();
if(isset($_GET['Member_id'])) {

    $member_id = $_GET['Member_id'];

    $select_query = query("SELECT seller_notes.ID, seller_notes.Title, seller_notes.CreatedDate, users.FirstName, users.LastName, reference_data.Value, note_categories.Category_Name 
    FROM seller_notes LEFT JOIN users ON seller_notes.sellerID = users.ID LEFT JOIN note_categories ON seller_notes.Category = note_categories.ID LEFT JOIN reference_data ON 
    seller_notes.Status = reference_data.ID WHERE SellerID = '{$member_id}' AND (reference_data.Value = 'Submitted For Review' OR reference_data.Value = 'In Review') ORDER BY 
    seller_notes.CreatedDate ASC");
    confirm($select_query);

}

    $select_query = query("SELECT seller_notes.ID,seller_notes.SellerID, seller_notes.Title, seller_notes.CreatedDate, users.FirstName, users.LastName, reference_data.Value, note_categories.Category_Name 
    FROM seller_notes LEFT JOIN users ON  seller_notes.sellerID = users.ID LEFT JOIN note_categories ON seller_notes.Category = note_categories.ID LEFT JOIN reference_data ON 
    seller_notes.Status = reference_data.ID WHERE (reference_data.Value = 'Submitted For Review' OR reference_data.Value = 'In Review') ORDER BY seller_notes.CreatedDate ASC");
    confirm($select_query);

    //update status to inreview
    if(isset($_GET['inreview_noteid'])) {
        $ir_note_id = $_GET['inreview_noteid'];

        $update_to_inreview = query("UPDATE seller_notes SET Status = 8 WHERE ID = {$ir_note_id} AND Status = 7 ");
        confirm($update_to_inreview);
        redirect("Admin_Notes_Under_Reb_Page.php");
    }

    //update status to published
    if(isset($_GET['approve_noteid'])) {
        $pub_note_id = $_GET['approve_noteid'];

        $update_to_published = query("UPDATE seller_notes SET Status = 9 WHERE ID = {$pub_note_id} AND Status IN(7,8)");
        confirm($update_to_published);
        redirect("Admin_Notes_Under_Reb_Page.php");
    }

    if(isset($_POST['reject-btn'])) {

        $reject_noteid = $_POST['noteid_for_reject'];
        $update_to_rejected = query("UPDATE seller_notes SET Status = 10 WHERE ID = '$reject_noteid' AND Status IN(7,8)");
        confirm($update_to_rejected);
        redirect("Admin_Notes_Under_Reb_Page.php");

    }

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

?>
<?php include "header.php"; ?>
    <!-- Notes Under Review -->
    <div id="adminNotesUnderReview">
        <div class="container">
            <form action="" method="POST">
            <div id="part1">
                <div class="row">
                    <div class="col-md-12">
                        <p>Notes Under Review</p>
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
                            <span><img class="arrow-down-img"
                                    src="./images/Admin/Note_Under_Review/down-arrow.png"></span>
                            <select class="form-control" id="seller" name="seller">
                                <option selected disabled hidden>Khayati</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-8 col-xs-8">
                        
                            <span><img class="search-icon-img"
                                    src="./images/Admin/Note_Under_Review/search-icon.png"></span>
                            <input type="text" name="search" id="search" placeholder="Search">
                            <button class="btn btn-primary search-btn">SEARCH</button>
                        
                    </div>
                </div>
            </div>
            <div id="part3">
                <div class="row">
                    <div class="col-md-12">
                    <div class="table-responsive">
                            <table class="table" id="notes-under-review-table">
                            <thead>
                                <tr>
                                    <th>SR NO.</th>
                                    <th>NOTE TITLE</th>
                                    <th>CATEGORY</th>
                                    <th>SELLER</th>
                                    <th>DATE ADDED</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=1;
                                    while($row = mysqli_fetch_assoc($select_query)){

                                        $note_id    = $row['ID'];
                                        $note_title = $row['Title'];
                                        $note_cat   = $row['Category_Name'];
                                        $seller     = $row['FirstName']. " " .$row['LastName'];
                                        $seller_id  = $row['SellerID'];
                                        $db_date    = $row['CreatedDate'];
                                        $status     = $row['Value'];

                                        $db_date_timestamp = strtotime($db_date);
                                        $date_added = date('d m Y, H:i', $db_date_timestamp);

                                ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><a href="Admin_Note_Details.php?Note_id=<?php echo $note_id; ?>"><?php echo $note_title; ?></a></td>
                                        <td><?php echo $note_cat; ?></td>
                                        <td><?php echo $seller; ?><span><a href="Admin_Member_Details.php?Member_id=<?php echo $seller_id;?>"><img class="eye-img" src="./images/Admin/Note_Under_Review/eye.png"></a></span></td>
                                        <td><?php echo $date_added; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td>
                                            <button type="submit" class="btn btn-primary approve-btn" onclick='javascript:Approve($(this));return false;'>
                                                <a style="color:inherit;text-decoration:none;" href="Admin_Notes_Under_Reb_Page.php?approve_noteid=<?php echo $note_id;?>">Approve</a>
                                            </button>
                                            <button class="btn btn-primary reject-btn" data-toggle="modal" data-target="#rejectPopup" id="reject-button" data-id="<?php echo $note_id; ?>">Reject</button>
                                            <button type="submit" class="btn btn-primary inreview-btn" onclick='javascript:InReview($(this));return false;'>
                                                <a style="color:inherit;text-decoration:none;" href="Admin_Notes_Under_Reb_Page.php?inreview_noteid=<?php echo $note_id;?>">InReview</a>
                                            </button>
                                            
                                        </td>
                                        <td>
                                        <div class="admin-menu-popup">
                                            <a class="admin-menu-check" target="#apn<?php echo $i;?>">
                                                <img class="dots-img" src="./images/Admin/Note_Under_Review/dots.png">
                                            </a>
                                            <div id="apn<?php echo $i;?>" class="admin-menu-show">
                                                <p><a href="Admin_Note_Details.php?Note_id=<?php echo $note_id; ?>">View More Details</a></p>
                                                <p><a href="Admin_Notes_Under_Reb_Page.php?Note_id=<?php echo $note_id; ?>">Download Notes</a></p>
                                            </div>
                                        </div>
                                        </td>
                                </tr>
                                <!-- reject popup -->
                                <div class="modal" id="rejectPopup" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="color:#6255a5;font-weight:600;font-size:16px;" class="modal-title" id="exampleModalLabel">
                                                            <?php echo $note_title;?></h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="" method="POST">
                                                        <div class="modal-body">
                                                            <input name="noteid_for_reject" id="noteid_for_reject"
                                                                value="" hidden>
                                                            <div class="form-group">
                                                                <label for="remark">Remarks*</label>
                                                                <textarea id="remark" class="form-control" name="remark" placeholder="Write remarks" rows="7"
                                                                    required></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" name="reject-btn" style="background:#ff3636";
                                                                onclick='javascript:Reject($(this));return false;'
                                                                >Reject</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancle</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                    </div>

                                <?php
                                    $i++;}
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </form>
            </div>

        </div>
<script>
    
    function InReview() {
        if(confirm("Via marking the note In Review – System will let user know that review process has been initiated. Please press yes to continue.")) {
            //txt = "You Pressed Ok!";
            window.location = anchor.attr("href");
        } else {
            txt = "You Pressed Cancel!";
        }
    }

    function Approve() {
        if(confirm("If you approve the notes – System will publish the notes over portal. Please press yes to continue.")) {
            //txt = "You Pressed Ok!";
            window.location = anchor.attr("href");
        } else {
            txt = "You Pressed Cancel!";
        }
    }

    function Reject() {
        if(confirm("Are you sure you want to reject seller request?")) {
            //txt = "You Pressed Ok!";
            window.location = anchor.attr("href");
        } else {
            txt = "You Pressed Cancel!";
        }
    }

</script>

    <!-- Notes Under Review Ends -->

    <!-- Footer -->
    <footer class="admin-footer">
        <hr>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="footer-text-left">Version : 1.1.24</p>
                </div>
                <div class="col-md-6">
                    <p class="footer-text-right">
                        Copyright &copy; TatvaSoft All rights reserved.
                    </p>
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

    <script>
        
    </script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

</body>

</html>