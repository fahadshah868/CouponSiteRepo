$(document).ready(function() {
    var dropdowndetailcontainerelements = $("#site-header-explorebutton-mega-dropdown-detail-container").children();
    
    
    $("#hamburgerbutton-mega-menu-overlay-container").css('height', $(document).height() - 80 + 'px');
    $("#explorebutton-mega-menu-overlay-container").css('height', $(document).height() - 80 + 'px');

    //Default Action
    $("#site-header-explorebutton-mega-dropdown-sidebar-container ul li:first").addClass("active-sidebar-li") //Activate first tab
    $("#site-header-explorebutton-mega-dropdown-sidebar-container ul li a:first").addClass("activelink") //Activate first tab

    //load popular stores on page load
    var popularstore
    $.ajax({
        type:'GET',
        url:'/getpopularstores',
        data: '',
        beforeSend: function(){
            for(var i=0; i< dropdowndetailcontainerelements.length; i++){
                dropdowndetailcontainerelements[i].style.display = "none";
            }
            $("#loader-overlay-container").css('display','flex');
        },
        complete: function(){
            for(var i=0; i< dropdowndetailcontainerelements.length; i++){
                dropdowndetailcontainerelements[i].style.display = "none";
            }
            $("#dropdownmenu-popularstore-body-container").html(popularstore);
            $("#dropdownmenu-popularstore-body-container").css('display','block');
        },
        success:function(data){
            if(data.status == true){
                popularstore = "<div class='dropdownmenu-popularstores-header-container'>"+
                        "<div class='dopdownmenu-detailcontainer-main-heading' id='dopdownmenu-detailcontainer-main-heading'>Popular Stores</div>"+
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
                    popularstore = popularstore + "</div>"
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
            if($("#dropdownmenu-popularstore-body-container").html().length > 0){
                for(var i=0; i< dropdowndetailcontainerelements.length; i++){
                    dropdowndetailcontainerelements[i].style.display = "none";
                }
                $("#dropdownmenu-popularstore-body-container").css("display","block");
            }
            else{
                var popularstore
                $.ajax({
                    type:'GET',
                    url:'/getpopularstores',
                    data: '',
                    beforeSend: function(){
                        for(var i=0; i< dropdowndetailcontainerelements.length; i++){
                            dropdowndetailcontainerelements[i].style.display = "none";
                        }
                        $("#loader-overlay-container").css('display','flex');
                    },
                    complete: function(){
                        for(var i=0; i< dropdowndetailcontainerelements.length; i++){
                            dropdowndetailcontainerelements[i].style.display = "none";
                        }
                        $("#dropdownmenu-popularstore-body-container").html(popularstore);
                        $("#dropdownmenu-popularstore-body-container").css('display','block');
                    },
                    success:function(data){
                        if(data.status == true){
                            popularstore = "<div class='dropdownmenu-popularstores-header-container'>"+
                                    "<div class='dopdownmenu-detailcontainer-main-heading' id='dopdownmenu-detailcontainer-main-heading'>Popular Stores</div>"+
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
                                popularstore = popularstore + "</div>"
                        }
                    }
                });
            }
        }
        // load popular categories into dropdown detail container
        else if($(this).attr('id') == "popularcategories"){
            if($("#dropdownmenu-popularcategories-body-container").html().length > 0){
                for(var i=0; i< dropdowndetailcontainerelements.length; i++){
                    dropdowndetailcontainerelements[i].style.display = "none";
                }
                $("#dropdownmenu-popularcategories-body-container").css('display','block');
            }
            else{
                var popularcategories
                $.ajax({
                    type:'GET',
                    url:'/getpopularcategories',
                    data: '',
                    beforeSend: function(){
                        for(var i=0; i< dropdowndetailcontainerelements.length; i++){
                            dropdowndetailcontainerelements[i].style.display = "none";
                        }
                        $("#loader-overlay-container").css('display','flex');
                    },
                    complete: function(){
                        for(var i=0; i< dropdowndetailcontainerelements.length; i++){
                            dropdowndetailcontainerelements[i].style.display = "none";
                        }
                        $("#dropdownmenu-popularcategories-body-container").html(popularcategories);
                        $("#dropdownmenu-popularcategories-body-container").css('display','block');
                    },
                    success:function(data){
                        if(data.status == true){
                            popularcategories = "<div class='dropdownmenu-popularcategories-header-container'>"+
                                    "<div class='dopdownmenu-detailcontainer-main-heading' id='dopdownmenu-detailcontainer-main-heading'>Popular Categories</div>"+
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
                                popularcategories = popularcategories + "</div>"
                        }
                    }
                });
            }
        }
        // load online codes into dropdown detail container
        else if($(this).attr('id') == "onlinecodes"){
            if($("#dropdownmenu-onlinecodes-body-container").html().length > 0){
                for(var i=0; i< dropdowndetailcontainerelements.length; i++){
                    dropdowndetailcontainerelements[i].style.display = "none";
                }
                $("#dropdownmenu-onlinecodes-body-container").css('display','block');
            }
            else{
                var onlinecodes
                $.ajax({
                    type:'GET',
                    url:'/gettoponlinecodes',
                    data: '',
                    beforeSend: function(){
                        for(var i=0; i< dropdowndetailcontainerelements.length; i++){
                            dropdowndetailcontainerelements[i].style.display = "none";
                        }
                        $("#loader-overlay-container").css('display','flex');
                    },
                    complete: function(){
                        for(var i=0; i< dropdowndetailcontainerelements.length; i++){
                            dropdowndetailcontainerelements[i].style.display = "none";
                        }
                        $("#dropdownmenu-onlinecodes-body-container").html(onlinecodes);
                        $("#dropdownmenu-onlinecodes-body-container").css('display','block');
                    },
                    success:function(data){
                        if(data.status == true){
                            onlinecodes = "<div class='dropdownmenu-onlinecodes-header-container'>"+
                                "<div class='dopdownmenu-detailcontainer-main-heading' id='dopdownmenu-detailcontainer-main-heading'>Online Codes</div>"+
                                "<a id='dropdownmenu-all-onlinecodes-link' href='#'>See All Online Codes</a>"+
                            "</div>"+
                            "<div class='dropdownmenu-onlinecodes-list-container'>"
                                for(var i=1; i<=6; i++){
                                    onlinecodes = onlinecodes +
                                    "<a href= '#'>"+
                                        "<div class='dropdownmenu-onlinecode-material-container'>"+
                                            "<div class='dropdownmenu-onlinecode-store-logo'>"+
                                                "<img src='https://img.grouponcdn.com/coupons/a9w8VPXA1BTbYJHiMA6jSA/hiresJCPENNYpt2-500x500' />"+
                                            "</div>"+
                                            "<div class='dropdownmenu-onlinecode-offer-container'>"+
                                                "<div class='dropdownmenu-onlinecode-offer-title'>upto 20% off regular menu price order</div>"+
                                                "<div class='dropdownmenu-onlinecode-offer-label'>code</div>"+
                                            "</div>"+
                                        "</div>"+
                                    "</a>"
                                }
                            onlinecodes = onlinecodes + "</div>"
                        }
                    }
                });
            }
        }
        // load instore offers into dropdown detail container
        else if($(this).attr('id') == "instoreoffers"){
            if($("#dropdownmenu-instoreoffers-body-container").html().length > 0){
                for(var i=0; i< dropdowndetailcontainerelements.length; i++){
                    dropdowndetailcontainerelements[i].style.display = "none";
                }
                $("#dropdownmenu-instoreoffers-body-container").css('display','block');
            }
            else{
                var topinstoreoffers
                $.ajax({
                    type:'GET',
                    url:'/gettopinstoreoffers',
                    data: '',
                    beforeSend: function(){
                        for(var i=0; i< dropdowndetailcontainerelements.length; i++){
                            dropdowndetailcontainerelements[i].style.display = "none";
                        }
                        $("#loader-overlay-container").css('display','flex');
                    },
                    complete: function(){
                        for(var i=0; i< dropdowndetailcontainerelements.length; i++){
                            dropdowndetailcontainerelements[i].style.display = "none";
                        }
                        $("#dropdownmenu-instoreoffers-body-container").html(topinstoreoffers);
                        $("#dropdownmenu-instoreoffers-body-container").css('display','block');
                    },
                    success:function(data){
                        if(data.status == true){
                            topinstoreoffers = "<div class='dropdownmenu-instoreoffers-header-container'>"+
                                "<div class='dopdownmenu-detailcontainer-main-heading' id='dopdownmenu-detailcontainer-main-heading'>Instore Offers</div>"+
                                "<a id='dropdownmenu-all-instoreoffers-link' href='#'>See All Instore Offers</a>"+
                            "</div>"+
                            "<div class='dropdownmenu-instoreoffers-list-container'>"
                                for(var i=1; i<=8; i++){
                                    topinstoreoffers = topinstoreoffers + 
                                    "<div class='dropdownmenu-instoreoffers-material-container'>"+
                                        "<a href='#'>"+
                                            "<div class='dropdownmenu-instoreoffer-store-logo'>"+
                                                "<img src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpECATf3zT10yaX61taR_QOYF2d2lOvqCS3XKiM-Xdlei9Xj0H' />"+
                                            "</div>"+
                                            "<div class='dropdownmenu-instoreoffer-title'>50 Instore Offers<br>Available</div>"+
                                        "</a>"+
                                    "</div>"
                                }
                            topinstoreoffers = topinstoreoffers + "</div>"
                        }
                    }
                });
            }
        }
        // load special events into dropdown detail container
        else if($(this).attr('id') == "specialevents"){
            if($("#dropdownmenu-specialevents-body-container").html().length > 0){
                for(var i=0; i< dropdowndetailcontainerelements.length; i++){
                    dropdowndetailcontainerelements[i].style.display = "none";
                }
                $("#dropdownmenu-specialevents-body-container").css('display','block');
            }
            else{
                var specialevents
                $.ajax({
                    type:'GET',
                    url:'/getspecialevents',
                    data: '',
                    beforeSend: function(){
                        for(var i=0; i< dropdowndetailcontainerelements.length; i++){
                            dropdowndetailcontainerelements[i].style.display = "none";
                        }
                        $("#loader-overlay-container").css('display','flex');
                    },
                    complete: function(){
                        for(var i=0; i< dropdowndetailcontainerelements.length; i++){
                            dropdowndetailcontainerelements[i].style.display = "none";
                        }
                        $("#dropdownmenu-specialevents-body-container").html(specialevents);
                        $("#dropdownmenu-specialevents-body-container").css('display','block');
                    },
                    success:function(data){
                        if(data.status == true){
                            specialevents = "<div class='dropdownmenu-specialevents-header-container'>"+
                                    "<div class='dopdownmenu-detailcontainer-main-heading' id='dopdownmenu-detailcontainer-main-heading'>Special Events</div>"+
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
                                specialevents = specialevents + "</div>"
                        }
                    }
                });
            }
        }
    });
});