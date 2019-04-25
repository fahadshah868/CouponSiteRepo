$(document).ready(function(){
$('#letters-dropdown').click(function () {
        $(this).attr('tabindex', 1).focus();
        $(this).toggleClass('active');
        $(this).find('.dropdown-menu').slideToggle(300);
    });
    $('#letters-dropdown').focusout(function () {
        $(this).removeClass('active');
        $(this).find('.dropdown-menu').slideUp(300);
    });
    $('#letters-dropdown').on("click",".dropdown-menu li",function () {
        $(this).parents('#letters-dropdown').find('span').text($(this).text());
        $('#letters-dropdown .dropdown-menu li').removeClass('active');
        $(this).addClass('active');
    });
});