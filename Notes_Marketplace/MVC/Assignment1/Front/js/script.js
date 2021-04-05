/*=======================================================
                 Show/Hide Password   
=========================================================*/
$(function () {

    $(".show-pass").click(function () {

        var input = $($(this).attr("target"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

});

/*=======================================================
                  User Profile  
=========================================================*/
/*** Calender ***/

$(function () {
    $(".calendar-img").click(function () {
        $("#dob").datepicker();
        $("#dob").datepicker('show');
    });
});

/*=======================================================
                        Navigation 
=========================================================*/
/* Show & Hide White Navigation */
$(function () {

    // show/hide nav on page load
    showHideNav();
    $(window).scroll(function () {
        // show/hide nav on scroll
        showHideNav();
    });

    function showHideNav() {
        if ($(window).scrollTop() > 100) {

            //show white nav
            $("#home nav").addClass("white-nav-top");

            //show purple logo
            $("#home .navbar-brand img").attr("src", "images/home/logo.png");

        } else {

            //hide white nav
            $("#home nav").removeClass("white-nav-top");

            //show white logo
            $("#home .navbar-brand img").attr("src", "images/home/top-logo.png");
        }

    }
});

$(function () {
    $("nav").addClass("white-nav-top");
});  
/*=======================================================
                     Mobile Menu  
=========================================================*/

$(function () {

    // show mobile nav
    $("#mobile-nav-open-btn").click(function () {
        $("#mobile-nav").css("height", "100%");
    });
    // hide mobile nav
    $("#mobile-nav-close-btn, #mobile-nav a").click(function () {
        $("#mobile-nav").css("height", "0%");
    });

});

/*=======================================================
                  Thank you popup  
=========================================================*/
/*
$(function () {

    $(".note-details-page-download-btn").click(function () {
        $("#thank-you-popup1").show();
    });
    $(".close-btn").click(function () {
        $("#thank-you-popup1").hide();
    });

});
*/
/*=======================================================
                  User Manu  
=========================================================*/
{
    var target = "";
    $(function () {

        $(".user-menu-check").click(function () {

            var target1 = $(this).attr("target");
            $(target1).toggle();
            if (target1 != target) {
                $(target).hide();
            }
            target = target1;
        });

    });
}

/*=======================================================
                  My Downloads Dropdown 
=========================================================*/

{
    var target = "";
    $(function () {

        $(".menu-check").click(function () {
            var target1 = $(this).attr("target");
            $(target1).toggle();
            if (target1 != target) {
                $(target).hide();
            }
            target = target1;
        });

    });

    /*=======================================================
                      Add Review popup  
    =========================================================*/

    $(function () {
        $("#close-btn").click(function () {
            $("#add-review-bg").toggle();
        });
        $(".add-review-popup-click").click(function () {
            $("#add-review-bg").toggle();
            $(target).hide();
        });

    });
}
/*=======================================================
                  My Sold Notes Dropdown 
=========================================================*/
{
    var target = "";
    $(function () {

        $(".my-sold-menu-check").click(function () {

            var target1 = $(this).attr("target");
            $(target1).toggle();
            if (target1 != target) {
                $(target).hide();
            }
            target = target1;
        });

    });
}

/*=======================================================
                  My Rejected Notes Dropdown 
=========================================================*/
{
    var target = "";
    $(function () {

        $(".my-rej-menu-check").click(function () {

            var target1 = $(this).attr("target");
            $(target1).toggle();
            if (target1 != target) {
                $(target).hide();
            }
            target = target1;
        });

    });
}

/*=======================================================
                  Buyer Requests Dropdown 
=========================================================*/
{
    var target = "";
    $(function () {

        $(".buyer-req-menu-check").click(function () {

            var target1 = $(this).attr("target");
            $(target1).toggle();
            if (target1 != target) {
                $(target).hide();
            }
            target = target1;
        });

    });
}


/*=======================================================
                  FAQ SlideDown & SlideUp  
=========================================================*/
$(function () {
    $(".card-header , .FAQ-minus-img").click(function () {
        $(".card .card-body").slideUP()
    });
});
