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
        var header_list_item = $(this).parentsUntil(".site-header-nav-list");
        $(".site-header-nav-list-item #site-header-nav-mega-dropdown-overlay-container").not(header_list_item.find("#site-header-nav-mega-dropdown-overlay-container")).css("display","none");
        $(".site-header-nav-list-item .site-header-nav-list-item-text").removeClass("active-nav-list-item");
        header_list_item.find("#site-header-nav-mega-dropdown-overlay-container").toggle();
        if(header_list_item.find("#site-header-nav-mega-dropdown-overlay-container").css("display") == "block"){
            header_list_item.find("#site-header-nav-list-item-text").addClass("active-nav-list-item");
            if(header_list_item.find("#site-header-nav-list-item-text").text() == "Top Stores"){
                if(header_list_item.find("#site-header-nav-mega-dropdown-items-container").children().length > 0){
                    header_list_item.find("#site-header-mega-dropdown-loading-container").css("display","none");
                    header_list_item.find("#site-header-nav-mega-dropdown-items-container").css("display","block");
                }
                else{
                    $.ajax({
                        type:'GET',
                        url:'/getajaxrequest/1',
                        data: '',
                        beforeSend: function(){
                            header_list_item.find("#site-header-mega-dropdown-loading-container").css("display","none");
                            header_list_item.find("#site-header-nav-mega-dropdown-items-container").css("display","block");
                        },
                        complete: function(){
                            header_list_item.find("#site-header-mega-dropdown-loading-container").css("display","none");
                            header_list_item.find("#site-header-nav-mega-dropdown-items-container").css("display","block");
                        },
                        success:function(data){
                            alert(data);
                        },
                        error:function(){
                            alert("Error! something went wrong");
                        }
                    });
                }
            }
        }
        else{
            header_list_item.find("#site-header-nav-list-item-text").removeClass("active-nav-list-item");
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