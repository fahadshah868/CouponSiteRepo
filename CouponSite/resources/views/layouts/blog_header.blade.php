
<header class="blog-header-main-container">
    <div class="blog-header-container">
        <div class="blog-header-wrapper">
            <div class="blog-header-logo">
                <a href="/blog" class="logo">Blog By CC</a>
            </div>
            <div class="hamburger-menu-container blog-header-hamburger">
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
                        <li><a href="#">Shopping Articles<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#">Food Articles<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#">Clothing Articles<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#">Go To CouponsCorner<i class="fa fa-angle-right"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="blog-header-searchbar-container">
                <form action="/blog/" method="GET">
                    <input type="text" name="title" class="blog-header-searchbar" placeholder="Search Blog" required/>
                    <button type="submit" class="blog-header-search-btn"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
    <div class="blog-nav-wrapper-container">
        <div class="blog-nav-container">
            <ul class="blog-nav-list">
                @foreach($blogcategories as $blogcategory)
                    <li><a class="blog-category-title" href="/blog/{{$blogcategory->url}}">{{$blogcategory->title}}</a></li>
                @endforeach
            </ul>
            <a href="/" class="site-link">goto CouponsCorner<i class="fa fa-angle-double-right"></i></a>
        </div>
    </div>
</header>