<?php 
session_start();
if(isset($_SESSION['userid']) && $_SESSION['roleid']==3) {

    include "header.php";
}else {
    include "header2.php";
}
?>
    <!-- FAQ -->
    <div id="FAQ">
        <div class="FAQ-img">
            <img src="images/FAQ/banner-with-overlay.jpg">
            <div class="FAQ-img-text">Frequently Asked Questions</div>
        </div>

        <div class="container">
                <p class="FAQ-heading">General Questions</p>
                <div class="row">
                    <div id="part1">
                        <div class="col-md-12">
                            <div class="accordion">

                                <div class="accordion_item">
                                    <button type="button" class="collapsible">What is Note-Marketplaces?</button>
                                    <div class="accordion_content">
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia quae est quis?
                                            Laborum
                                            minus odio, in voluptate modi<br>consectetur obcaecati
                                            ducimus, ex dolore sint! Dignissimos, voluptatibus!
                                        </p>
                                    </div>
                                </div>

                                <div class="accordion_item">
                                    <button type="button" class="collapsible">What do the University say?</button>
                                    <div class="accordion_content">
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia quae est quis?
                                            Laborum
                                            minus odio, in voluptate modi<br>consectetur obcaecati
                                            ducimus, ex dolore sint! Dignissimos, voluptatibus!</p>
                                    </div>
                                </div>

                                <div class="accordion_item">
                                    <button type="button" class="collapsible">Is this legal?</button>
                                    <div class="accordion_content">
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia quae est quis?
                                            Laborum
                                            minus odio, in voluptate modi<br>consectetur obcaecati
                                            ducimus, ex dolore sint! Dignissimos, voluptatibus!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="FAQ-heading">Uploaders</p>
                <div class="row">
                    <div id="part2">
                        <div class="col-md-12">
                            <div class="accordion">
                                <div class="accordion_item">
                                    <button type="button" class="collapsible">Why should I upload now?</button>
                                    <div class="accordion_content">
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia quae est quis?
                                            Laborum
                                            minus odio, in voluptate modi<br>consectetur obcaecati
                                            ducimus, ex dolore sint! Dignissimos, voluptatibus!</p>
                                    </div>
                                </div>

                                <div class="accordion_item">
                                    <button type="button" class="collapsible">What notes can i sell?</button>
                                    <div class="accordion_content">
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia quae est quis?
                                            Laborum
                                            minus odio, in voluptate modi<br>consectetur obcaecati
                                            ducimus, ex dolore sint! Dignissimos, voluptatibus!</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <p class="FAQ-heading">Downloaders</p>
                <div class="row">
                    <div id="part3">
                        <div class="col-md-12">
                            <div class="accordion">
                                <div class="accordion_item">
                                    <button type="button" class="collapsible">How do i buy notes?</button>
                                    <div class="accordion_content">
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia quae est quis?
                                            Laborum
                                            minus odio, in voluptate modi<br>consectetur obcaecati
                                            ducimus, ex dolore sint! Dignissimos, voluptatibus!</p>
                                    </div>
                                </div>

                                <div class="accordion_item">
                                    <button type="button" class="collapsible">Can i edit the notes i purchased?</button>
                                    <div class="accordion_content">
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia quae est quis?
                                            Laborum
                                            minus odio, in voluptate modi<br>consectetur obcaecati
                                            ducimus, ex dolore sint! Dignissimos, voluptatibus!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        


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
                        <li><a href="#"><img src="images/FAQ/facebook.png"></a></li>
                        <li><a href="#"><img src="images/FAQ/twitter.png"></a></li>
                        <li><a href="#"><img src="images/FAQ/linkedin.png"></a></li>
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