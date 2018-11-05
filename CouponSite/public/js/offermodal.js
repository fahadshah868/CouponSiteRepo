$(document).ready(function(){
    $(".modal-offer-link").click(function(){
        var title = $(this).attr("data-offertitle");
        var code = $(this).attr("data-offercode");
        var expires = $(this).attr("data-offerexpires");
        var storesitelink = $(this).attr("data-storesitelink");
        $("#modal-body-offer-title").text(title);
        $("#modal-body-offer-code").text(code);
        $("#modal-footer-expires").append(expires);
        $("#modal-footer-offer-title").text(title);
        $('body').css('overflow','hidden');
        $("#modal-body-loading-container").css('display','block');
        $("#modal-overlay-container").css("display","block");
        setTimeout(function(){
            window.open(storesitelink,"_blank");
            $("#modal-body-loading-container").css('display','none');
        }, 4000);
    });
    $("#modal-close-button").click(function(){
        $('body').css('overflow','auto');
        $("#modal-overlay-container").css("display","none");
    });
    $(document).click(function(event){
        if($(event.target).hasClass('modal-overlay-container')){
        $('body').css('overflow','auto');
            $("#modal-overlay-container").css("display","none");
        }
    });
});