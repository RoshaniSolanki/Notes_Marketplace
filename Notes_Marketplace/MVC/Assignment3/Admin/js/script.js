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
                     Notes PopUp Menu  
=========================================================*/
{
    var target = "";
    $(function () {

        $(".admin-notes-popup-check").click(function () {

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
                     Setting PopUp Menu  
=========================================================*/
{
    var target = "";
    $(function () {

        $(".admin-setting-popup-check").click(function () {

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
                     Report PopUp Menu  
=========================================================*/
{
    var target = "";
    $(function () {

        $(".admin-report-popup-check").click(function () {

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


/*=======================================================
                      Members Page
=========================================================*/

//Members Notes Table
$(document).ready(function () {
        
    var inProgressNotesTable = $('#members-notes-table').DataTable({
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
                next: "<img src='./images/Admin/Members/right-arrow.png' alt=''>",
                previous: "<img src='./images/Admin/Members/left-arrow.png' alt=''>"
            }
        }
    });
});

/*=======================================================
                      Member Details Page
=========================================================*/


//Member Details Table
$(document).ready(function () {
        
    var inProgressNotesTable = $('#member-details-table').DataTable({
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
                next: "<img src='./images/Admin/Members/right-arrow.png' alt=''>",
                previous: "<img src='./images/Admin/Members/left-arrow.png' alt=''>"
            }
        }
    });
});

/*=======================================================
                      Spam Report Page
=========================================================*/

//Spam Report Table
$(document).ready(function () {
        
    var inProgressNotesTable = $('#spam-report-table').DataTable({
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
                next: "<img src='./images/Admin/Members/right-arrow.png' alt=''>",
                previous: "<img src='./images/Admin/Members/left-arrow.png' alt=''>"
            }
        }
    });
});


/*=======================================================
                      Notes Under Review Page
=========================================================*/


function Reject() {
    if (confirm("Are you sure you want to reject seller request?")) {
        //txt = "You Pressed Ok!";
        window.location = anchor.attr("href");
    } else {
        txt = "You Pressed Cancel!";
    }
}


$(function () {


    $(document).on("click", "#reject-button", function () {
        $('#noteid_for_reject').val($(this).data('id'));
        $('#rejectPopup').modal('show');
    });


});


/*=======================================================
            Manage Administrator
=========================================================*/


//Manage Administrator Table
$(document).ready(function () {
        
    var inProgressNotesTable = $('#manage-administrator-table').DataTable({
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
                next: "<img src='./images/Admin/Members/right-arrow.png' alt=''>",
                previous: "<img src='./images/Admin/Members/left-arrow.png' alt=''>"
            }
        }
    });
});

/*=======================================================
                   Manage Category
=========================================================*/


//Manage Administrator Table
$(document).ready(function () {
        
    var inProgressNotesTable = $('#manage-category-table').DataTable({
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
                next: "<img src='./images/Admin/Members/right-arrow.png' alt=''>",
                previous: "<img src='./images/Admin/Members/left-arrow.png' alt=''>"
            }
        }
    });
});

/*=======================================================
                   Manage Country
=========================================================*/


//Manage Administrator Table
$(document).ready(function () {
        
    var inProgressNotesTable = $('#manage-country-table').DataTable({
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
                next: "<img src='./images/Admin/Members/right-arrow.png' alt=''>",
                previous: "<img src='./images/Admin/Members/left-arrow.png' alt=''>"
            }
        }
    });
});

/*=======================================================
                   Manage Type
=========================================================*/


//Manage Administrator Table
$(document).ready(function () {
        
    var inProgressNotesTable = $('#manage-type-table').DataTable({
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
                next: "<img src='./images/Admin/Members/right-arrow.png' alt=''>",
                previous: "<img src='./images/Admin/Members/left-arrow.png' alt=''>"
            }
        }
    });
});
