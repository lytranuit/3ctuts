$(document).ready(function (e) {
    $(".dropdown").hover(
            function () {
                $('.dropdown-menu', this).stop(true, true).fadeIn();
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");
            },
            function () {
                $('.dropdown-menu', this).stop(true, true).fadeOut();
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");
            }
    );
    $('.nav-tabs > li > a').hover(function () {
        $(this).tab('show');
    });

//$('#myTable').dataTable();
});
