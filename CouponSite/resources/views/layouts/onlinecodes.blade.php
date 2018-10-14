<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        
    </style>
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>        
    
</head>
<body>
        <div class='dropdownmenu-onlinecodes-body-container'>
                <div class='dropdownmenu-onlinecodes-header-container'>
                    <div class='dopdownmenu-detailcontainer-main-heading' id='dopdownmenu-detailcontainer-main-heading'>Online Codes</div>
                    <a id='dropdownmenu-all-onlinecodes-link' href='#'>See All Online Codes</a>
                </div>
                <div class='dropdownmenu-onlinecodes-list-container'>
                    @for($i=1; $i<=6; $i++)
                        <a href= "#">
                            <div class='dropdownmenu-onlinecode-material-container'>
                                <div class='dropdownmenu-onlinecode-store-logo'>
                                    <img src='https://cdn2.iconfinder.com/data/icons/men-s-accessories-flat-colorful/2048/7768_-_Casual_Shirt-512.png' />
                                </div>
                                <div class='dropdownmenu-onlinecode-offer-container'>
                                    <div class='dropdownmenu-onlinecode-offer-title'>upto 20% off</div>
                                    <div class='dropdownmenu-onlinecode-offer-label'>code</div>
                                </div>
                            </div>
                        </a>
                    @endfor
            </div>
            </div>
</body>
</html>