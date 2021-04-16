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
                        Navigation 
=========================================================*/
/* White Navigation */

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
                     User Menu  
=========================================================*/
{
    var target = "";
    $(function () {

        $(".admin-user-menu-check").click(function () {

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
                     Popup Menu  
=========================================================*/
{
    var target = "";
    $(function () {

        $(".admin-menu-check").click(function () {

            var target1 = $(this).attr("target");
            $(target1).toggle();
            if (target1 != target) {
                $(target).hide();
            }
            target = target1;
        });

    });
}