
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
                                
                                
                                
                                <!-- <div class="site-header-nav-mega-dropdown-topitems-container">
                                    @for($i=1; $i<=10; $i++)
                                    <a href="#" class="site-header-nav-mega-dropdown-topitems-item-container">
                                        <div class="site-header-nav-mega-dropdown-topitems-item">
                                            <img src="https://thumbor.forbes.com/thumbor/416x416/filters%3Aformat%28jpg%29/https%3A%2F%2Fi.forbesimg.com%2Fmedia%2Flists%2Fcompanies%2Fkohls_416x416.jpg">
                                            <span class="site-header-nav-mega-dropdown-topitems-item-text">Store Name</span>
                                        </div>
                                    </a>
                                    @endfor
                                </div>
                                <div class="site-header-nav-mega-dropdown-popularitems-container">
                                    <div class="site-header-nav-mega-dropdown-popularitems-heading-container">
                                        <span>Popular Stores</span>
                                        <a href="#">See All Stores</a>
                                    </div>
                                    <div class="site-header-nav-mega-dropdown-popularitems">
                                        <ul>
                                            @for($i=1; $i<= 33; $i++)
                                            <li>
                                                <a href="#">
                                                    <div style="display: flex; flex-direction: row; justify-content: space-between;">
                                                        <span>Kohl's</span>
                                                        <span>(20 coupons)</span>
                                                    </div>
                                                </a>
                                            </li>
                                            @endfor
                                        </ul>
                                    </div>
                                </div> -->




                            </div>
                        </div>
                    </div>
                </li>
                <li class="site-header-nav-list-item" id="site-header-nav-list-item">
                    <span class="site-header-nav-list-item-text" id="site-header-nav-list-item-text">Top Categories<i class="fa fa-angle-down header-list-arrow"></i></span>
                    <div id="site-header-nav-mega-dropdown-overlay-container" class="site-header-nav-mega-dropdown-overlay-container">
                        <div class="site-header-nav-mega-dropdown-body-container" id="site-header-nav-mega-dropdown-body-container">
                            <!-- loading overlay container -->
                            <div class="site-header-mega-dropdown-loading-overlay" id="site-header-mega-dropdown-loading-overlay"></div>
                            <!-- end loading overlay container -->
                            <div class="site-header-nav-mega-dropdown-topitems-container">
                                @for($i=1; $i<=10; $i++)
                                <a href="#" class="site-header-nav-mega-dropdown-topitems-item-container">
                                    <div class="site-header-nav-mega-dropdown-topitems-item">
                                        <img src="https://d2gg9evh47fn9z.cloudfront.net/800px_COLOURBOX26549973.jpg">
                                        <span class="site-header-nav-mega-dropdown-topitems-item-text">Baby</span>
                                    </div>
                                </a>
                                @endfor
                            </div>
                            <div class="site-header-nav-mega-dropdown-popularitems-container">
                                <div class="site-header-nav-mega-dropdown-popularitems-heading-container">
                                    <span>Popular Categories</span>
                                    <a href="#">See All Categories</a>
                                </div>
                                <div class="site-header-nav-mega-dropdown-popularitems">
                                    <ul>
                                        @for($i=1; $i<= 33; $i++)
                                        <li>
                                            <a href="#">
                                                <div style="display: flex; flex-direction: row; justify-content: space-between;">
                                                    <span>Jewelery</span>
                                                    <span>(1300 coupons)</span>
                                                </div>
                                            </a>
                                        </li>
                                        @endfor
                                    </ul>
                                </div>
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
                            <!-- <div class="site-header-nav-mega-dropdown-topoffers-container">
                                <div class="site-header-nav-mega-dropdown-topoffers-heading-container">
                                    <span>Top Online codes</span>
                                    <a href="#">See All Online Codes</a>
                                </div>
                                <div class="site-header-nav-mega-dropdown-top-offer-container">
                                    @for($i=1; $i<=8; $i++)
                                    <div class="site-header-nav-mega-dropdown-topoffer-details-container">
                                        <img src="https://thumbor.forbes.com/thumbor/416x416/filters%3Aformat%28jpg%29/https%3A%2F%2Fi.forbesimg.com%2Fmedia%2Flists%2Fcompanies%2Fkohls_416x416.jpg" class="site-header-nav-mega-dropdown-topoffer-storelogo"></img>
                                        <div class="site-header-nav-mega-dropdown-topoffer-details">
                                            <span class="site-header-nav-mega-dropdown-topoffer-title">20% off on your online order + free shipping</span>
                                            <div class="site-header-nav-mega-dropdown-topoffer-type-container">
                                                <span class="site-header-nav-mega-dropdown-topoffer-storetitle">Kohl's</span>
                                                <span class="site-header-nav-mega-dropdown-topoffer-type">Code</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endfor
                                </div>
                            </div> -->
                        </div>
                    </div>
                </li>
                <li class="site-header-nav-list-item" id="site-header-nav-list-item">
                    <span class="site-header-nav-list-item-text" id="site-header-nav-list-item-text">Top Online Sales<i class="fa fa-angle-down header-list-arrow"></i></span>
                    <div id="site-header-nav-mega-dropdown-overlay-container" class="site-header-nav-mega-dropdown-overlay-container">
                        <div class="site-header-nav-mega-dropdown-body-container" id="site-header-nav-mega-dropdown-body-container">
                            <!-- loading overlay container -->
                            <div class="site-header-mega-dropdown-loading-overlay" id="site-header-mega-dropdown-loading-overlay"></div>
                            <!-- end loading overlay container -->
                            <div class="site-header-nav-mega-dropdown-topoffers-container">
                                <div class="site-header-nav-mega-dropdown-topoffers-heading-container">
                                    <span>Top Online Sales</span>
                                    <a href="#">See All Online Sales</a>
                                </div>
                                <div class="site-header-nav-mega-dropdown-top-offer-container">
                                    @for($i=1; $i<=8; $i++)
                                    <div class="site-header-nav-mega-dropdown-topoffer-details-container">
                                        <img src="https://thumbor.forbes.com/thumbor/416x416/filters%3Aformat%28jpg%29/https%3A%2F%2Fi.forbesimg.com%2Fmedia%2Flists%2Fcompanies%2Fkohls_416x416.jpg" class="site-header-nav-mega-dropdown-topoffer-storelogo"></img>
                                        <div class="site-header-nav-mega-dropdown-topoffer-details">
                                            <span class="site-header-nav-mega-dropdown-topoffer-title">20% off on your online order + free shipping</span>
                                            <div class="site-header-nav-mega-dropdown-topoffer-type-container">
                                                <span class="site-header-nav-mega-dropdown-topoffer-storetitle">Kohl's</span>
                                                <span class="site-header-nav-mega-dropdown-topoffer-type">Sale</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="site-header-nav-list-item" id="site-header-nav-list-item">
                    <span class="site-header-nav-list-item-text" id="site-header-nav-list-item-text">Top Free Shipping Offers<i class="fa fa-angle-down header-list-arrow"></i></span>
                    <div id="site-header-nav-mega-dropdown-overlay-container" class="site-header-nav-mega-dropdown-overlay-container">
                        <div class="site-header-nav-mega-dropdown-body-container" id="site-header-nav-mega-dropdown-body-container">
                            <!-- loading overlay container -->
                            <div class="site-header-mega-dropdown-loading-overlay" id="site-header-mega-dropdown-loading-overlay"></div>
                            <!-- end loading overlay container -->
                            <div class="site-header-nav-mega-dropdown-topoffers-container">
                                <div class="site-header-nav-mega-dropdown-topoffers-heading-container">
                                    <span>Top Free Shipping Offers</span>
                                    <a href="#">See All Free Shipping Offers</a>
                                </div>
                                <div class="site-header-nav-mega-dropdown-top-offer-container">
                                    @for($i=1; $i<=8; $i++)
                                    <div class="site-header-nav-mega-dropdown-topoffer-details-container">
                                        <img src="https://thumbor.forbes.com/thumbor/416x416/filters%3Aformat%28jpg%29/https%3A%2F%2Fi.forbesimg.com%2Fmedia%2Flists%2Fcompanies%2Fkohls_416x416.jpg" class="site-header-nav-mega-dropdown-topoffer-storelogo"></img>
                                        <div class="site-header-nav-mega-dropdown-topoffer-details">
                                            <span class="site-header-nav-mega-dropdown-topoffer-title">20% off on your online order + free shipping</span>
                                            <div class="site-header-nav-mega-dropdown-topoffer-type-container">
                                                <span class="site-header-nav-mega-dropdown-topoffer-storetitle">Kohl's</span>
                                                <span class="site-header-nav-mega-dropdown-topoffer-type">Code</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endfor
                                </div>
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