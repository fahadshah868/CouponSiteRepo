@extends('layouts.app_layout')

@section('title','Store Coupons')

@section('content')

<div class="so-main-container">
    <div class="so-sidebar">
        <div class="so-sidebar-storelogo-container">
            <a class="so-sidebar-store-link" href="#">
                <div class="so-sidebar-storelogo">
                    <img src="https://igx.4sqi.net/img/general/200x200/38757329_V6X_cPjnJ2QsS2w-P7Ret6Lfm8T7J-i4dMRtGBbf-B4.jpg" style="width: 100%; height: 100%;"/>
                </div>
                <div class="so-sidebar-storetitle">Kohl's</div>
            </a>
        </div>
        <hr style="border-top: 1px solid #d1d1d1; width: 100%;">
        <div class="so-sidebar-offers-availability">50 Offers Available</div>
        <hr style="border-top: 1px solid #d1d1d1; width: 100%;">
        <div class="so-sidebar-content-container">
            <div class="so-sidebar-content-heading">Filter By Offer Type</div>
            <div class="so-sidebar-content-body">
                <label class="radio-container">All
                    <input type="radio" name="offertype" checked>
                    <span class="checkmark"></span>
                </label>
                @for($i=1; $i<=3; $i++)
                <label class="radio-container">Online & Instore
                    <input type="radio" name="offertype">
                    <span class="checkmark"></span>
                </label>
                @endfor
            </div>
        </div>
        <div class="so-sidebar-content-container">
            <div class="so-sidebar-content-heading">Filter By Category</div>
            <div class="so-sidebar-content-body">
                @for($i=1; $i<=10; $i++)
                <label class="checkbox-container">Clothing
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                @endfor
            </div>
        </div>
        <div class="so-sidebar-content-container">
            <div class="so-sidebar-content-heading">About Kohl's</div>
            <div class="so-sidebar-content-body">
                <span class="so-store-details">Kohl's Department Stores, Inc. operates department stores in the United States. The company offers apparel, footwear, accessories, and home products to middle-income customers.</span>
            </div>
        </div>
    </div>
    <div class="so-detailbar">
        <div class="so-detailbar-heading">Kohl's Coupons</div>
        <div class="so-detailbar-offers-list-container">
            @for($i=1; $i<= 10; $i++)
            <div class="so-detailbar-offerbody-container">
                <a href="#" class="so-detailbar-offer-link">
                    <div class="so-detailbar-anchor">
                        <span>40%</span>
                        <span>OFF</span>
                    </div>
                    <div class="so-detailbar-offer-container">
                        <div class="so-detailbar-type-and-verified-container">
                            <div class="so-detailbar-offertype-code">Code</div>
                            <div class="store-offer-verification-container"><i class="fa fa-check-circle"></i>Verfied</div>
                        </div>
                        <div class="so-detailbar-offertitle">40% off total purchase with discount</div>
                        <div class="so-detailbar-offerdetails">40% off total purchase with discount</div>
                        <div class="so-detailbar-offer-expires"><i class="fa fa-clock-o"></i>Expires: 30/10/18</div>
                    </div>
                    <div class="so-detailbar-offer-button-container">
                        <span class="offer-button" id="offer-button">View Code</span>
                    </div>
                </a>
            </div>
            @endfor
        </div>
    </div>
</div>

@endsection