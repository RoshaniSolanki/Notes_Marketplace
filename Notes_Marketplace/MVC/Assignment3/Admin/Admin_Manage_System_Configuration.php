<?php include "header.php"; ?>

    <!-- Manage System Configuration -->
    <div id="adminManageSystemConfiguration">
        <form>
            <div class="container">
                <p>Manage System Configuration</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="supportEmail" for="supportEmail">Support email address *</label>
                            <input type="email" name="support-email" id="support-email" class="form-control"
                                placeholder="Enter Support email address">
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
                                placeholder="Enter your email address">
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
                            <span><img class="upload-img" src="./images/Admin/Manage_System_Configuration/upload.png"></span>
                            <input type="text" name="default-image" id="default-image" class="form-control"
                                placeholder="Upload a Picture">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="defaultProfilePicture" for="defaultProfilePicture">Default profile picture(if seller do not upload)</label>
                            <span><img class="upload-img" src="./images/Admin/Manage_System_Configuration/upload.png"></span>
                            <input type="text" name="default-profile-picture" id="default-profile-picture" class="form-control"
                                placeholder="Upload a Picture">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary submit-btn">SUBMIT</button>
                    </div>
                </div>
                
            </div>
        </form>
    </div>
    <!-- Manage System Configuration Ends -->
   
    <?php include "footer.php"; ?>