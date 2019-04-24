$(document).ready(function(){
    var second = 0;
    function navigateToUrl(){
        if(second == 3){
            $("#modal-body-loading-container").css("display","none");
            window.open("https://www.google.com","_blank");
            clearTimeout(second);
        }
        else{
            second++;
            setTimeout(navigateToUrl,1000);
        }
    }
    $(".hm-offers-container").on('click','.hm-offer-button',function(){
        second = 0;
        var title = $(this).attr("data-offertitle");
        var code = $(this).attr("data-offercode");
        var expires = $(this).attr("data-offerexpires");
        var storesitelink = $(this).attr("data-storesitelink");
        //copy text to clipboard
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(code).select();
        document.execCommand("copy");
        $temp.remove();
        $("#modal-body-offer-title").text(title);
        $("#modal-body-offer-code").text(code);
        $("#modal-footer-expires").text("Expires "+expires);
        $("#modal-footer-offer-title").text(title);
        $('body').css('overflow','hidden');
        $("#modal-body-loading-container").css('display','block');
        $("#modal-overlay-container").css("display","block");
        setTimeout(navigateToUrl,1000);
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