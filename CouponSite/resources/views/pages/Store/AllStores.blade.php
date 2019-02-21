@extends('layouts.app_layout')

@section('title','All Stores')

@section('content')

<div class="all-stores-main-container">
    <div class="all-stores-main-heading">
        Browse Coupons By Store
    </div>
    <div class="as-top-stores-container">
        <div class="as-top-stores-heading">
            Top Stores
        </div>
        <div class="as-top-stores-list-container">
            @for($i=1; $i<=12; $i++)
            <div class="as-top-store-container">
                <a href="/store/storeoffers" class="as-top-store-link">
                    <div class="as-top-store-logo">
                        <img src="https://igx.4sqi.net/img/general/200x200/38757329_V6X_cPjnJ2QsS2w-P7Ret6Lfm8T7J-i4dMRtGBbf-B4.jpg"/>
                    </div>
                    <div class="as-top-store-title">Kohl's</div>
                </a>
            </div>
            @endfor
        </div>
    </div>
    <div class="as-allstores-container" id="as-allstores-container">
        <div class="as-category-outer-container" id="as-category-outer-container">
            <div class="as-category-inner-container" id="as-category-inner-container">
                <span class="as-category-heading">Filter Stores By Category</span>
                <div class="as-categories-container">
                    <ul class="as-categories-list">
                        @for($i=1; $i<=100; $i++)
                        <li><a class="as-categories-list-item" href="#" title="Category Name">Assessories</a></li>
                        @endfor
                    </ul>
                </div>
            </div>
        </div>
        <div class="as-filtered-stores-body-container" id="as-filtered-stores-body-container">
            <span class="as-filtered-stores-heading">All Stores</span>
            <div class="as-filtered-stores-container">
                <div class="as-filtered-stores-dropdown">
                    <div class="select">
                        <span>ALL</span>
                        <i class="fa fa-chevron-down"></i>
                    </div>
                    <ul class="dropdown-menu">
                        <li class="active">ALL</li>
                        <li>A</li>
                        <li>B</li>
                        <li>C</li>
                        <li>D</li>
                        <li>E</li>
                        <li>F</li>
                        <li>G</li>
                        <li>H</li>
                        <li>I</li>
                        <li>J</li>
                        <li>K</li>
                        <li>L</li>
                        <li>M</li>
                        <li>N</li>
                        <li>O</li>
                        <li>P</li>
                        <li>Q</li>
                        <li>R</li>
                        <li>S</li>
                        <li>T</li>
                        <li>U</li>
                        <li>V</li>
                        <li>W</li>
                        <li>X</li>
                        <li>Y</li>
                        <li>Z</li>
                        <li>0-9</li>
                    </ul>
                </div>
                <ul class="as-filtered-stores-navbar">
                    <li class="as-filtered-stores-navbar-item"><a class="as-filtered-stores-letter active-filtered-store-letter" href="#">ALL</a></li>
                    <li class="as-filtered-stores-navbar-item"><a class="as-filtered-stores-letter" href="#">A</a></li>
                    <li class="as-filtered-stores-navbar-item"><a class="as-filtered-stores-letter" href="#">B</a></li>
                    <li class="as-filtered-stores-navbar-item"><a class="as-filtered-stores-letter" href="#">C</a></li>
                    <li class="as-filtered-stores-navbar-item"><a class="as-filtered-stores-letter" href="#">D</a></li>
                    <li class="as-filtered-stores-navbar-item"><a class="as-filtered-stores-letter" href="#">E</a></li>
                    <li class="as-filtered-stores-navbar-item"><a class="as-filtered-stores-letter" href="#">F</a></li>
                    <li class="as-filtered-stores-navbar-item"><a class="as-filtered-stores-letter" href="#">G</a></li>
                    <li class="as-filtered-stores-navbar-item"><a class="as-filtered-stores-letter" href="#">H</a></li>
                    <li class="as-filtered-stores-navbar-item"><a class="as-filtered-stores-letter" href="#">I</a></li>
                    <li class="as-filtered-stores-navbar-item"><a class="as-filtered-stores-letter" href="#">J</a></li>
                    <li class="as-filtered-stores-navbar-item"><a class="as-filtered-stores-letter" href="#">K</a></li>
                    <li class="as-filtered-stores-navbar-item"><a class="as-filtered-stores-letter" href="#">L</a></li>
                    <li class="as-filtered-stores-navbar-item"><a class="as-filtered-stores-letter" href="#">M</a></li>
                    <li class="as-filtered-stores-navbar-item"><a class="as-filtered-stores-letter" href="#">N</a></li>
                    <li class="as-filtered-stores-navbar-item"><a class="as-filtered-stores-letter" href="#">O</a></li>
                    <li class="as-filtered-stores-navbar-item"><a class="as-filtered-stores-letter" href="#">P</a></li>
                    <li class="as-filtered-stores-navbar-item"><a class="as-filtered-stores-letter" href="#">Q</a></li>
                    <li class="as-filtered-stores-navbar-item"><a class="as-filtered-stores-letter" href="#">R</a></li>
                    <li class="as-filtered-stores-navbar-item"><a class="as-filtered-stores-letter" href="#">S</a></li>
                    <li class="as-filtered-stores-navbar-item"><a class="as-filtered-stores-letter" href="#">T</a></li>
                    <li class="as-filtered-stores-navbar-item"><a class="as-filtered-stores-letter" href="#">U</a></li>
                    <li class="as-filtered-stores-navbar-item"><a class="as-filtered-stores-letter" href="#">V</a></li>
                    <li class="as-filtered-stores-navbar-item"><a class="as-filtered-stores-letter" href="#">W</a></li>
                    <li class="as-filtered-stores-navbar-item"><a class="as-filtered-stores-letter" href="#">X</a></li>
                    <li class="as-filtered-stores-navbar-item"><a class="as-filtered-stores-letter" href="#">Y</a></li>
                    <li class="as-filtered-stores-navbar-item"><a class="as-filtered-stores-letter" href="#">Z</a></li>
                    <li class="as-filtered-stores-navbar-item"><a class="as-filtered-stores-letter" href="#">0-9</a></li>
                </ul>
                <ul class="as-filtered-stores-list">
                    @for($i=1; $i<=500; $i++)
                    <li><a class="as-filtered-stores-list-item" href="#" title="Store Name"><span>Papa John's</span><span>30 Coupons Available</span></a></li>
                    @endfor
                </ul>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/customdropdown.js')}}"></script>
<script>
    $(document).ready(function(){
        var height_difference = $(this).scrollTop() - $('#as-allstores-container').position().top;
        if(height_difference >= 0 && height_difference + 605 < $("#as-allstores-container").height()){
            $("#as-category-inner-container").css({position: "fixed", top: "10px", bottom: "auto", width: "320px"});
        }
        else if(height_difference + 605 >= $("#as-allstores-container").height()){
            $("#as-category-inner-container").css({position: "absolute", top: "auto", bottom: "0", width: "320px"});
        }
        else{
            $("#as-category-inner-container").css({position: "absolute", top: "0", bottom: "auto", width: "100%"});
        }
        $(document).on('scroll', function() {
            height_difference = $(this).scrollTop() - $('#as-allstores-container').position().top;
            if(height_difference >= 0 && height_difference + 605 < $("#as-allstores-container").height()){
                $("#as-category-inner-container").css({position: "fixed", top: "10px", bottom: "auto", width: "320px"});
            }
            else if(height_difference + 605 >= $("#as-allstores-container").height()){
                $("#as-category-inner-container").css({position: "absolute", top: "auto", bottom: "0", width: "320px"});
            }
            else{
                $("#as-category-inner-container").css({position: "absolute", top: "0", bottom: "auto", width: "100%"});
            }
        });
    });
</script>

@endsection