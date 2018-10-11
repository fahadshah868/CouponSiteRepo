$(document).ready(function() {
    //Default Action
    $("#site-header-dropdown-sidebar-container ul li:first").addClass("active-sidebar-li") //Activate first tab
    $("#site-header-dropdown-sidebar-container ul li a:first").addClass("activelink") //Activate first tab
    $("#site-header-dropdown-detail-container").load("/popularstores");
      
    //On Click Event
    $("#site-header-dropdown-sidebar-container ul li").click(function() {
        if($(this).attr('id') == "popularstores"){
            $("#site-header-dropdown-detail-container").load("/popularstores");
        }
        else if($(this).attr('id') == "popularcategories"){
            $("#site-header-dropdown-detail-container").load("/popularcategories");
        }
        else if($(this).attr('id') == "specialevents"){
            $("#site-header-dropdown-detail-container").load("/specialevents");
        }
        $("#site-header-dropdown-sidebar-container ul li").removeClass("active-sidebar-li"); //Remove any "active" class
        $("#site-header-dropdown-sidebar-container ul li a").removeClass("activelink"); //Remove any "active" class
        $(this).addClass("active-sidebar-li"); //Add "active" class to selected tab
        $(this).find('a').addClass("activelink"); //Add "active" class to selected tab
    });
    
    $(document).on("click",function(event){
        // click events for toggle button and browse list
        if($(event.target).parents().hasClass('site-header-menu-toggle-button') || $(event.target).parent().hasClass('site-header-explorebutton') || $(event.target).parent().parent().hasClass('site-header-explorebutton') || $(event.target).hasClass('site-header-explorebutton')){
            $('#menu-toggle').toggleClass('active');
            $('#menu-toggle-list-container').toggle();
            $('#events-list').slideUp();
            $("#site-header-dropdown").toggle()
        }
        else if(!($(event.target).parents().hasClass('show')) && ($('#menu-toggle-list-container').css('display') == 'block' || $('#site-header-dropdown').css('display') == 'block')){
            $('#menu-toggle').toggleClass('active');
            $('#menu-toggle-list-container').toggle();
            $('#events-list').slideUp();
            $("#site-header-dropdown").toggle();
        }
        else if($(event.target).parents().hasClass('parentli')){
            $('#events-list').slideToggle();
        }
    });
});