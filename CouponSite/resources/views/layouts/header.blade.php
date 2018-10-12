
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

        {{-- toggle button to browse list --}}
        <div class="site-header-menu-toggle-container">
            <div class="site-header-menu-toggle-button">
                <div class="menu-toggle" id="menu-toggle">
                    <div class="hamburger">
                      <span></span>
                      <span></span>
                      <span></span>
                    </div>
                    <div class="cross">
                      <span></span>
                      <span></span>
                    </div>
                  </div>
            </div>
            <div id="menu-toggle-list-container" class="menu-toggle-list-container" style="position: absolute; top: 80px; left: 0; right: 0; min-height: 100vh; background-color: rgba(0, 0, 0, 0.4); z-index: 2;">
                <ul class="show menu-toggle-list">
                    <li><a href="#">Browse Stores</a></li>
                    <li><a href="#">Browse Categories</a></li>
                    <li class="parentli"><a href="#">Browse Events<i style="float: right; padding-right: 10px;" class="fa fa-angle-down"></i></a>
                      <ul id="events-list">
                        <li><a href="#">Black Friday Deals<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#">Cyber Monday Deals<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#">Christmas Deals<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#">Valentines Day Deals<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#">New Year Deals<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#">Labour Day Deals<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#">Fathers Day Deals<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#">Mothers Day Deals<i class="fa fa-angle-right"></i></a></li>
                      </ul>
                    </li>
                    <li><a href="#">Browse Instore Coupons</a></li>
                </ul>
              </div>
          </div>

          {{-- explore button to explore list --}}

        <div class="site-header-explorebutton-container">
            <div class="site-header-explorebutton" tabindex="1">
                <span class="button-heading">Explore<i style="padding-left: 10px;" class="fa fa-angle-down"></i></span>
                <div class="site-header-dropdown" id="site-header-dropdown">
                    <div class="show site-header-dropdown-body-container">
                        <div class="site-header-dropdown-sidebar-container" id="site-header-dropdown-sidebar-container">
                            <h2>Explore to Save Big</h2>
                            <ul>
                                <li id="popularstores"><a href="#">Popular Stores<i class="fa fa-angle-right"></i></a></li>
                                <li id="popularcategories"><a href="#">Popular Categories<i class="fa fa-angle-right"></i></a></li>
                                <li id="specialevents"><a href="#">Special Events<i class="fa fa-angle-right"></i></a></li>
                            </ul>
                        </div>
                        <div class="site-header-dropdown-detail-container" id="site-header-dropdown-detail-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
