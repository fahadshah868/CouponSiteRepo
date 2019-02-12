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
                            header_list_item.find("#site-header-mega-dropdown-loading-container").css("display","block");
                            header_list_item.find("#site-header-nav-mega-dropdown-items-container").css("display","none");
                        },
                        complete: function(){
                            header_list_item.find("#site-header-mega-dropdown-loading-container").css("display","none");
                            header_list_item.find("#site-header-nav-mega-dropdown-items-container").css("display","block");
                        },
                        success:function(data){
                            var html = 
                                "<div class='site-header-nav-mega-dropdown-topitems-container'>";
                                    for(var i=1; i<=10; i++){
                                        html = html + 
                                        "<a href='#' class='site-header-nav-mega-dropdown-topitems-item-container'>"+
                                            "<div class='site-header-nav-mega-dropdown-topitems-item'>"+
                                                "<img src='https://thumbor.forbes.com/thumbor/416x416/filters%3Aformat%28jpg%29/https%3A%2F%2Fi.forbesimg.com%2Fmedia%2Flists%2Fcompanies%2Fkohls_416x416.jpg'>"+
                                                "<span class='site-header-nav-mega-dropdown-topitems-item-text'>Store Name</span>"+
                                            "</div>"+
                                        "</a>"
                                    }
                                html = html +
                                "</div>"+
                                "<div class='site-header-nav-mega-dropdown-popularitems-container'>"+
                                    "<div class='site-header-nav-mega-dropdown-popularitems-heading-container'>"+
                                        "<span>Popular Stores</span>"+
                                        "<a href='#'>See All Stores</a>"+
                                    "</div>"+
                                    "<div class='site-header-nav-mega-dropdown-popularitems'>"+
                                        "<ul>"
                                            for(var i=1; i<= 33; i++){
                                                html = html +
                                                "<li>"+
                                                    "<a href='#'>"+
                                                        "<div style='display: flex; flex-direction: row; justify-content: space-between;'>"+
                                                            "<span>Kohl's</span>"+
                                                            "<span>(20 coupons)</span>"+
                                                        "</div>"+
                                                    "</a>"+
                                                "</li>"
                                            }
                                        html = html +
                                        "</ul>"+
                                    "</div>"+
                                "</div>"
                            header_list_item.find("#site-header-nav-mega-dropdown-items-container").html(html);
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