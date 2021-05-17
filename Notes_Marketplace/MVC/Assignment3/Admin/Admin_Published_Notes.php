<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();

if(isset($_SESSION['userid'])) {
    $admin_id = $_SESSION['userid'];
}
    
    //download note
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

    if(isset($_POST['unpublish-btn'])) {

        $noteid = $_POST['noteid_for_unpublish'];
        $notetitle = $_POST['notetitle_for_unpublish'];
        $sellerid = $_POST['sellerid_for_unpublish'];
        $remark  = $_POST['remark'];

        $modified_date = date("Y-m-d H:i:s");
        $update_to_removed = query("UPDATE seller_notes SET Status = 11 AND ActionedBy = '$admin_id' AND AdminRemarks = '$remark' ModifiedDate ='$modified_date' ModifiedBy = '$admin_id' WHERE ID = '$noteid' AND Status = 9 ");
        confirm($update_to_removed);

        $seller_info = query("SELECT FirstName, LastName, EmailID FROM users WHERE ID = '{$sellerid}' ");
        confirm($seller_info);

        while($row = mysqli_fetch_assoc($seller_info)) {
            $seller_name = $row['FirstName']. " ".$row['LastName'];
            $seller_email = $row['EmailID'];
        }
        
        $subject = "Sorry! We need to remove your notes from our portal.";
        $email = "sroshani025@gmail.com";
        $body = "Hello ".$seller_name.","."\r\n"."\r\n"."We want to inform you that, your note " .$notetitle. "  has been removed from the portal.
        Please find our remarks as below -" ."\r\n".$remark. "\r\n"."\r\n"."Regards,"."\r\n". "Notes Marketplace";
        $sender_email = "Email From: {$email}";
        $result = mail($seller_email, $subject, $body, $sender_email);
             
            if(!$result) {
                echo "<script>alert('Email sending failed....')</script>";
            }

        

    }
?>
<?php include "header.php"; ?>

<!-- Published Notes-->
<div id="adminPublishedNotes">
    <div class="container">
        <div id="part1">
            <div class="row">
                <div class="col-md-12">
                    <p>Published Notes</p>
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
                        <span><img class="arrow-down-img" src="./images/Admin/Published_Notes/down-arrow.png"></span>
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

                                    $show_seller = query("SELECT DISTINCT users.ID, FirstName, LastName FROM users LEFT JOIN seller_notes ON users.ID = seller_notes.SellerID WHERE 
                                    seller_notes.Status = 9");
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

                    <span><img class="search-icon-img" src="./images/Admin/Published_Notes/search-icon.png"></span>
                    <input type="text" name="search" id="search" placeholder="Search">
                    <button type="submit" class="btn btn-primary search-btn" onclick="showdata()">SEARCH</button>

                </div>
            </div>
        </div>

        <div id="result">
            
            
        </div>

        </div>
</div> 
    <!-- Published Notes Ends -->

    <script>
    /*   
function Unpublish() {
            if (confirm("Are you sure you want to Unpublish this note?")) {
                window.location = anchor.attr("href");
            } else {
                txt = "You Pressed Cancel!";
            }
}*/

        
    </script>

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
                    url: "Admin_Published_Notes_Ajax.php",
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