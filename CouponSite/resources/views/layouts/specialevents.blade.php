<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Special Events</title>
    <style>
            .popularstore-body-container{
                width: 100%;
                height: 100%;
                padding: 20px 30px;
            }
            .specialevents-header-container{
                display: flex;
                flex-wrap: nowrap;
                justify-content: space-between;
                margin-bottom: 20px;
            }
            .specialevents-header-container .specialevents-main-heading{
                color: gray;
                font-size: 18px;
                font-family: 'Calibri';
            }
            .specialevents-header-container #all-stores-link{
                color: blue;
                font-size: 15px;
            }
            .specialevents-list-container{
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
            <div class="specialevents-header-container">
                <div class="specialevents-main-heading">Special Events</div>
            </div>
            <div class="specialevents-list-container">
                @for($i=1; $i<=10; $i++)
                    <div class="store-material-container">
                        <a href="#">
                            <div class="store-logo">
                                <img src="data:image/jpeg;base64,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" />
                            </div>
                            <div class="store-title">Black Friday</div>
                        </a>
                    </div>
                @endfor
            </div>
        </div>
    </body>
</html>