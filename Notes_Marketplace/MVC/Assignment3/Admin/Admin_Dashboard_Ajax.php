<?php
include "../includes/db.php";
include "../includes/functions.php";


    if(isset($_GET['selected_search'])){
        $selected_search=$_GET['selected_search'];
    }
    else {
        $selected_search="";
    }
    if(isset($_GET['selected_month'])&&!empty($_GET['selected_month'])){
        $selected_month=$_GET['selected_month'];
        $selected_month = explode("-", $selected_month);
    }
    else{
        $selected_month="";
    }
    
    $select_query = "";
    
    $select_query = "SELECT seller_notes.*, note_categories.Category_Name, seller_notes_attachements.FilePath, users.FirstName, users.LastName FROM seller_notes LEFT JOIN downloads 
    ON seller_notes.ID = downloads.NoteID LEFT JOIN note_categories ON seller_notes.Category = note_categories.ID LEFT JOIN users ON seller_notes.ActionedBy = users.ID LEFT JOIN 
    seller_notes_attachements ON seller_notes.ID = seller_notes_attachements.NoteID WHERE(seller_notes.Title LIKE '%$selected_search%' OR note_categories.Category_Name LIKE 
    '%$selected_search%' OR seller_notes.SellingPrice LIKE '%$selected_search%' OR users.FirstName LIKE '%$selected_search%' OR users.LastName LIKE '%$selected_search%') AND 
    seller_notes.Status = 9 ";
    $select_query .= (!empty($selected_month)&&$selected_month!="")? "AND MONTH(seller_notes.PublishedDate) =$selected_month[1] AND YEAR(seller_notes.PublishedDate) =$selected_month[0] ":"";
    $select_query .= " ORDER BY PublishedDate DESC";
    $select_query = query($select_query);
    confirm($select_query);

?>
<div id="part2">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table" id="dashboard-table">
                    <thead>
                        <tr>
                            <th>SR NO.</th>
                            <th>TITLE</th>
                            <th>CATEGORY</th>
                            <th>ATTACHMENT SIZE</th>
                            <th>SELL TYPE</th>
                            <th>PRICE</th>
                            <th>PUBLISHER</th>
                            <th>PUBLISHED DATE</th>
                            <th>NUMBER OF DOWNLOADES</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                    function getSize($path) {
                                        $bytes = filesize($path);
                                        $s = array('b', 'Kb', 'Mb', 'Gb');
                                        if($bytes!=0){
                                        $e = floor(log($bytes)/log(1024));
                                        return sprintf( '%.2f ' . $s[$e], ( $bytes/pow( 1024, floor($e) ) ) );
                                        }
                                    }
                                    $i=1;
                                        while($row = mysqli_fetch_assoc($select_query)) {

                                            $note_id = $row['ID'];
                                            $note_title = $row['Title'];
                                            $note_cat = $row['Category_Name'];
                                            $ispaid = $row['IsPaid'];
                                            $price = $row['SellingPrice'];
                                            //$seller_id = $row['SellerID'];
                                            $db_pub_date = $row['PublishedDate'];
                                            $publisher = $row['FirstName']. " ". $row['LastName'];
                                            $file_path = $row['FilePath'];

                                            $db_date_timestamp = strtotime($db_pub_date);
                                            $pub_date = date('d-m-Y, H:i', $db_date_timestamp);


                                            if($ispaid == 0) {
                                                $sell_type = 'Free';
                                            }else {
                                                $sell_type = 'Paid';
                                            }

                                            //downloaded notes count
                                            $downloaded = query("SELECT DISTINCT seller_notes.ID FROM seller_notes LEFT JOIN downloads ON seller_notes.ID = downloads.NoteID WHERE 
                                            downloads.IsAttachementDownloaded = 1 AND NoteID = $note_id");
                                            confirm($downloaded);

                                            $download_count = mysqli_num_rows($downloaded);

                                            //attachement size
                                            if(!empty($file_path)){      
                                                $size=getSize($file_path);}
                                            else{
                                                $size="NA";
                                            }

                                            if(empty($price)){
                                                $price="0";
                                            } 

                                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><a
                                    href="Admin_Note_Details.php?Note_id=<?php echo $note_id; ?>"><?php echo $note_title; ?></a>
                            </td>
                            <td><?php echo $note_cat; ?></td>
                            <td><?php echo $size; ?></td>
                            <td><?php echo $sell_type; ?></td>
                            <td>&#36;<?php echo $price; ?></td>
                            <td><?php echo $publisher; ?></td>
                            <td><?php echo $pub_date; ?></td>
                            <td><a
                                    href="Admin_Downloads_Notes.php?download_note_id=<?php echo $note_id;?>"><?php echo $download_count; ?></a>
                            </td>
                            <td>
                                <div class="admin-menu-popup">
                                    <a class="admin-menu-check" target="#ad<?php echo $i; ?>">
                                        <img class="dots-img" src="./images/Admin/Dashboard/dots.png">
                                    </a>
                                    <div id="ad<?php echo $i; ?>" class="admin-menu-show">
                                        <p><a href="Admin_Dashboard.php?Note_id=<?php echo $note_id; ?>">Download
                                                Note</a></p>
                                        <p><a href="Admin_Note_Details.php?Note_id=<?php echo $note_id; ?>">View More
                                                Details</a></p>
                                        <p><a href="#" data-title="<?php echo $note_title; ?>"
                                                data-id="<?php echo $note_id; ?>"
                                                data-sellerid="<?php echo $seller_id; ?>" id="unpublish"
                                                data-toggle="modal" data-target="#unpublishPopup">Unpublish</a></p>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- unpublish popup -->
                        <div class="modal" id="unpublishPopup" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 style="color:#6255a5;font-weight:600;font-size:16px;" class="modal-title"
                                            id="exampleModalLabel">
                                            <?php echo $note_title;?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="" method="POST">
                                        <div class="modal-body">
                                            <input name="noteid_for_unpublish" id="noteid_for_unpublish" value=""
                                                hidden>
                                            <input name="notetitle_for_unpublish" id="notetitle_for_unpublish" value=""
                                                hidden>
                                            <input name="sellerid_for_unpublish" id="sellerid_for_unpublish" value=""
                                                hidden>
                                            <div class="form-group">
                                                <label for="remark">Remarks*</label>
                                                <textarea id="remark" class="form-control" name="remark"
                                                    placeholder="Write remarks" rows="7" required></textarea>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" name="unpublish-btn"
                                                style="background:#ff3636" ;
                                                onclick='javascript:Unpublish($(this));return false;'>Unpublish</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancle</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php    
                                    $i++; }
                                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    $(function () {


        $(document).on("click", "#unpublish", function () {
            $('#noteid_for_unpulish').val($(this).data('id'));
            $('#notetitle_for_unpulish').val($(this).data('title'));
            $('#sellerid_for_unpulish').val($(this).data('sellerid'));
            $('#unpublishPopup').modal('show');
        });


    });


    //Dashboard Table
    $(document).ready(function () {

        var inProgressNotesTable = $('#dashboard-table').DataTable({
            "order": [
                [4, "desc"]
            ],
            "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                //debugger;
                var index = iDisplayIndexFull + 1;
                $("td:first", nRow).html(index);
                return nRow;
            },
            'sDom': '"top"i',
            "iDisplayLength": 5,
            "bInfo": false,
            language: {
                "zeroRecords": "No record found",
                paginate: {
                    next: "<img src='./images/Admin/Members/right-arrow.png' alt=''>",
                    previous: "<img src='./images/Admin/Members/left-arrow.png' alt=''>"
                }
            }
        });
    });
</script>

<!-- Custom JS -->
<script src="js/script.js"></script>