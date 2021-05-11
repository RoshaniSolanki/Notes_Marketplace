<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();

if(isset($_GET['Member_id'])) {

    $member_id = $_GET['Member_id'];

    $select_query = query("SELECT DISTINCT seller_notes.ID, seller_notes.Title, seller_notes.IsPaid, seller_notes.SellingPrice, downloads.Seller, 
    downloads.Downloader, downloads.AttachementDownloadedDate, downloads.NoteCategory FROM seller_notes LEFT JOIN downloads ON 
    downloads.NoteID = seller_notes.ID WHERE IsAttachementDownloaded = 1 ORDER BY downloads.AttachementDownloadedDate DESC");
    confirm($select_query);
}
    
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
?>
<?php include "header.php"; ?>
<!-- Downloades Notes-->
<div id="adminDownloadesNotes">
    <div class="container">
        <div id="part1">
            <div class="row">
                <div class="col-md-12">
                    <p>Downloaded Notes</p>
                </div>
            </div>
        </div>
        <div id="part2">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <label class="note" for="note">Note</label>
                    <label class="seller" for="seller">Seller</label>
                    <label class="buyer" for="buyer">Buyer</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-8 col-xs-12">

                    <span><img class="arrow-down-img1" src="./images/Admin/Downloades_Notes/down-arrow.png"></span>
                    <select id="note" name="note" onchange="showdata()">
                        <option value="0" selected>Select note</option>
                        <?php 
                                $show_note = query("SELECT DISTINCT seller_notes.ID, seller_notes.Title FROM seller_notes LEFT JOIN downloads ON 
                                downloads.NoteID = seller_notes.ID WHERE IsAttachementDownloaded = 1");
                                confirm($show_note);

                                
                                while($row = mysqli_fetch_assoc($show_note)) {
                                    $note_title = $row['Title'];
                                    $note_id = $row['ID'];
                                ?>
                        <option value="<?php echo $note_id; ?>"><?php echo $note_title; ?></option>
                        <?php    
                                }
                                ?>
                    </select>


                    <span><img class="arrow-down-img2" src="./images/Admin/Downloades_Notes/down-arrow.png"></span>
                    <select id="seller" name="seller" onchange="showdata()">
                        <option value="0" selected>Select seller</option>
                        <?php 
                                $show_seller = query("SELECT DISTINCT users.ID, users.FirstName, users.LastName FROM seller_notes LEFT JOIN downloads ON 
                                downloads.NoteID = seller_notes.ID LEFT JOIN users ON seller_notes.SellerID = users.ID WHERE IsAttachementDownloaded = 1");
                                confirm($show_note);

                                
                                while($row = mysqli_fetch_assoc($show_seller)) {
                                    $seller_name = $row['FirstName']. " " .$row['LastName'];
                                    $seller_id = $row['ID'];
                                ?>
                        <option value="<?php echo $seller_id; ?>"><?php echo $seller_name; ?></option>
                        <?php    
                                }
                                ?>
                    </select>


                    <span><img class="arrow-down-img3" src="./images/Admin/Downloades_Notes/down-arrow.png"></span>
                    <select id="buyer" name="buyer" onchange="showdata()">
                        <option value="0" selected>Select Buyer</option>
                        <?php 
                                $show_buyer = query("SELECT DISTINCT users.ID, users.FirstName, users.LastName FROM downloads LEFT JOIN users ON downloads.Downloader = users.ID 
                                WHERE IsAttachementDownloaded = 1");
                                confirm($show_buyer);

                                
                                while($row = mysqli_fetch_assoc($show_buyer)) {
                                    $buyer_name = $row['FirstName']. " " .$row['LastName'];
                                    $buyer_id = $row['ID'];
                                ?>
                        <option value="<?php echo $buyer_id; ?>"><?php echo $buyer_name; ?></option>
                        <?php    
                                }
                                ?>
                    </select>

                </div>
                <div class="col-md-6 col-sm-4 col-xs-12">

                    <span><img class="search-icon-img" src="./images/Admin/Downloades_Notes/search-icon.png"></span>
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
                let search_note = $("#note").val();
                let search_buyer = $("#buyer").val();
                let search_seller = $("#seller").val();
                let search_result = $("#search").val();

                $.ajax({
                    url: "Admin_Downloads_Notes_Ajax.php",
                    method: "GET",
                    data: {
                        selected_note: search_note,
                        selected_buyer: search_buyer,
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