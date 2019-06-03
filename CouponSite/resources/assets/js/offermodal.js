$(document).ready(function(){
    var second = 0;
    function navigateToUrl(){
        // if(second == 3){
        //     $("#modal-body-loading-container").css("display","none");
        //     window.open("https://www.google.com","_blank");
        //     clearTimeout(second);
        // }
        // else{
        //     second++;
        //     setTimeout(navigateToUrl,1000);
        // }
    }
    $(".js-offer").on('click','.hm-offer-button',function(){
        second = 0;
        var title = $(this).data('offertitle');
        var location = $(this).data('offerlocation');
        var type = $(this).data('offertype');
        var code = $(this).data('offercode');
        var details = $(this).data('offerdetails');
        var expiry = $(this).data("offerexpiry");
        var storetitle = $(this).data('storetitle');
        var siteurl = $(this).data('siteurl');
        var storelogo = $(this).data('storelogo');
        var navurl = $(this).data("navurl");
        //copy text to clipboard
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(code).select();
        document.execCommand("copy");
        $temp.remove();

        if(location.toLowerCase().indexOf("online") >= 0){
            if(type.toLowerCase() == "code"){
                $("#modal-offer-code").text(code);
                $("#modal-code-block-siteurl").text(siteurl);
                $("#modal-code-block-siteurl").attr('href',navurl);
                $("#modal-sale-block").css('display','none');
                $("#modal-code-block").css('display','block');
            }
            else if(type.toLowerCase() == "sale"){
                $("#modal-sale-block-siteurl").attr('href',navurl);
                $("#modal-code-block").css('display','none');
                $("#modal-sale-block").css('display','block');
            }
            $("#modal-store-logo img").attr('src',storelogo);
            $("#modal-offer-title").text(title);
            $("#modal-offer-details").text(details);
            $("#modal-offer-expiry").html("<i class='fa fa-clock-o'></i>"+"Expires "+expiry);
    
            $('body').css('overflow','hidden');
            $("#modal-body-loading-container").css('display','block');
            $("#modal-overlay-container").css("display","block");
            setTimeout(navigateToUrl,1000);
        }
        
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