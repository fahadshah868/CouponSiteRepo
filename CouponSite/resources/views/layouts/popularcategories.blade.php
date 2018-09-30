<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Popular Categories</title>
    </head>
    <body>
        <script src="{{asset('js/dropdownmenudetailcontainer.js')}}" type="text/javascript"></script>
        <div class="dropdownmenu-popularcategories-body-container">
            <div class="dropdownmenu-popularcategories-header-container">
                <div class="dopdownmenu-popularcategories-main-heading">Popular Categories</div>
                <a id="dropdownmenu-all-categories-link" href="#">See All Categories</a>
            </div>
            <div class="dropdownmenu-popularcategories-list-container">
                @for($i=1; $i<=10; $i++)
                    <div class="dropdownmenu-category-material-container">
                        <a href="#">
                            <div class="dropdownmenu-category-logo">
                                <img src="https://cdn2.iconfinder.com/data/icons/men-s-accessories-flat-colorful/2048/7768_-_Casual_Shirt-512.png" />
                            </div>
                            <div class="dropdownmenu-category-title">Clothing</div>
                        </a>
                    </div>
                @endfor
            </div>
        </div>
    </body>
</html>