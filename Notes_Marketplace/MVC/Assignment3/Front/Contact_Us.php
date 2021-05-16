<?php 
 include "../includes/db.php";
 include "../includes/functions.php"; 
 session_start(); 
 
 if(isset($_SESSION['roleid'])) {

 
 if($_SESSION['roleid']==3) {
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $full_name = $firstname . ' ' . $lastname;
    $email = $_SESSION['email'];
}
}else {
    if(isset($_POST['submit'])) {
        $full_name = $_POST['full-name'];
        $email = $_POST['email-address'];
    } 
}  

 if(isset($_POST['submit'])) {
    
    $subject = $_POST['subject'];
    $comments = $_POST['comments'];

 
    $subject = $full_name." - Query";
    $email_to = "sroshani025@gmail.com";
    $body = "Hello, "."\r\n"."\r\n".$comments."\r\n"."\r\n"."Regards,"."\r\n". $full_name;
    $sender_email = "Email From: {$email}";
         
    $result = mail($email_to, $subject, $body, $sender_email);
         
    if(!$result) {
        //$_SESSION['msg'] ="Email sending failed....";
        echo "<script>alert('Email sending failed....')</script>";
    }else {
        redirect("Contact_Us.php");
    }
 }



?>

<?php 
if(isset($_SESSION['userid'])) {

    include "header.php";
}else {
    include "header2.php";
}
?>
    <!-- Contact Us -->
    <div id="contactUs">
        <div class="contact-us-img">
            <img src="images/Contact_Us/banner-with-overlay.jpg">
            <div class="contact-us-img-text">Contact Us</div>
        </div>
        <form action="Contact_Us.php" method="POST" onsubmit="return Contact_Form()">
            <div class="container">
                <h1>Get in Touch</h1>
                <p>Let us know how to get back to you</p>

                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="fullNameLabel" for="fullName">Full Name *</label>
                                    <input type="text" id="full-name" name="full-name" value="<?php if(isset($_SESSION['firstname']) || isset($_SESSION['lastname']) ){if($_SESSION['roleid']==3) {echo $_SESSION['firstname'].' '.$_SESSION['lastname']; }} ?>"
                                        placeholder="Enter your full name" class="form-control">
                                    <small>Error Message</small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="emailAddressLabel" for="emailAddress">Email Address *</label>
                                    <input type="text" id="email-address" name="email-address" value="<?php if(isset($_SESSION['email'])){if($_SESSION['roleid']==3) {echo $_SESSION['email'];}}?>"
                                        placeholder="Enter your email address" class="form-control" <?php if(isset($_SESSION['email'])){if($_SESSION['roleid']==3){?>disabled<?php }}?>>
                                    <small>Error Message</small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="subjectLabel" for="subject">Subject *</label>
                                    <input type="text" id="subject" name="subject" placeholder="Enter your subject" class="form-control">
                                    <small>Error Message</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="commentsLabel" for="comments/questions">Comments/Questions *</label>
                            <input type="text" id="comments" name="comments" placeholder="Comments..." class="form-control">
                            <small>Error Message</small>
                        </div>
                    </div>
                    
                </div>
                <button type="submit" name="submit" class="btn btn-primary contact-us-submit-btn">SUBMIT</button>
            </div>
        </form>
    </div>
    <!-- Contact Us Ends -->

    
<script>
    
    const full_name = document.getElementById('full-name');
    const email = document.getElementById('email-address');
    const subject = document.getElementById('subject');
    const comments = document.getElementById('comments');
    
    function Contact_Form() {
    var x= checkInputs();
        if(x) {
            return true;
        }else{
            return false;
        }
    }

    function checkInputs(){
        var flag =0;
        const fullNameValue = full_name.value.trim();
        const emailValue = email.value.trim();
        const subjectValue = subject.value.trim();
        const commentsValue = comments.value.trim();

        var a = /[0-9]+$/;
        if (fullNameValue === '') {
            setErrorFor(full_name, 'Full Name cannot be blank');
            flag=0;
        } else if (fullNameValue.match(a)) {
            setErrorFor(full_name, 'Numeric entry should not be allowed');
            flag=0;
        } else {
            setSuccessFor(full_name);
            flag=1;
        }

        if (emailValue === '') {
            setErrorFor(email, 'Email cannot be blank');
            flag=0;
        } else if (!isEmail(emailValue)) {
            setErrorFor(email, 'Not a valid email');
            flag=0;
        } else {
            setSuccessFor(email);
            flag=1;
        }

        if (subjectValue === '') {
            setErrorFor(subject, 'Subject cannot be blank');
            flag=0;
        }else {
            setSuccessFor(subject);
            flag=1;
        }

        if (commentsValue === '') {
            setErrorFor(comments, 'Comments cannot be blank');
            flag=0;
        }else {
            setSuccessFor(comments);
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

    function isEmail(email) {
        return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            .test(email);
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
                        <li><a href="#"><img src="images/Contact_Us/facebook.png"></a></li>
                        <li><a href="#"><img src="images/Contact_Us/twitter.png"></a></li>
                        <li><a href="#"><img src="images/Contact_Us/linkedin.png"></a></li>
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

    <!-- Custom JS -->
    <script src="js/script.js"></script>
</section>
</body>

</html>
