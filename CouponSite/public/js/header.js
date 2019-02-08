$(document).ready(function() {
    var dropdowndetailcontainerelements = $("#site-header-explorebutton-mega-dropdown-detail-container").children();
    
    $(".hamburgerbutton-mega-menu-overlay-container").css('height', $(document).height() - 122 + 'px');
    $(".site-header-nav-mega-dropdown-overlay-container").css('height', $(document).height() - 122 + 'px');

    $(window).resize(function() {
        $(".hamburgerbutton-mega-menu-overlay-container").css('height', '0');
        $(".hamburgerbutton-mega-menu-overlay-container").css('height', $(document).height() - 122 + 'px');
        $(".site-header-nav-mega-dropdown-overlay-container").css('height', '0');
        $(".site-header-nav-mega-dropdown-overlay-container").css('height', $(document).height() - 122 + 'px');
    });

    $("#searchbar").keyup(function(event){
        event.stopPropagation()
        var inputvalue = $.trim($("#searchbar").val());
        if(!inputvalue == ''){
            $("#site-header-default-items").css('display','none');
            $("#site-header-search-items").css('display','block');
        }
        else{
            $("#site-header-default-items").css('display','block');
            $("#site-header-search-items").css('display','none');
        }
    });
    $('.menu-toggle').on('click',function(){
        $('.menu-toggle').toggleClass('active');
        if($(this).hasClass("active")){
            $("#hamburgerbutton-mega-menu-overlay-container").css("display","block");
        }
        else{
            $("#hamburgerbutton-mega-menu-overlay-container").css("display","none");
        }
	});
    $(".site-header-nav-list-item-text, .site-header-nav-list-item-text.fa-angle-down").click(function(e){
        $(".site-header-nav-list-item #site-header-nav-mega-dropdown-overlay-container").not($(this).parentsUntil(".site-header-nav-list").find("#site-header-nav-mega-dropdown-overlay-container")).css("display","none");
        $(".site-header-nav-list-item .site-header-nav-list-item-text").removeClass("active-nav-list-item");
        $(this).parentsUntil(".site-header-nav-list").find("#site-header-nav-mega-dropdown-overlay-container").toggle();
        if($(this).parentsUntil(".site-header-nav-list").find("#site-header-nav-mega-dropdown-overlay-container").css("display") == "block"){
            $(this).parentsUntil(".site-header-nav-list").find("#site-header-nav-list-item-text").addClass("active-nav-list-item");
            var header_list_item_text = $(this).parentsUntil(".site-header-nav-list").find("#site-header-nav-list-item-text").text();
            if(header_list_item_text == "xyz"){
                $.ajax({
                    type:'GET',
                    url:'/getpopularstores',
                    data: '',
                    beforeSend: function(){
                        $(this).parentsUntil(".site-header-nav-list").find("#site-header-mega-dropdown-loading-overlay").css('display','flex');
                    },
                    complete: function(){

                    },
                    success:function(data){
                        
                    }
                });
            }
        }
        else{
            $(this).parentsUntil(".site-header-nav-list").find("#site-header-nav-list-item-text").removeClass("active-nav-list-item");
        }
    });
    $(document).click(function(e){
        if(!$(e.target).hasClass("site-header-nav-mega-dropdown-body-container") &&                         //click on body container
        !$(e.target).parents(".site-header-nav-mega-dropdown-body-container").length > 0 &&                 //click inside body container
        !$(e.target).hasClass("site-header-nav-list-item-text") &&                                          //click on nav list item text
        !$(e.target).hasClass("header-list-arrow") &&                                                       //click on nav list item arrow
        !$(e.target).hasClass("menu-toggle") &&                                                             //click on hamburger menu
        !$(e.target).parents(".menu-toggle").length > 0 &&                                                  //click on inside hamburger menu
        !$(e.target).parents(".hamburger-mega-menu-list").length > 0){                                      //click on hamburger menu list items
            $(".site-header-nav-list-item .site-header-nav-list-item-text").removeClass("active-nav-list-item");
            $(".site-header-nav-mega-dropdown-overlay-container").css("display","none");
            $("#hamburgerbutton-mega-menu-overlay-container").css("display","none");
            $('.menu-toggle').removeClass('active');
        }
    });
});