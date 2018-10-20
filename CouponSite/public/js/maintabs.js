$(document).ready(function(){
    $("#tabs-header-container div:first").addClass("active-tab");
    $("#popularstores-tab-detail-container").css('display','block');
    $("#tabs-header-container div").click(function(){
        $("#tabs-header-container > div").removeClass("active-tab");
        $(this).addClass("active-tab");
        if($(this).attr('id') == "popularstores-tab"){
            $("#popularcategories-tab-detail-container").css('display','none');
            $("#popularstores-tab-detail-container").css('display','block');
        }
        else{
            $("#popularstores-tab-detail-container").css('display','none');
            $("#popularcategories-tab-detail-container").css('display','block');
        }
    });
});