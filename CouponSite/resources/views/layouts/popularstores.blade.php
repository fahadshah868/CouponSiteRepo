<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Popular Stores</title>
</head>
<body>
    <script src="{{asset('js/dropdownmenudetailcontainer.js')}}" type="text/javascript"></script>
    <div class="dropdownmenu-popularstore-body-container">
        <div class="dropdownmenu-popularstores-header-container">
            <div class="dropdownmenu-popularstores-main-heading">Popular Stores</div>
            <a id="all-stores-link" href="#">See All Stores</a>
        </div>
        <div class="dropdownmenu-popularstores-list-container">
            @for($i=1; $i<=10; $i++)
                <div class="dropdownmenu-store-material-container">
                    <a href="#">
                        <div class="dropdownmenu-store-logo">
                            <img src="https://img.grouponcdn.com/coupons/2MB1FyJzVmZc2SQn6UM5y6GPXyik/2M-500x500" />
                        </div>
                        <div class="dropdownmenu-store-title">Tillys</div>
                    </a>
                </div>
            @endfor
        </div>
    </div>
</body>
</html>