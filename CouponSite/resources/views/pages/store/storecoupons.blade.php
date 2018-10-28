@extends('layouts.app_layout')

@section('title','Store Coupons')

@section('content')

<div class="store-coupons-main-container">
    <div class="store-coupons-sidebar">
        <div class="store-coupons-sidebar-storelogo-container">
            <a class="store-coupons-sidebar-store-link" href="#">
                <div class="store-coupons-sidebar-storelogo">
                    <img src="https://igx.4sqi.net/img/general/200x200/38757329_V6X_cPjnJ2QsS2w-P7Ret6Lfm8T7J-i4dMRtGBbf-B4.jpg" style="width: 100%; height: 100%;"/>
                </div>
                <div class="store-coupons-sidebar-storetitle">Kohl's</div>
            </a>
        </div>
        <hr style="border-top: 1px solid #d1d1d1; width: 100%;">
        <div class="store-coupons-sidebar-offers-availability">50 Offers Available</div>
        <hr style="border-top: 1px solid #d1d1d1; width: 100%;">
        <div class="store-coupons-sidebar-filterbyoffer-container" style="margin:30px 0;">
            <div style="margin-bottom: 20px; font-size: 18px; font-weight: bold;">Filter By Offer</div>
            <div>
                @for($i=1; $i<=3; $i++)
                <label class="checkbox-container">In Store Coupons
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                @endfor
            </div>
        </div>
        <div class="store-coupons-sidebar-filterbycategory-container" style="margin:30px 0;">
            <div style="margin-bottom: 20px; font-size: 18px; font-weight: bold;">Filter By Category</div>
            <div>
                @for($i=1; $i<=12; $i++)
                <label class="checkbox-container">Clothing
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                @endfor
            </div>
        </div>
        <div style="width: 100%;">
            <div style="font-weight: bold; font-size: 18px; margin-bottom: 10px;">About Kohl's</div>
            <div>Kohl's Department Stores, Inc. operates department stores in the United States. The company offers apparel, footwear, accessories, and home products to middle-income customers.</div>
        </div>
    </div>
    <div class="store-coupons-detailbar">
        <div class="store-coupons-detailbar-heading">Kohl's Coupons</div>
        <div class="store-coupons-detailbar-coupons-list-container">
            @for($i=1; $i<= 10; $i++)
            <div class="store-coupons-detailbar-coupon-container">
                <a href="#" class="store-coupons-detailbar-coupon-link">
                    <div class="store-coupons-detailbar-coupon-title">
                        <span style="font-size: 25px; font-weight: bold;">40%</span>
                        <span style="font-size: 18px;">Off</span>
                    </div>
                    <div class="store-coupons-detailbar-offer-container">
                        <div style="font-size: 13px; color: #044D6E;"><i style="margin-right: 5px; font-size: 15px;" class="fa fa-check-circle"></i>Verfied</div>
                        <div class="store-coupons-detailbar-offertitle">40% off total purchase with discout</div>
                        <div class="store-coupons-detailbar-offerlabel"><span>code</span></div>
                        <div class="store-coupons-detailbar-coupon-expires"><i style="margin-right: 5px;" class="fa fa-clock-o"></i>Expires: 30/10/18</div>
                    </div>
                    <div class="store-coupons-detailbar-offer-button-container">
                        <button id="offer-button">View Code</button>
                    </div>
                </a>
            </div>
            @endfor
        </div>
    </div>
</div>

@endsection