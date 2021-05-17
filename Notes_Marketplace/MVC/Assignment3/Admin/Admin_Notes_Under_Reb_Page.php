<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();

if(isset($_SESSION['userid'])) {
    $admin_id = $_SESSION['userid'];
}

    

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

        echo "<script>console.log('in reject btn');</script>";

        $reject_noteid = $_POST['noteid_for_reject'];
        $remark = $_POST['remark'];
        $modified_date = date("Y-m-d H:i:s");
        
        $update_to_rejected = query("UPDATE seller_notes SET Status = 10 AND ActionedBy = '$admin_id' AND AdminRemarks = '$remark' AND ModifiedDate ='$modified_date' AND ModifiedBy = '$admin_id' WHERE ID = '$reject_noteid' AND Status IN(7,8)");
        confirm($update_to_rejected);
        

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
                            <select class="form-control" id="seller" name="seller" onchange="showdata()">
                                
                                <?php
                                if(isset($_GET['Member_id'])) {
                                    $member_id = $_GET['Member_id'];

                                    $find_seller = query("SELECT FirstName, LastName FROM users WHERE ID = '$member_id' ");
                                    confirm($find_seller); ?>
                                    
                                <?php    while($row = mysqli_fetch_assoc($find_seller)) {
                                        $seller_name = $row['FirstName']. " ". $row['LastName'];

                                    ?>
                                    <option value="<?php echo $member_id; ?>" selected><?php echo $seller_name; ?></option>
                                <?php 
                                    } 
                                } else {

                                    $show_seller = query("SELECT  DISTINCT users.ID, FirstName, LastName FROM users LEFT JOIN seller_notes ON users.ID = seller_notes.SellerID WHERE 
                                    seller_notes.Status = 7 OR seller_notes.Status = 8");
                                    confirm($show_seller);
                                    ?>
                                    <option value="0" selected>Select</option>
                                <?php    while($row = mysqli_fetch_assoc($show_seller)) {
                                        $seller_name = $row['FirstName']. " ". $row['LastName'];
                                        $seller_id = $row['ID'];
                                    ?>
                                    <option value="<?php echo $seller_id; ?>"><?php echo $seller_name; ?></option>
                                <?php    
                                    }
                                
                                }
                                ?>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-8 col-xs-8">

                        <span><img class="search-icon-img"
                                src="./images/Admin/Note_Under_Review/search-icon.png"></span>
                        <input type="text" name="search" id="search" placeholder="Search">
                        <button type="submit" class="btn btn-primary search-btn" onclick="showdata()">SEARCH</button>

                    </div>
                </div>
            </div>

            <div id="result">
            
            
            </div>
   
      
</div>

</div>
<script>
    function InReview() {
        if (confirm("Via marking the note In Review – System will let user know that review process has been initiated. Please press yes to continue.")) {
            //txt = "You Pressed Ok!";
            window.location = anchor.attr("href");
        } else {
            txt = "You Pressed Cancel!";
        }
    }

    function Approve() {
        if (confirm(
                "If you approve the notes – System will publish the notes over portal. Please press yes to continue."
                )) {
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

<script type="text/javascript">
            function showdata(page_current) {
                let search_seller = $("#seller").val();
                let search_result = $("#search").val();

                $.ajax({
                    url: "Admin_Notes_Under_Reb_Page_Ajax.php",
                    method: "GET",
                    data: {
                        selected_seller: search_seller,
                        selected_search: search_result
                    },
                    success: function (search_data) {
                        $("#result").html(search_data);
                    }
                });
            }
            $(function () {
                showdata(1);
            });

</script>

<!-- Bootstrap JS -->
<script src="js/bootstrap/bootstrap.min.js"></script>

<!-- Datatables JS -->
<script src="js/datatables.js"></script>

</body>

</html>