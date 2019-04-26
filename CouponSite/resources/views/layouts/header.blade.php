
<header class="header-main-container">
    <div class="header-container">
        <div class="header-wrapper">
            <div class="header-logo">
                <a href="/" id="logo">WebSite</a>
            </div>
            <div class="header-searchbar-container">
                <form>
                    <input type="text" id="header-searchbar" autocomplete="off" placeholder="Search on...." style="background-image: url(/images/searchicon.png)" />
                    <div class="header-search-items-container" id="header-search-items-container">
                        <div class="header-search-loading" id="header-search-loading">
                            <img src="{{asset('images/header-loading.gif')}}">
                        </div>
                        <div class="header-search-items" id="header-search-items">
                            {{-- searched items will display here --}}
                        </div>
                        <div class="header-searchbar-default-items" id="header-searchbar-default-items">
                            <div class="header-searchbar-heading">Browse Coupons At WebSite</div>
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
        <nav class="header-nav-container">
            <ul class="header-nav-list">
                <li class="header-nav-item" id="header-nav-item">
                    <span class="header-nav-item-text" id="header-nav-item-text">Top Stores<i class="fa fa-angle-down header-list-arrow"></i></span>
                    <div id="header-nav-overlay-container" class="header-nav-overlay-container">
                        <div class="header-nav-body-container" id="header-nav-body-container">
                            <!-- loading overlay container -->
                            <div class="header-nav-loading-container" id="header-nav-loading-container">
                                <div class="header-nav-top-items-loading"></div>
                                @for($i=1; $i<= 5; $i++)
                                <div class="header-nav-popular-items-loading">
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
                            <div class="header-nav-items-container" id="header-nav-items-container">
                            </div>
                        </div>
                    </div>
                </li>
                <li class="header-nav-item" id="header-nav-item">
                    <span class="header-nav-item-text" id="header-nav-item-text">Top Categories<i class="fa fa-angle-down header-list-arrow"></i></span>
                    <div id="header-nav-overlay-container" class="header-nav-overlay-container">
                        <div class="header-nav-body-container" id="header-nav-body-container">
                            <!-- loading overlay container -->
                            <div class="header-nav-loading-container" id="header-nav-loading-container">
                                <div class="header-nav-top-items-loading"></div>
                                @for($i=1; $i<= 5; $i++)
                                <div class="header-nav-popular-items-loading">
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
                            <div class="header-nav-items-container" id="header-nav-items-container">
                            </div>
                        </div>
                    </div>
                </li>
                <li class="header-nav-item" id="header-nav-item">
                    <a href="/coupons/onlinecodes" class="header-nav-item-text" id="header-nav-item-text">See All Online Codes</a>
                </li>
                <li class="header-nav-item" id="header-nav-item">
                    <a href="/coupons/onlinesales" class="header-nav-item-text" id="header-nav-item-text">See All Online Sales</a>
                </li>
                <li class="header-nav-item" id="header-nav-item">
                    <a href="/coupons/freeshipping" class="header-nav-item-text" id="header-nav-item-text">See All Free Shipping Coupons</a>
                </li>
                <li class="header-nav-item" id="header-nav-item">
                    <a href="/blog" class="header-nav-item-text" id="header-nav-item-text">Blog</a>
                </li>
            </ul>
        </nav>
        <div>
            
        </div>
    </div>
</header>