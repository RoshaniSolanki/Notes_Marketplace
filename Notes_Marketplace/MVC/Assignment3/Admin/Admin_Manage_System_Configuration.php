<?php
include "../includes/db.php";
include "../includes/functions.php";
session_start();

if(isset($_SESSION['userid']) && ($_SESSION['roleid']==1)) {

    if(isset($_POST['submit'])) {

        $support_email           = escape_string($_POST['support-email']);
        $support_phone_number    = escape_string($_POST['support-phone-number']);
        $email                   = escape_string($_POST['email']);
        $facebook_url            = escape_string($_POST['facebook-url']);
        $twitter_url             = escape_string($_POST['twitter-url']);
        $linkedin_url            = escape_string($_POST['linkedin-url']);
        $default_note_picture    = escape_string($_POST['default-note-picture']);
        $default_profile_picture = escape_string($_POST['default-profile-picture']);

    }

}
?>    
<?php include "header.php"; ?>

    <!-- Manage System Configuration -->
    <div id="adminManageSystemConfiguration">
        <form action="" method="POST">
            <div class="container">
                <p>Manage System Configuration</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="supportEmail" for="supportEmail">Support email address *</label>
                            <input type="email" name="support-email" id="support-email" class="form-control"
                                placeholder="Enter Support email address" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="supportPhoneNumber" for="supportPhoneNumber">Support phone number</label>
                            <input type="tel" name="support-phone-number" id="support-phone-number" class="form-control"
                                placeholder="Enter phone number">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="email" for="email">Email Address(es)(for various events system will send notifications to these users) *</label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="Enter your email address" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="facebookURL" for="facebookURL">Facebook URL</label>
                            <input type="email" name="facebook-url" id="facebook-url" class="form-control"
                                placeholder="Enter facebook url">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="twitterURL" for="twitterURL">Twitter URL</label>
                            <input type="email" name="twitter-url" id="twitter-url" class="form-control"
                                placeholder="Enter twitterurl">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="linkedinURL" for="linkedinURL">Linkedin URL</label>
                            <input type="email" name="linkedin-url" id="linkedin-url" class="form-control"
                                placeholder="Enter linkedin url">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="defaultImage" for="defaultImage">Default image for notes(if seller do not upload)</label>
                            <label for="default-image"><img class="upload-img" src="./images/Admin/Manage_System_Configuration/upload.png"></label>
                            <span class="np-text">Upload a file</span>
                            <div style="border:1px solid #d1d1d1;border-radius:3px;height:110px;width:707px;">
                                <input type="file" name="default-note-picture" id="default-image" class="form-control"
                                placeholder="Upload a Picture">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="defaultProfilePicture" for="defaultProfilePicture">Default profile picture(if seller do not upload)</label>
                            <label for="default-profile-picture"><img class="upload-img" src="./images/Admin/Manage_System_Configuration/upload.png"></label>
                            <span class="np-text">Upload a file</span>
                            <div style="border:1px solid #d1d1d1;border-radius:3px;height:110px;width:707px;">
                                <input type="file" name="default-profile-picture" id="default-profile-picture" class="form-control"
                                    placeholder="Upload a Picture">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" name="submit" class="btn btn-primary submit-btn">SUBMIT</button>
                    </div>
                </div>
                
            </div>
        </form>
    </div>
    <!-- Manage System Configuration Ends -->
   
    <?php include "footer.php"; ?>