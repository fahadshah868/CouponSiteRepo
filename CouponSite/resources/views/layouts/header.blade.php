
<script type="text/javascript">    
$(document).ready(function() {
    //Default Action
    $(".dropdown-sidebar-container ul li:first").addClass("active") //Activate first tab
    $(".dropdown-sidebar-container ul li a:first").addClass("activelink") //Activate first tab
    $(".dropdown-detail-container").load("/popularstores");

    //On Click Event
    $(".dropdown-sidebar-container ul li").click(function() {
        if($(this).attr('id') == "popularstores"){
            $(".dropdown-detail-container").load("/popularstores");
        }
        else if($(this).attr('id') == "popularcategories"){
            $(".dropdown-detail-container").load("/popularcategories");
        }
        else if($(this).attr('id') == "specialevents"){
            $(".dropdown-detail-container").load("/specialevents");
        }
        $(".dropdown-sidebar-container ul li").removeClass("active"); //Remove any "active" class
        $(".dropdown-sidebar-container ul li a").removeClass("activelink"); //Remove any "active" class
        $(this).addClass("active"); //Add "active" class to selected tab
        $(this).find('a').addClass("activelink"); //Add "active" class to selected tab
    });
    
    $(document).on("click",function(event){
        if($(event.target).hasClass("site-header-explorebutton") || $(event.target).hasClass("fa-angle-down") || $(event.target).hasClass("button-heading") ){
            $(".dropdown").addClass("show");
            $(".dropdown").find('*').addClass("show");
            $(".dropdown").removeClass("hide");
            $(".dropdown > div").find('*').removeClass("hide");
            $(".dropdown").fadeToggle("slow");
        }
        else if(!$(event.target).hasClass("show")){
            if($(".dropdown").hasClass("show") && $(".dropdown").css("display") == "block"){
                $(".dropdown").removeClass("show");
                $(".dropdown").find('*').removeClass("show");
                $(".dropdown").addClass("hide");
                $(".dropdown").find('*').addClass("hide");
                $(".dropdown").fadeToggle("slow");
                $(".site-header-explorebutton div:first").removeClass("arrow");
            }
        }
    });
});
</script>

<header class="site-header-container">
    <div class="site-header">
        <div class="site-header-logo">
            <a href="/BusinessWebProject/BusinessWeb/Pages/mainpage.html" id="logo">WebSite</a>
        </div>
        <div class="site-header-searchbar">
            <form>
                <input type="text" id="searchbar" placeholder="Search on...." style="background-image: url(images/searchicon.png)" />
            </form>
        </div>
        <div class="site-header-explorebutton-container">
            <div class="site-header-explorebutton" tabindex="1">
                <span class="button-heading">Explore<i style="padding-left: 10px;" class="fa fa-angle-down"></i></span>
                <div class="dropdown">
                    <div class="dropdown-body-container">
                        <div class="dropdown-sidebar-container">
                            <h2>Explore to Save Big</h2>
                            <ul>
                                <li id="popularstores"><a href="#">Popular Stores<i class="fa fa-angle-right"></i></a></li>
                                <li id="popularcategories"><a href="#">Popular Categories<i class="fa fa-angle-right"></i></a></li>
                                <li id="specialevents"><a href="#">Special Events<i class="fa fa-angle-right"></i></a></li>
                            </ul>
                        </div>
                        <div class="dropdown-detail-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>