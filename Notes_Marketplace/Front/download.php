<script>
    function check() {
        var a = confirm('Are you sure you want to download this Paid note. Please confirm.');
        if(a == true) {
            <?php
                $note_pdf = $_GET['note_pdf'] . ".pdf";
                header("content-disposition: attachment; filename=" .urldecode($note_pdf));
                $fb = fopen($note_pdf, "r");
                while(!feof($fb)){
                    echo fread($fb, 8192);
                    flush();
                    }     
                fclose($fb);
            ?>
            $(function () {

                $(".note-details-page-download-btn").click(function () {
                    $("#thank-you-popup1").show();
                });
                $(".close-btn").click(function () {
                    $("#thank-you-popup1").hide();
                });
                                            
            });
                                           
            /* $subject = "<Buyer name> wants to purchase your notes";
            $email = "sroshani025@gmail.com";
            $body = "Hello <Seller name>,"."\r\n"."\r\n"."We would like to inform you that, <Buyer name> wants to purchase your notes. Please see Buyer Requests tab and allow download access to Buyer if you have received the payment from him. " ."\r\n"."\r\n"."Regards,"."\r\n". "Notes Marketplace";
            $sender_email = "Email From: {$email}";
         
            $result = mail($email, $subject, $body, $sender_email);
         
            if(!$result) {
                                                
            }*/
            return true;
            }else {
            console.log("Cancle");
            return false;
            }
            }
</script>  
