<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();

    if(isset($_POST['submit'])) {

        $search_result = $_POST['search'];

        $select_query = query("SELECT seller_notes_reported_issues.ID, seller_notes_reported_issues.NoteID, seller_notes_reported_issues.CreatedDate, seller_notes_reported_issues.Remarks, seller_notes.Title, note_categories.Category_Name, users.FirstName,
        users.LastName FROM seller_notes_reported_issues LEFT JOIN seller_notes ON seller_notes.ID = seller_notes_reported_issues.NoteID LEFT JOIN note_categories ON 
        seller_notes.Category = note_categories.ID LEFT JOIN users ON users.ID = seller_notes_reported_issues.ReportedByID WHERE (seller_notes.Title LIKE '%$search_result%' OR 
        note_categories.Category_Name LIKE '%$search_result%' OR users.FirstName LIKE '%$search_result%' OR users.LastName LIKE '%$search_result%' OR 
        seller_notes_reported_issues.Remarks LIKE '%$search_result%') ORDER BY seller_notes_reported_issues.CreatedDate DESC");
        confirm($select_query);

    }else {

        $select_query = query("SELECT seller_notes_reported_issues.ID, seller_notes_reported_issues.NoteID, seller_notes_reported_issues.CreatedDate, seller_notes_reported_issues.Remarks, seller_notes.Title, note_categories.Category_Name, users.FirstName,
        users.LastName FROM seller_notes_reported_issues LEFT JOIN seller_notes ON seller_notes.ID = seller_notes_reported_issues.NoteID LEFT JOIN note_categories ON 
        seller_notes.Category = note_categories.ID LEFT JOIN users ON users.ID = seller_notes_reported_issues.ReportedByID ORDER BY seller_notes_reported_issues.CreatedDate DESC");
        confirm($select_query);

    }

    if(isset($_GET['report_id'])) {

        $reort_id = $_GET['report_id'];
    
        $delete_reported_isseue = query("DELETE FROM seller_notes_reported_issues WHERE ID = '$reort_id' ");
        confirm($delete_reported_isseue);
        redirect("Admin_Spam_Reports.php");
    }

    if(isset($_GET['note_id'])){
        $note_id=$_GET['note_id'];

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
    <!-- Spam Reports -->
    <div id="adminSpamReports">
        <div class="container">
            <div id="part1">
                <div class="row">
                    <div class="col-md-6">
                        <p>Spam Reports</p>
                    </div>
                    <div class="col-md-6">
                        <form action="" method="POST">
                        <span><img class="search-icon-img" src="./images/Admin/Spam_Reports/search-icon.png"></span>
                        <input type="text" name="search" id="search" placeholder="Search">
                        <button type="submit" name="submit" class="btn btn-primary search-btn">SEARCH</button>
                    </div>
                </div>
            </div>
            <div id="part2">
                <div class="row">
                    <div class="col-md-12">
                    <div class="table-responsive">
                            <table class="table" id="spam-report-table">
                            <thead>
                                <tr>
                                    <th>SR NO.</th>
                                    <th>REPORTED BY</th>
                                    <th>NOTE TITLE</th>
                                    <th>CATEGORY</th>
                                    <th>DATE EDITED</th>
                                    <th>REMARK</th>
                                    <th>ACTION</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $i=1;
                                    while($row = mysqli_fetch_assoc($select_query)) {
                                        
                                        $report_id = $row['ID'];
                                        $note_id = $row['NoteID'];
                                        $reported_by = $row['FirstName']. " ". $row['LastName'];
                                        $note_title  = $row['Title'];
                                        $note_category = $row['Category_Name'];
                                        $remark = $row['Remarks'];
                                        $db_date = $row['CreatedDate'];

                                        $db_date_timestamp = strtotime($db_date);
                                        $date_edited = date('d-m-Y, H:i', $db_date_timestamp);

                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $reported_by; ?></td>
                                    <td><a style="color:inherit;text-decoration:none;" href="Admin_Note_Details.php?Note_id=<?php echo $note_id; ?>"><?php echo $note_title; ?></a></td>
                                    <td><?php echo $note_category; ?></td>
                                    <td><?php echo $date_edited; ?></td>
                                    <td><?php echo $remark; ?></td>
                                    <td>
                                        <a href="Admin_Spam_Reports.php?report_id=<?php echo $report_id;?>" onclick="return check_delete()">
                                            <img src="images/Admin/Spam_Reports/delete.png"></td>
                                        </a>  
                                    <td>
                                        <div class="admin-menu-popup">
                                            <a class="admin-menu-check" target="#asr<?php echo $i; ?>">
                                                <img class="dots-img" src="images/Admin/Spam_Reports/dots.png">
                                            </a>
                                            <div id="asr<?php echo $i; ?>" class="admin-menu-show">
                                                <p><a href="Admin_Spam_Reports.php?note_id=<?php echo $note_id; ?>">Download Notes</a></p>
                                                <p><a href="Admin_Note_Details.php?Note_id=<?php echo $note_id; ?>">View More Details</a></p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php        
                                  $i++;   }
                                ?>
                                
                            </tbody>

                        </table>
                    </div>
                    </div>
                </div>
            </div>

        </div>
        <script>
                
            function check_delete() {
                return confirm("Are you sure you want to delete reported issue?");
            }
                
        </script>
        <!-- Spam Reports Ends -->
        <?php include "footer.php"; ?>