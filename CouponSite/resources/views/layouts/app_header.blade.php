
<header class="app-header-main-container">
    <div class="app-header-container">
        <div class="app-header-wrapper">
            <div class="app-header-logo">
                <a href="/" id="logo">WebSite</a>
            </div>
            <div class="app-header-searchbar-container">
                <form>
                    <input type="text" id="app-header-searchbar" autocomplete="off" placeholder="Search on...." style="background-image: url(/images/searchicon.png)" />
                    <div class="app-header-search-items-container" id="app-header-search-items-container">
                        <div class="app-header-search-loading" id="app-header-search-loading">
                            <img src="{{asset('images/app-header-loading.gif')}}">
                        </div>
                        <div class="app-header-search-items" id="app-header-search-items">
                            {{-- searched items will display here --}}
                        </div>
                        <div class="app-header-searchbar-default-items" id="app-header-searchbar-default-items">
                            <div class="app-header-searchbar-heading">Browse Coupons At WebSite</div>
                            <ul>
                                <li><a href="/allstores">Browse Coupons By Store</a></li>
                                <li><a href="/allcategories">Browse Coupons By Category</a></li>
                            </ul>
                        </div>                    
                    </div>
                </form>
            </div>
            <div class="hamburger-menu-container">
                <div class="hamburger-button-container">
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
                <div id="hamburger-overlay-container" class="hamburger-overlay-container">
                    <ul class="hamburger-menu-list">
                        <li><a href="#">Browse Stores<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#">Browse Categories<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#">Browse Online Codes<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#">Browse Online Sales<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#">Browse Free Shipping Coupons<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#">Blog<i class="fa fa-angle-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <nav class="app-header-nav-container">
            <ul class="app-header-nav-list">
                <li class="app-header-nav-item" id="app-header-nav-item">
                    <span class="app-header-nav-item-text" id="app-header-nav-item-text">Top Stores<i class="fa fa-angle-down app-header-list-arrow"></i></span>
                    <div id="app-header-nav-overlay-container" class="app-header-nav-overlay-container">
                        <div class="app-header-nav-body-container" id="app-header-nav-body-container">
                            <!-- loading overlay container -->
                            <div class="app-header-nav-loading-container" id="app-header-nav-loading-container">
                                <div class="app-header-nav-top-items-loading"></div>
                                @for($i=1; $i<= 5; $i++)
                                <div class="app-header-nav-popular-items-loading">
                                    <div class="text-line"></div>
                                    <div class="text-line"></div>
                                    <div class="text-line"></div>
                                    <div class="text-line"></div>
                                    <div class="text-line"></div>
                                    <div class="text-line"></div>
                                </div>
                                @endfor
                            </div>
                            <!-- end loading overlay container -->
                            <div class="app-header-nav-items-container" id="app-header-nav-items-container">
                            </div>
                        </div>
                    </div>
                </li>
                <li class="app-header-nav-item" id="app-header-nav-item">
                    <span class="app-header-nav-item-text" id="app-header-nav-item-text">Top Categories<i class="fa fa-angle-down app-header-list-arrow"></i></span>
                    <div id="app-header-nav-overlay-container" class="app-header-nav-overlay-container">
                        <div class="app-header-nav-body-container" id="app-header-nav-body-container">
                            <!-- loading overlay container -->
                            <div class="app-header-nav-loading-container" id="app-header-nav-loading-container">
                                <div class="app-header-nav-top-items-loading"></div>
                                @for($i=1; $i<= 5; $i++)
                                <div class="app-header-nav-popular-items-loading">
                                    <div class="text-line"></div>
                                    <div class="text-line"></div>
                                    <div class="text-line"></div>
                                    <div class="text-line"></div>
                                    <div class="text-line"></div>
                                    <div class="text-line"></div>
                                </div>
                                @endfor
                            </div>
                            <!-- end loading overlay container -->
                            <div class="app-header-nav-items-container" id="app-header-nav-items-container">
                            </div>
                        </div>
                    </div>
                </li>
                <li class="app-header-nav-item" id="app-header-nav-item">
                    <a href="/coupons/onlinecodes" class="app-header-nav-item-text" id="app-header-nav-item-text">See All Online Codes</a>
                </li>
                <li class="app-header-nav-item" id="app-header-nav-item">
                    <a href="/coupons/onlinesales" class="app-header-nav-item-text" id="app-header-nav-item-text">See All Online Sales</a>
                </li>
                <li class="app-header-nav-item" id="app-header-nav-item">
                    <a href="/coupons/freeshipping" class="app-header-nav-item-text" id="app-header-nav-item-text">See All Free Shipping Coupons</a>
                </li>
                <li class="app-header-nav-item" id="app-header-nav-item">
                    <a href="/blog" class="app-header-nav-item-text" id="app-header-nav-item-text">Blog</a>
                </li>
            </ul>
        </nav>
    </div>
</header>