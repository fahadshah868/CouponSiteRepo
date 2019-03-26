$(document).ready(function(){
$('#as-filtered-stores-letters-dropdown').click(function () {
        $(this).attr('tabindex', 1).focus();
        $(this).toggleClass('active');
        $(this).find('.dropdown-menu').slideToggle(300);
    });
    $('#as-filtered-stores-letters-dropdown').focusout(function () {
        $(this).removeClass('active');
        $(this).find('.dropdown-menu').slideUp(300);
    });
    $('#as-filtered-stores-letters-dropdown').on("click",".dropdown-menu li",function () {
        $(this).parents('#as-filtered-stores-letters-dropdown').find('span').text($(this).text());
        $('#as-filtered-stores-letters-dropdown .dropdown-menu li').removeClass('active');
        $(this).addClass('active');
    });
});