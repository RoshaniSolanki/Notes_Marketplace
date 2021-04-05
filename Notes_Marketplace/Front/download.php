<?php include "../includes/db.php"; ?>
<?php include "../includes/functions.php"; ?>

                <?php
                //echo "above download..........."; 
               $note_pdf = $_GET['note_pdf'] . ".pdf";
                header("content-disposition: attachment; filename=" .urldecode($note_pdf));
                $fb = fopen($note_pdf, "r");
                while(!feof($fb)){
                    echo fread($fb, 8192);
                    flush();
                    }     
                fclose($fb);

                //echo "<script>alert('after download...........');</script>"; 
               $subject = "<Buyer name> wants to purchase your notes";
                $email = "sroshani025@gmail.com";
            $body = "Hello <Seller name>,"."\r\n"."\r\n"."We would like to inform you that, <Buyer name> wants to purchase your notes. Please see Buyer Requests tab and allow download access to Buyer if you have received the payment from him. " ."\r\n"."\r\n"."Regards,"."\r\n". "Notes Marketplace";
            $sender_email = "Email From: {$email}";
         
            $result = mail($email, $subject, $body, $sender_email);
            if(!$result) {
                   echo "<script>alert('sending fails...........');</script>";                             
            }
            

            echo "<script>alert('above popup...........');</script>";
            ?>