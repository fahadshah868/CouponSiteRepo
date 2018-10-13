$(document).ready(function() {
    $("#mega-menu-overlay-container").css('height', $(document).height() - 80 + 'px');

    //Default Action
    $("#site-header-explorebutton-mega-dropdown-sidebar-container ul li:first").addClass("active-sidebar-li") //Activate first tab
    $("#site-header-explorebutton-mega-dropdown-sidebar-container ul li a:first").addClass("activelink") //Activate first tab
    $("#site-header-explorebutton-mega-dropdown-detail-container").load("/popularstores");
      
    //On Click Event
    $("#site-header-explorebutton-mega-dropdown-sidebar-container ul li").click(function() {
        if($(this).attr('id') == "popularstores"){
            $("#site-header-explorebutton-mega-dropdown-detail-container").load("/popularstores");
        }
        else if($(this).attr('id') == "popularcategories"){
            $("#site-header-explorebutton-mega-dropdown-detail-container").load("/popularcategories");
        }
        else if($(this).attr('id') == "specialevents"){
            $("#site-header-explorebutton-mega-dropdown-detail-container").load("/specialevents");
        }
        $("#site-header-explorebutton-mega-dropdown-sidebar-container ul li").removeClass("active-sidebar-li"); //Remove any "active" class
        $("#site-header-explorebutton-mega-dropdown-sidebar-container ul li a").removeClass("activelink"); //Remove any "active" class
        $(this).addClass("active-sidebar-li"); //Add "active" class to selected tab
        $(this).find('a').addClass("activelink"); //Add "active" class to selected tab
    });
    
    $(document).on("click",function(event){
        // click events for toggle button and browse list
        if($(event.target).parents().hasClass('site-header-hamburger-button-container') || $(event.target).parent().hasClass('site-header-explorebutton') || $(event.target).parent().parent().hasClass('site-header-explorebutton') || $(event.target).hasClass('site-header-explorebutton')){
            $('#menu-toggle').toggleClass('active');
            $('#mega-menu-overlay-container').toggle();
            $('#events-list').slideUp();
            $("#site-header-explorebutton-mega-dropdown").toggle()
        }
        else if(!($(event.target).parents().hasClass('show')) && ($('#mega-menu-overlay-container').css('display') == 'block' || $('#site-header-explorebutton-mega-dropdown').css('display') == 'block')){
            $('#menu-toggle').toggleClass('active');
            $('#mega-menu-overlay-container').toggle();
            $('#events-list').slideUp();
            $("#site-header-explorebutton-mega-dropdown").toggle();
        }
        else if($(event.target).parent().hasClass('parentli') || $(event.target).parent().parent().hasClass('parentli')){
            $('#events-list').slideToggle();
        }
    });

    $(window).resize(function() {
        $("#mega-menu-overlay-container").css('height', '0');
        $("#mega-menu-overlay-container").css('height', $(document).height() - 80 + 'px');
    });
});