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

/* Change Color of active link */
/*
$(document).ready(function() {
    $('ul.navbar-nav > li').click(function(e) {
      e.preventDefault();
      $('ul.navbar-nav > li').removeClass('active');
      $(this).addClass('active');
    });
});*/

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
                     Add  Notes Page
=========================================================*/

function Publish() {
    if(confirm("Publishing this note will send note to administrator for review, once administrator review and approve then this note will be published to portal. Press yes to continue.")) {
        txt = "You Pressed Ok!";
        //window.location = anchor.attr("href");
    } else {
        txt = "You Pressed Cancel!";
    }
}



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
                   Dashboard
=========================================================*/

//In Progress Notes Table
$(document).ready(function () {
        
    var inProgressNotesTable = $('#in-progress-notes-table').DataTable({
        "order": [[ 4, "desc" ]],
        "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
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
                next: "<img src='./images/My_Download/right-arrow.png' alt=''>",
                previous: "<img src='./images/My_Download/left-arrow.png' alt=''>"
            }
        }
    });
});


//Published Notes Table
$(document).ready(function () {
        
    var publishedNotesTable = $('#published-notes-table').DataTable({
        "order": [[ 4, "desc" ]],
        "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
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
                next: "<img src='./images/My_Download/right-arrow.png' alt=''>",
                previous: "<img src='./images/My_Download/left-arrow.png' alt=''>"
            }
        }
    });
});



/*=======================================================
                  My Downloads 
=========================================================*/

/* Dropdown */

//{
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

        
    
    $(document).ready(function () {
        
        var myDownloadsTable = $('#my-downloads-table').DataTable({
            "order": [[ 4, "desc" ]],
            "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                //debugger;
                var index = iDisplayIndexFull + 1;
                $("td:first", nRow).html(index);
                return nRow;
            },
            'sDom': '"top"i',
            "iDisplayLength": 10,
            "bInfo": false,
            language: {
                "zeroRecords": "No record found",
                paginate: {
                    next: "<img src='./images/My_Download/right-arrow.png' alt=''>",
                    previous: "<img src='./images/My_Download/left-arrow.png' alt=''>"
                }
            }
        });
    });

    /*=======================================================
                      Add Review popup  
    =========================================================*/

  /*  $(function () {
        $("#close-btn").click(function () {
            $("#add-review-bg").toggle();
        });
        $(".add-review-popup-click").click(function () {
            $("#add-review-bg").toggle();
            $(target).hide();
        });

    });
}*/
/*=======================================================
                  My Sold Notes 
=========================================================*/

/* Dropdown */
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

$(document).ready(function () {
                
    var mySoldNotesTable = $('#my-sold-note-table').DataTable({
        "order": [[ 4, "desc" ]],
        "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            //debugger;
            var index = iDisplayIndexFull + 1;
            $("td:first", nRow).html(index);
            return nRow;
        },
        'sDom': '"top"i',
        "iDisplayLength": 10,
        "bInfo": false,
        language: {
            "zeroRecords": "No record found",
            paginate: {
                next: "<img src='./images/My_Sold_Notes/right-arrow.png' alt=''>",
                previous: "<img src='./images/My_Sold_Notes/left-arrow.png' alt=''>"
            }
        }
    });
});

/*=======================================================
                  My Rejected Notes 
=========================================================*/

/* Dropdown */
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

$(document).ready(function () {
        
    var myRejectedNotesTable = $('#my-rejected-notes-table').DataTable({
        "order": [[ 4, "desc" ]],
        "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            //debugger;
            var index = iDisplayIndexFull + 1;
            $("td:first", nRow).html(index);
            return nRow;
        },
        'sDom': '"top"i',
        "iDisplayLength": 10,
        "bInfo": false,
        language: {
            "zeroRecords": "No record found",
            paginate: {
                next: "<img src='./images/My_Download/right-arrow.png' alt=''>",
                previous: "<img src='./images/My_Download/left-arrow.png' alt=''>"
            }
        }
    });
});


/*=======================================================
                  Buyer Requests 
=========================================================*/

/* Dropdown */
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

$(document).ready(function () {
        
    var buyerRequestsTable = $('#buyer-requests-table').DataTable({
        "order": [[ 4, "desc" ]],
        "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            //debugger;
            var index = iDisplayIndexFull + 1;
            $("td:first", nRow).html(index);
            return nRow;
        },
        'sDom': '"top"i',
        "iDisplayLength": 10,
        "bInfo": false,
        language: {
            "zeroRecords": "No record found",
            paginate: {
                next: "<img src='./images/My_Download/right-arrow.png' alt=''>",
                previous: "<img src='./images/My_Download/left-arrow.png' alt=''>"
            }
        }
    });
});


/*=======================================================
                  FAQ SlideDown & SlideUp  
=========================================================*/

var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i<coll.length;i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var accordion_content = this.nextElementSibling;

        if(accordion_content.style.maxHeight) {
            accordion_content.style.maxHeight = accordion_content.scrollHeight + "px";
        }else {
            accordion_content.style.maxHeight = null;
            if(accordion_content.style.display === "block") {
                accordion_content.style.display ="none";
                $(".accordion_item").css("border-color", "#d1d1d1");
            } else {
                accordion_content.style.display = "block";
                $(".accordion_item").css("border-color", "#d1d1d1");
                $(".collapsible").css("border-color", "none");
            }
        }
    });
}

