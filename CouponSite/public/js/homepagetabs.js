$(document).ready(function(){
    $("#tabs-header-container > div:first").addClass("active-tab");
    $("#tabs-header-container > div").click(function(){
        $("#tabs-header-container > div").removeClass("active-tab");
        $(this).addClass("active-tab");
    });
});