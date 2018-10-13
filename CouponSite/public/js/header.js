$(document).ready(function() {
    var dropdowndetailcontainer = $("#site-header-explorebutton-mega-dropdown-detail-container");
    dropdowndetailcontainer.html("<div class='loader-overlay-container'><div class='loader'></div></div>");
    
    $("#hamburgerbutton-mega-menu-overlay-container").css('height', $(document).height() - 80 + 'px');
    $("#explorebutton-mega-menu-overlay-container").css('height', $(document).height() - 80 + 'px');

    //Default Action
    $("#site-header-explorebutton-mega-dropdown-sidebar-container ul li:first").addClass("active-sidebar-li") //Activate first tab
    $("#site-header-explorebutton-mega-dropdown-sidebar-container ul li a:first").addClass("activelink") //Activate first tab

    //load popular stores on page load
    var dropdowndetailcontainer = $("#site-header-explorebutton-mega-dropdown-detail-container");
    $.ajax({
        type:'GET',
        url:'/getpopularstores',
        data: '',
        success:function(data){
            if(data.status == true){
                var popularstore = "<div class='dropdownmenu-popularstore-body-container'>"+
                    "<div class='dropdownmenu-popularstores-header-container'>"+
                        "<div class='dropdownmenu-popularstores-main-heading'>Popular Stores</div>"+
                        "<a id='all-stores-link' href='#'>See All Stores</a>"+
                    "</div>"+
                    "<div class='dropdownmenu-popularstores-list-container'>"
                        for(var i=1; i<=10; i++){
                            popularstore = popularstore + 
                            "<div class='dropdownmenu-store-material-container'>"+
                                "<a href='#'>"+
                                    "<div class='dropdownmenu-store-logo'>"+
                                        "<img src='https://img.grouponcdn.com/coupons/2MB1FyJzVmZc2SQn6UM5y6GPXyik/2M-500x500' />"+
                                    "</div>"+
                                    "<div class='dropdownmenu-store-title'>Tillys</div>"+
                                "</a>"+
                            "</div>"
                        }
                    popularstore = popularstore + "</div>"+
                "</div>"
                dropdowndetailcontainer.html(popularstore);
            }
        }
    });

    $(window).resize(function() {
        $("#hamburgerbutton-mega-menu-overlay-container").css('height', '0');
        $("#hamburgerbutton-mega-menu-overlay-container").css('height', $(document).height() - 80 + 'px');
        $("#explorebutton-mega-menu-overlay-container").css('height', '0');
        $("#explorebutton-mega-menu-overlay-container").css('height', $(document).height() - 80 + 'px');
    });

    $(document).on("click",function(event){
        // click events for toggle button and browse list
        if($(event.target).parents().hasClass('site-header-hamburger-button-container') || $(event.target).parent().hasClass('site-header-explorebutton') || $(event.target).parent().parent().hasClass('site-header-explorebutton') || $(event.target).hasClass('site-header-explorebutton')){
            $('#menu-toggle').toggleClass('active');
            $('#hamburgerbutton-mega-menu-overlay-container').toggle();
            $('#explorebutton-mega-menu-overlay-container').toggle();
            $('#events-list').slideUp();
        }
        else if(!($(event.target).parents().hasClass('show')) && ($('#hamburgerbutton-mega-menu-overlay-container').css('display') == 'block' || $('#explorebutton-mega-menu-overlay-container').css('display') == 'block')){
            $('#menu-toggle').toggleClass('active');
            $('#hamburgerbutton-mega-menu-overlay-container').toggle();
            $('#explorebutton-mega-menu-overlay-container').toggle();
            $('#events-list').slideUp();
        }
        else if($(event.target).parent().hasClass('parentli') || $(event.target).parent().parent().hasClass('parentli')){
            $('#events-list').slideToggle();
        }
    });
      
    //On click dropdown sidebar link
    $("#site-header-explorebutton-mega-dropdown-sidebar-container ul li").click(function() {
        $("#site-header-explorebutton-mega-dropdown-sidebar-container ul li").removeClass("active-sidebar-li"); //Remove any "active" class
        $("#site-header-explorebutton-mega-dropdown-sidebar-container ul li a").removeClass("activelink"); //Remove any "active" class
        $(this).addClass("active-sidebar-li"); //Add "active" class to selected tab
        $(this).find('a').addClass("activelink"); //Add "active" class to selected tab

        // load popular stores into dropdown detail container
        if($(this).attr('id') == "popularstores"){
            dropdowndetailcontainer.html("<div class='loader-overlay-container'><div class='loader'></div></div>");
            $.ajax({
                type:'GET',
                url:'/getpopularstores',
                data: '',
                success:function(data){
                    if(data.status == true){
                        var popularstore = "<div class='dropdownmenu-popularstore-body-container'>"+
                            "<div class='dropdownmenu-popularstores-header-container'>"+
                                "<div class='dropdownmenu-popularstores-main-heading'>Popular Stores</div>"+
                                "<a id='all-stores-link' href='#'>See All Stores</a>"+
                            "</div>"+
                            "<div class='dropdownmenu-popularstores-list-container'>"
                                for(var i=1; i<=10; i++){
                                    popularstore = popularstore + 
                                    "<div class='dropdownmenu-store-material-container'>"+
                                        "<a href='#'>"+
                                            "<div class='dropdownmenu-store-logo'>"+
                                                "<img src='https://img.grouponcdn.com/coupons/2MB1FyJzVmZc2SQn6UM5y6GPXyik/2M-500x500' />"+
                                            "</div>"+
                                            "<div class='dropdownmenu-store-title'>Tillys</div>"+
                                        "</a>"+
                                    "</div>"
                                }
                            popularstore = popularstore + "</div>"+
                        "</div>"
                        dropdowndetailcontainer.html(popularstore);
                    }
                }
            });
        }
        // load popular categories into dropdown detail container
        else if($(this).attr('id') == "popularcategories"){
            dropdowndetailcontainer.html("<div class='loader-overlay-container'><div class='loader'></div></div>");
            $.ajax({
                type:'GET',
                url:'/getpopularcategories',
                data: '',
                success:function(data){
                    if(data.status == true){
                        var popularcategories = "<div class='dropdownmenu-popularcategories-body-container'>"+
                            "<div class='dropdownmenu-popularcategories-header-container'>"+
                                "<div class='dopdownmenu-popularcategories-main-heading'>Popular Categories</div>"+
                                "<a id='dropdownmenu-all-categories-link' href='#'>See All Categories</a>"+
                            "</div>"+
                            "<div class='dropdownmenu-popularcategories-list-container'>"
                                for(var i=1; i<=10; i++){
                                    popularcategories = popularcategories + 
                                    "<div class='dropdownmenu-category-material-container'>"+
                                        "<a href='#'>"+
                                            "<div class='dropdownmenu-category-logo'>"+
                                                "<img src='https://cdn2.iconfinder.com/data/icons/men-s-accessories-flat-colorful/2048/7768_-_Casual_Shirt-512.png' />"+
                                            "</div>"+
                                            "<div class='dropdownmenu-category-title'>Clothing</div>"+
                                        "</a>"+
                                    "</div>"
                                }
                            popularcategories = popularcategories + "</div>"+
                        "</div>"+
                        "</div>"
                        dropdowndetailcontainer.html(popularcategories);
                    }
                }
            });
        }
        // load special events into dropdown detail container
        else if($(this).attr('id') == "specialevents"){
            dropdowndetailcontainer.html("<div class='loader-overlay-container'><div class='loader'></div></div>");
            $.ajax({
                type:'GET',
                url:'/getspecialevents',
                data: '',
                success:function(data){
                    if(data.status == true){
                        var specialevents = "<div class='dropdownmenu-specialevents-body-container'>"+
                            "<div class='dropdownmenu-specialevents-header-container'>"+
                                "<div class='dropdownmenu-specialevents-main-heading'>Special Events</div>"+
                            "</div>"+
                            "<div class='dropdownmenu-specialevents-list-container'>"
                                for(var i=1; i<=8; i++){
                                    specialevents = specialevents + 
                                    "<div class='dropdownmenu-specialevents-material-container'>"+
                                        "<a href='#'>"+
                                            "<div class='dropdownmenu-event-logo'>"+
                                                "<img src='images/specialevents/blackfriday.jpg' />"+
                                            "</div>"+
                                            "<div class='dropdownmenu-event-title'>Black Friday<br>Deals</div>"+
                                        "</a>"+
                                    "</div>"
                                }
                            specialevents = specialevents + 
                            "</div>"+
                        "</div>"
                        dropdowndetailcontainer.html(specialevents);
                    }
                }
            });
        }
    });
});