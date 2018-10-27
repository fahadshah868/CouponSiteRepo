@extends('layouts.app_layout')

@section('title','Store Coupons')

@section('content')

<div style="width: 1150px; margin: 30px auto; display: flex; flex-direction: row;">
    <div class="side-bar" style="width: 250px; padding: 0 20px;">
        <a href="#" style="margin-bottom: 30px; color: black; text-decoration: none;">
            <div style="border: 1px solid grey; width: 100%; padding: 20px; background-color: #fff; display: flex; align-items: center; justify-content:center; flex-direction: column; text-align:center;">
                <div style="width: 150px; height: 150px; margin-bottom: 10px;">
                    <img src="https://igx.4sqi.net/img/general/200x200/38757329_V6X_cPjnJ2QsS2w-P7Ret6Lfm8T7J-i4dMRtGBbf-B4.jpg" style="width: 100%; height: 100%;"/>
                </div>
                <div>Kohl's</div>
            </div>
        </a>
        <hr>
        <div style="width: 100%; text-align:center; font-weight: bold; font-size: 24px; font-family: calibri;">50 Offers Available</div>
        <hr>
    </div>
    <div class="detail-bar" style="width: 900px; padding: 0 20px;">
        <div class="heading" style="width: 100%; margin-bottom: 20px; font-size: 30px; font-weight: bold;">Kohl's Coupons</div>
        <div class="coupons-list" style="width: 100%; display: flex; flex-direction: column;">
            @for($i=1; $i<= 10; $i++)
            <div class="coupon-container" style="width:100%; margin-bottom: 15px;">
                <a href="http://www.google.com" style="color: black; text-decoration: none; border: 1px solid grey; width: 100%; padding: 20px; background-color: #fff; display: flex; flex-direction: row; flex-wrap:nowrap;">
                    <div style="width: 100px; height: 100px;">
                        <img src="https://igx.4sqi.net/img/general/200x200/38757329_V6X_cPjnJ2QsS2w-P7Ret6Lfm8T7J-i4dMRtGBbf-B4.jpg" style="width: 100%; height: 100%; border: 1px solid black;"/>
                    </div>
                    <div style="width: calc(100% - 320px); margin: 0 10px; padding: 5px; display: flex; flex-direction: column;">
                        <div style="">Upto 40% off total purchase with discout</div>
                        <div style="">Code</div>
                    </div>
                    <div style="width: 200px; display: flex; flex-direction: column; justify-content:center;">
                        <button style="width: 100%; height: 40px; cursor:pointer;">View Code</button>
                    </div>
                </a>
            </div>
            @endfor
        </div>
    </div>
</div>

@endsection