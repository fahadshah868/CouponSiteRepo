
<header class="site-header-main-container">
    <div class="site-header-container">
        <div class="site-header-wrapper">
            <div class="site-header-logo">
                <a href="/" id="logo">WebSite</a>
            </div>
            <div class="site-header-searchbar">
                <form>
                    <input type="text" id="searchbar" autocomplete="off" placeholder="Search on...." style="background-image: url(/images/searchicon.png)" />
                    <div class="site-header-search-items-container" id="site-header-search-items-container">
                        <div class="site-header-search-items" id="site-header-search-items">
                            <div class="site-header-default-items-heading">Stores</div>
                            <ul>
                                <li><a href="#">Kohl's</a></li>
                                <li><a href="#">Target</a></li>
                                <li><a href="#">Amazon</a></li>
                            </ul>
                            <hr>
                            <div class="site-header-default-items-heading">Categories</div>
                            <ul>
                                <li><a href="#">Accessories</a></li>
                                <li><a href="#">Baby</a></li>
                                <li><a href="#">Jewelery</a></li>
                                <li><a href="#">Clothing</a></li>
                            </ul>
                        </div>
                        <div class="site-header-default-items" id="site-header-default-items">
                            <div class="site-header-default-items-heading">Browse Coupons At WebSite</div>
                            <ul>
                                <li><a href="#">Browse Coupons By Store</a></li>
                                <li><a href="#">Browse Coupons By Category</a></li>
                            </ul>
                        </div>                    
                    </div>
                </form>
            </div>
    
            
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
                    <ul class="hamburger-mega-menu-list">
                        <li><a href="#">Browse Stores<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#">Browse Categories<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#">Browse Online Codes<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#">Browse Online Sales<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#">Browse Free Shipping Offers<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#">Blog<i class="fa fa-angle-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <nav class="site-header-nav-container">
            <ul class="site-header-nav-list">
                <li class="site-header-nav-list-item" id="site-header-nav-list-item">
                    <span class="site-header-nav-list-item-text" id="site-header-nav-list-item-text">Top Stores<i class="fa fa-angle-down header-list-arrow"></i></span>
                    <div id="site-header-nav-mega-dropdown-overlay-container" class="site-header-nav-mega-dropdown-overlay-container">
                        <div class="site-header-nav-mega-dropdown-body-container" id="site-header-nav-mega-dropdown-body-container">
                            <!-- loading overlay container -->
                            <div class="site-header-mega-dropdown-loading-container" id="site-header-mega-dropdown-loading-container">
                                <div class="site-header-mega-dropdown-top-items-loading"></div>
                                @for($i=1; $i<= 5; $i++)
                                <div class="site-header-mega-dropdown-popular-items-loading">
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
                            <div class="site-header-nav-mega-dropdown-items-container" id="site-header-nav-mega-dropdown-items-container">
                            </div>
                        </div>
                    </div>
                </li>
                <li class="site-header-nav-list-item" id="site-header-nav-list-item">
                    <span class="site-header-nav-list-item-text" id="site-header-nav-list-item-text">Top Categories<i class="fa fa-angle-down header-list-arrow"></i></span>
                    <div id="site-header-nav-mega-dropdown-overlay-container" class="site-header-nav-mega-dropdown-overlay-container">
                        <div class="site-header-nav-mega-dropdown-body-container" id="site-header-nav-mega-dropdown-body-container">
                            <!-- loading overlay container -->
                            <div class="site-header-mega-dropdown-loading-container" id="site-header-mega-dropdown-loading-container">
                                <div class="site-header-mega-dropdown-top-items-loading"></div>
                                @for($i=1; $i<= 5; $i++)
                                <div class="site-header-mega-dropdown-popular-items-loading">
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
                            <div class="site-header-nav-mega-dropdown-items-container" id="site-header-nav-mega-dropdown-items-container">
                            </div>
                        </div>
                    </div>
                </li>
                <li class="site-header-nav-list-item" id="site-header-nav-list-item">
                    <span class="site-header-nav-list-item-text" id="site-header-nav-list-item-text">Top Online Codes<i class="fa fa-angle-down header-list-arrow"></i></span>
                    <div id="site-header-nav-mega-dropdown-overlay-container" class="site-header-nav-mega-dropdown-overlay-container">
                        <div class="site-header-nav-mega-dropdown-body-container" id="site-header-nav-mega-dropdown-body-container">
                            <!-- loading overlay container -->
                            <div class="site-header-mega-dropdown-loading-container" id="site-header-mega-dropdown-loading-container">
                                <div class="site-header-mega-dropdown-top-offers-loading-container">
                                    @for($i=1; $i<= 8; $i++)
                                    <div class="site-header-mega-dropdown-top-offers-loading"></div>
                                    @endfor
                                </div>
                            </div>
                            <!-- end loading overlay container -->
                            <div class="site-header-nav-mega-dropdown-items-container" id="site-header-nav-mega-dropdown-items-container">
                            </div>
                        </div>
                    </div>
                </li>
                <li class="site-header-nav-list-item" id="site-header-nav-list-item">
                    <span class="site-header-nav-list-item-text" id="site-header-nav-list-item-text">Top Online Sales<i class="fa fa-angle-down header-list-arrow"></i></span>
                    <div id="site-header-nav-mega-dropdown-overlay-container" class="site-header-nav-mega-dropdown-overlay-container">
                        <div class="site-header-nav-mega-dropdown-body-container" id="site-header-nav-mega-dropdown-body-container">
                            <!-- loading overlay container -->
                            <div class="site-header-mega-dropdown-loading-container" id="site-header-mega-dropdown-loading-container">
                                <div class="site-header-mega-dropdown-top-offers-loading-container">
                                    @for($i=1; $i<= 8; $i++)
                                    <div class="site-header-mega-dropdown-top-offers-loading"></div>
                                    @endfor
                                </div>
                            </div>
                            <!-- end loading overlay container -->
                            <div class="site-header-nav-mega-dropdown-items-container" id="site-header-nav-mega-dropdown-items-container">
                            </div>
                        </div>
                    </div>
                </li>
                <li class="site-header-nav-list-item" id="site-header-nav-list-item">
                    <span class="site-header-nav-list-item-text" id="site-header-nav-list-item-text">Top Free Shipping Offers<i class="fa fa-angle-down header-list-arrow"></i></span>
                    <div id="site-header-nav-mega-dropdown-overlay-container" class="site-header-nav-mega-dropdown-overlay-container">
                        <div class="site-header-nav-mega-dropdown-body-container" id="site-header-nav-mega-dropdown-body-container">
                             <!-- loading overlay container -->
                             <div class="site-header-mega-dropdown-loading-container" id="site-header-mega-dropdown-loading-container">
                                <div class="site-header-mega-dropdown-top-offers-loading-container">
                                    @for($i=1; $i<= 8; $i++)
                                    <div class="site-header-mega-dropdown-top-offers-loading"></div>
                                    @endfor
                                </div>
                            </div>
                            <!-- end loading overlay container -->
                            <div class="site-header-nav-mega-dropdown-items-container" id="site-header-nav-mega-dropdown-items-container">
                            </div>
                        </div>
                    </div>
                </li>
                <li class="site-header-nav-list-item" id="site-header-nav-list-item"><a href="#" class="site-header-nav-list-item-text" id="site-header-nav-list-item-text">Blog</a></li>
            </ul>
        </nav>
        <div>
            
        </div>
    </div>
</header>