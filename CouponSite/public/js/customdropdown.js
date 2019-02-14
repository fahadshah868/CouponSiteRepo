$(document).ready(function(){
$('.as-filtered-stores-dropdown').click(function () {
        $(this).attr('tabindex', 1).focus();
        $(this).toggleClass('active');
        $(this).find('.dropdown-menu').slideToggle(300);
    });
    $('.as-filtered-stores-dropdown').focusout(function () {
        $(this).removeClass('active');
        $(this).find('.dropdown-menu').slideUp(300);
    });
    $('.as-filtered-stores-dropdown .dropdown-menu li').click(function () {
        $(this).parents('.as-filtered-stores-dropdown').find('span').text($(this).text());
        $('.as-filtered-stores-dropdown .dropdown-menu li').removeClass('active');
        $(this).addClass('active');
    });
});