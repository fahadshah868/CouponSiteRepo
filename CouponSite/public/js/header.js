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
                                    $.each(data.topstores, function (index, topstore) {
                                        console.log(topstore.secondary_url);
                                        html = html + 
                                        "<a href='/store/"+topstore.secondary_url+"' class='site-header-nav-mega-dropdown-topitems-item-container'>"+
                                            "<div class='site-header-nav-mega-dropdown-topitems-item'>"+
                                                "<img src='"+data.panel_assets_url+topstore.logo_url+"'>"+
                                                "<span class='site-header-nav-mega-dropdown-topitems-item-text'>"+topstore.title+"</span>"+
                                            "</div>"+
                                        "</a>"
                                    });
                                html = html +
                                "</div>"+
                                "<div class='site-header-nav-mega-dropdown-popularitems-container'>"+
                                    "<div class='site-header-nav-mega-dropdown-popularitems-heading-container'>"+
                                        "<span>Popular Stores</span>"+
                                        "<a href='/allstores'>See All Stores</a>"+
                                    "</div>"+
                                    "<div class='site-header-nav-mega-dropdown-popularitems'>"+
                                        "<ul>"
                                            $.each(data.popularstores, function (index, popularstore) {
                                                html = html +
                                                "<li>"+
                                                    "<a href='/store/"+popularstore.secondary_url+"'>"+
                                                        "<div style='display: flex; flex-direction: row; justify-content: space-between;'>"+
                                                            "<span>"+popularstore.title+"</span>"+
                                                            "<span style='white-space: nowrap;'>("+popularstore.offer.length+" coupons)</span>"+
                                                        "</div>"+
                                                    "</a>"+
                                                "</li>"
                                            });
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
            else if(header_list_item.find("#site-header-nav-list-item-text").text() == "Top Categories"){
                if(header_list_item.find("#site-header-nav-mega-dropdown-items-container").children().length > 0){
                    header_list_item.find("#site-header-mega-dropdown-loading-container").css("display","none");
                    header_list_item.find("#site-header-nav-mega-dropdown-items-container").css("display","block");
                }
                else{
                    $.ajax({
                        type:'GET',
                        url:'/getajaxrequest/2',
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
                                    $.each(data.topcategories, function (index, topcategory) {
                                        html = html + 
                                        "<a href='/coupons/"+topcategory.title+"' class='site-header-nav-mega-dropdown-topitems-item-container'>"+
                                            "<div class='site-header-nav-mega-dropdown-topitems-item'>"+
                                                "<img src='"+data.panel_assets_url+topcategory.logo_url+"'>"+
                                                "<span class='site-header-nav-mega-dropdown-topitems-item-text'>"+topcategory.title+"</span>"+
                                            "</div>"+
                                        "</a>"
                                    });
                                html = html +
                                "</div>"+
                                "<div class='site-header-nav-mega-dropdown-popularitems-container'>"+
                                    "<div class='site-header-nav-mega-dropdown-popularitems-heading-container'>"+
                                        "<span>Popular Categories</span>"+
                                        "<a href='/allcategories'>See All Categories</a>"+
                                    "</div>"+
                                    "<div class='site-header-nav-mega-dropdown-popularitems'>"+
                                        "<ul>"
                                            $.each(data.popularcategories, function (index, popularcategory) {
                                                html = html +
                                                "<li>"+
                                                    "<a href='/coupons/"+popularcategory.title+"'>"+
                                                        "<div style='display: flex; flex-direction: row; justify-content: space-between;'>"+
                                                            "<span>"+popularcategory.title+"</span>"+
                                                            "<span style='white-space: nowrap;'>("+popularcategory.offer.length+" coupons)</span>"+
                                                        "</div>"+
                                                    "</a>"+
                                                "</li>"
                                            });
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
            else if(header_list_item.find("#site-header-nav-list-item-text").text() == "Top Online Codes"){
                if(header_list_item.find("#site-header-nav-mega-dropdown-items-container").children().length > 0){
                    header_list_item.find("#site-header-mega-dropdown-loading-container").css("display","none");
                    header_list_item.find("#site-header-nav-mega-dropdown-items-container").css("display","block");
                }
                else{
                    $.ajax({
                        type:'GET',
                        url:'/getajaxrequest/3',
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
                            "<div class='site-header-nav-mega-dropdown-topoffers-container'>"+
                                "<div class='site-header-nav-mega-dropdown-topoffers-heading-container'>"+
                                    "<span>Top Online codes</span>"+
                                    "<a href='/coupons/onlinecodes'>See All Online Codes</a>"+
                                "</div>"+
                                "<div class='site-header-nav-mega-dropdown-top-offer-container'>"
                                    $.each(data.toponlinecodes, function (index, toponlinecode) {
                                        html = html +
                                        "<div class='site-header-nav-mega-dropdown-topoffer-details-container'>"+
                                            "<img src='"+data.panel_assets_url+toponlinecode.store.logo_url+"' class='site-header-nav-mega-dropdown-topoffer-storelogo'></img>"+
                                            "<div class='site-header-nav-mega-dropdown-topoffer-details'>"+
                                                "<span class='site-header-nav-mega-dropdown-topoffer-title'>"+toponlinecode.title+"</span>"+
                                                "<div class='site-header-nav-mega-dropdown-topoffer-type-container'>"+
                                                    "<span class='site-header-nav-mega-dropdown-topoffer-storetitle'>"+toponlinecode.store.title+"</span>"+
                                                    "<span class='site-header-nav-mega-dropdown-topoffer-type'>"+toponlinecode.type+"</span>"+
                                                "</div>"+
                                            "</div>"+
                                        "</div>"
                                    });
                                html = html +
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
            else if(header_list_item.find("#site-header-nav-list-item-text").text() == "Top Online Sales"){
                if(header_list_item.find("#site-header-nav-mega-dropdown-items-container").children().length > 0){
                    header_list_item.find("#site-header-mega-dropdown-loading-container").css("display","none");
                    header_list_item.find("#site-header-nav-mega-dropdown-items-container").css("display","block");
                }
                else{
                    $.ajax({
                        type:'GET',
                        url:'/getajaxrequest/4',
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
                            "<div class='site-header-nav-mega-dropdown-topoffers-container'>"+
                                "<div class='site-header-nav-mega-dropdown-topoffers-heading-container'>"+
                                    "<span>Top Online Sales</span>"+
                                    "<a href='#'>See All Online Sales</a>"+
                                "</div>"+
                                "<div class='site-header-nav-mega-dropdown-top-offer-container'>"
                                    for(var i=1; i<=8; i++){
                                        html = html +
                                        "<div class='site-header-nav-mega-dropdown-topoffer-details-container'>"+
                                            "<img src='https://thumbor.forbes.com/thumbor/416x416/filters%3Aformat%28jpg%29/https%3A%2F%2Fi.forbesimg.com%2Fmedia%2Flists%2Fcompanies%2Fkohls_416x416.jpg' class='site-header-nav-mega-dropdown-topoffer-storelogo'></img>"+
                                            "<div class='site-header-nav-mega-dropdown-topoffer-details'>"+
                                                "<span class='site-header-nav-mega-dropdown-topoffer-title'>20% off on your online order + free shipping</span>"+
                                                "<div class='site-header-nav-mega-dropdown-topoffer-type-container'>"+
                                                    "<span class='site-header-nav-mega-dropdown-topoffer-storetitle'>Kohl's</span>"+
                                                    "<span class='site-header-nav-mega-dropdown-topoffer-type'>Sale</span>"+
                                                "</div>"+
                                            "</div>"+
                                        "</div>"
                                    }
                                html = html +
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
            else if(header_list_item.find("#site-header-nav-list-item-text").text() == "Top Free Shipping Offers"){
                if(header_list_item.find("#site-header-nav-mega-dropdown-items-container").children().length > 0){
                    header_list_item.find("#site-header-mega-dropdown-loading-container").css("display","none");
                    header_list_item.find("#site-header-nav-mega-dropdown-items-container").css("display","block");
                }
                else{
                    $.ajax({
                        type:'GET',
                        url:'/getajaxrequest/5',
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
                            "<div class='site-header-nav-mega-dropdown-topoffers-container'>"+
                                "<div class='site-header-nav-mega-dropdown-topoffers-heading-container'>"+
                                    "<span>Top Free Shipping Offers</span>"+
                                    "<a href='#'>See All Free Shipping Offers</a>"+
                                "</div>"+
                                "<div class='site-header-nav-mega-dropdown-top-offer-container'>"
                                    for(var i=1; i<=8; i++){
                                        html = html +
                                        "<div class='site-header-nav-mega-dropdown-topoffer-details-container'>"+
                                            "<img src='https://thumbor.forbes.com/thumbor/416x416/filters%3Aformat%28jpg%29/https%3A%2F%2Fi.forbesimg.com%2Fmedia%2Flists%2Fcompanies%2Fkohls_416x416.jpg' class='site-header-nav-mega-dropdown-topoffer-storelogo'></img>"+
                                            "<div class='site-header-nav-mega-dropdown-topoffer-details'>"+
                                                "<span class='site-header-nav-mega-dropdown-topoffer-title'>20% off on your online order + free shipping</span>"+
                                                "<div class='site-header-nav-mega-dropdown-topoffer-type-container'>"+
                                                    "<span class='site-header-nav-mega-dropdown-topoffer-storetitle'>Kohl's</span>"+
                                                    "<span class='site-header-nav-mega-dropdown-topoffer-type'>Code</span>"+
                                                "</div>"+
                                            "</div>"+
                                        "</div>"
                                    }
                                html = html +
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