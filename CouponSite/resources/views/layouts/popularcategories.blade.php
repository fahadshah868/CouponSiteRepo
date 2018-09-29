<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Popular Categories</title>
    <style>
            .popularstore-body-container{
                width: 100%;
                height: 100%;
                padding: 20px 30px;
            }
            .popularcategories-header-container{
                display: flex;
                flex-wrap: nowrap;
                justify-content: space-between;
                margin-bottom: 20px;
            }
            .popularcategories-header-container .popularcategories-main-heading{
                color: gray;
                font-size: 18px;
                font-family: 'Calibri';
            }
            .popularcategories-header-container #all-stores-link{
                color: blue;
                font-size: 15px;
            }
            .popularcategories-list-container{
                width: 100%;
                display: flex;
                flex-wrap: wrap;
            }
            .store-material-container{
                width: 20%;
                height: 150px;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .store-material-container .store-logo{
                width: 80px;
                height: 80px;
                margin-bottom: 5px;
            }
            .store-material-container .store-logo img{
                border: 1px solid #f1f1f1;
                width: 100%;
                height: 100%;
            }
            .store-material-container .store-title{
                font-size: 13px;
                font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
                color: blue;
            }
        </style>
    </head>
    <body>
        <div class="popularstore-body-container">
            <div class="popularcategories-header-container">
                <div class="popularcategories-main-heading">Popular Categories</div>
                <a id="all-stores-link" href="#">See All Categories</a>
            </div>
            <div class="popularcategories-list-container">
                @for($i=1; $i<=10; $i++)
                    <div class="store-material-container">
                        <a href="#">
                            <div class="store-logo">
                                <img src="https://cdn2.iconfinder.com/data/icons/men-s-accessories-flat-colorful/2048/7768_-_Casual_Shirt-512.png" />
                            </div>
                            <div class="store-title">Clothing</div>
                        </a>
                    </div>
                @endfor
            </div>
        </div>
    </body>
</html>