
<header class="site-header-container">
    <div class="site-header">
        <div class="site-header-logo">
            <a href="/" id="logo">WebSite</a>
        </div>
        <div class="site-header-searchbar">
            <form>
                <input type="text" id="searchbar" placeholder="Search on...." style="background-image: url(/images/searchicon.png)" />
            </form>
        </div>

        {{-- toggle button to browse list --}}
        <div class="site-header-hamburger-mega-menu-container">
            <div class="site-header-hamburger-button-container">
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
            <div id="hamburgerbutton-mega-menu-overlay-container" class="hamburgerbutton-mega-menu-overlay-container">
                <ul class="show hamburger-mega-menu-list">
                    <li><a href="#">Browse Stores<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="#">Browse Categories<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="#">Browse Online Codes<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="#">Browse Instore Offers<i class="fa fa-angle-right"></i></a></li>
                    <li class="parentli"><a href="#">Browse Events<i class="fa fa-angle-down"></i></a>
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
                </ul>
              </div>
          </div>

          {{-- explore button to explore list --}}

        <div class="site-header-explorebutton-mega-menu-container">
            <div class="site-header-explorebutton" id="site-header-explorebutton" tabindex="1">
                <span class="button-heading">Explore<i style="padding-left: 10px;" class="fa fa-angle-down"></i></span>
            </div>
            <div id="explorebutton-mega-menu-overlay-container" class="explorebutton-mega-menu-overlay-container">
                <div class="site-header-explorebutton-mega-dropdown" id="site-header-explorebutton-mega-dropdown">
                    <div class="show site-header-explorebutton-mega-dropdown-body-container">
                        <div class="site-header-explorebutton-mega-dropdown-sidebar-container" id="site-header-explorebutton-mega-dropdown-sidebar-container">
                            <h2>Explore to Save Big</h2>
                            <ul>
                                <li id="popularstores"><a href="#">Popular Stores<i class="fa fa-angle-right"></i></a></li>
                                <li id="popularcategories"><a href="#">Popular Categories<i class="fa fa-angle-right"></i></a></li>
                                <li id="onlinecodes"><a href="#">Online Codes<i class="fa fa-angle-right"></i></a></li>
                                <li id="instoreoffers"><a href="#">In Store Offers<i class="fa fa-angle-right"></i></a></li>
                                <li id="specialevents"><a href="#">Special Events<i class="fa fa-angle-right"></i></a></li>
                            </ul>
                        </div>
                        <div class="site-header-explorebutton-mega-dropdown-detail-container" id="site-header-explorebutton-mega-dropdown-detail-container">
                            <div class="loader-overlay-container" id="loader-overlay-container"><div class='loader'></div></div>
                            <div class="dropdownmenu-popularstore-body-container" id="dropdownmenu-popularstore-body-container"></div>
                            <div class="dropdownmenu-popularcategories-body-container" id="dropdownmenu-popularcategories-body-container"></div>
                            <div class="dropdownmenu-onlinecodes-body-container" id="dropdownmenu-onlinecodes-body-container"></div>
                            <div class="dropdownmenu-instoreoffers-body-container" id="dropdownmenu-instoreoffers-body-container"></div>
                            <div class="dropdownmenu-specialevents-body-container" id="dropdownmenu-specialevents-body-container"></div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>