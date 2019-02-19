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
        <div class="store-coupons-sidebar-filterbycoupontype-container">
            <div class="store-coupons-sidebar-filterbycoupontype-heading">Filter By Offer</div>
            <div>
                @for($i=1; $i<=3; $i++)
                <label class="checkbox-container">In Store Coupons
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                @endfor
            </div>
        </div>
        <div class="store-coupons-sidebar-filterbycategory-container">
            <div class="store-coupons-sidebar-filterbycategory-heading">Filter By Category</div>
            <div>
                @for($i=1; $i<=10; $i++)
                <label class="checkbox-container">Clothing
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                @endfor
            </div>
        </div>
        <div class="store-description-container">
            <div class="sc-store-title">About Kohl's</div>
            <div class="sc-store-description">Kohl's Department Stores, Inc. operates department stores in the United States. The company offers apparel, footwear, accessories, and home products to middle-income customers.</div>
        </div>
    </div>
    <div class="store-coupons-detailbar">
        <div class="store-coupons-detailbar-heading">Kohl's Coupons</div>
        <div class="store-coupons-detailbar-coupons-list-container">
            @for($i=1; $i<= 10; $i++)
            <div class="store-coupons-detailbar-coupon-container">
                <a href="#" class="store-coupons-detailbar-coupon-link">
                    <div class="store-coupons-detailbar-anchor">
                        <span>40%</span>
                        <span>OFF</span>
                    </div>
                    <div class="store-coupons-detailbar-offer-container">
                        <div class="store-coupons-detailbar-type-and-verified-container">
                            <div class="store-coupons-detailbar-offertype-code">Code</div>
                            <div class="store-coupon-verification-container"><i class="fa fa-check-circle"></i>Verfied</div>
                        </div>
                        <div class="store-coupons-detailbar-offertitle">40% off total purchase with discount</div>
                        <div class="store-coupons-detailbar-offerdetails">40% off total purchase with discount</div>
                        <div class="store-coupons-detailbar-coupon-expires"><i class="fa fa-clock-o"></i>Expires: 30/10/18</div>
                    </div>
                    <div class="store-coupons-detailbar-offer-button-container">
                        <span class="offer-button" id="offer-button">View Code</span>
                        <!-- <button id="offer-button">View Code</button> -->
                    </div>
                </a>
            </div>
            @endfor
        </div>
    </div>
</div>

@endsection