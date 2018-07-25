
<script type="text/javascript">
    function DropDown(el) {
        this.dd = el;
        this.placeholder = this.dd.children('span');
        this.opts = this.dd.find('ul.dropdown > li');
        this.val = '';
        this.index = -1;
        this.initEvents();
    }
    DropDown.prototype = {
        initEvents : function() {
            var obj = this;
            obj.dd.on('click', function (event) {
                $(this).toggleClass('active');
                return false;
            });
        },
        getValue: function () {
            return this.val;
        },
        getIndex: function () {
            return this.index;
        }
    }
    $(function () {
        var dd = new DropDown($('#categories-dropdown-button'));
        $(document).click(function () {
            $('.categories-dropdown-button').removeClass('active');
        });
    });
</script>

<header class="site-header-content">
    <div class="site-header">
        <div class="site-header-logo">
            <a href="/BusinessWebProject/BusinessWeb/Pages/mainpage.html" id="logo"><font id="logo-font">WebSite</font></a>
        </div>
        <div class="site-header-searchbar">
            <form>
                <input type="text" id="searchbar" placeholder="Search on...." style="background-image: url('<?= asset("images/searchicon.png")?>');"
            </form>
        </div>
        <div class="site-header-category-container">
            <div class="site-header-categories-button">
                <div id="categories-dropdown-button" class="categories-dropdown-button" tabindex="1">
                    <span>Popular Categories</span>
                    <ul class="dropdown">
                        <li><a href="#">Men Clothing</a></li>
                        <li><a href="#">Women Clothing</a></li>
                        <li><a href="#">Men Shoes</a></li>
                        <li><a href="#">Women Shoes</a></li>
                        <li><a href="#">HandBags</a></li>
                        <li><a href="#">Babies Clothing</a></li>
                        <li><a href="#">Men Pants</a></li>
                        <li><a href="#">Sports Clothing</a></li>
                        <li><a href="#">Plus Size Clothing</a></li>
                        <li><a href="#">Jewelery</a></li>
                        <li><a href="#">See All</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>