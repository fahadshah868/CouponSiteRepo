@extends('layouts.app_layout')

@section('title','Filtered Coupons')

@section('content')

<div class="fo-main-container">
    <div class="fo-sidebar">
        <div class="fo-sidebar-offers-availability">950 Offers Available</div>
        <hr style="border-top: 1px solid #d1d1d1; width: 100%;">
        <div class="fo-sidebar-content-container">
            <div class="fo-sidebar-content-heading">Filter By Offer Type</div>
            <div class="fo-sidebar-content-body">
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
        <div class="fo-sidebar-content-container">
            <div class="fo-sidebar-content-heading">Filter By Stores</div>
            <div class="fo-sidebar-content-body">
                @for($i=1; $i<=10; $i++)
                <label class="checkbox-container">Kohl's
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                @endfor
            </div>
        </div>
        <div class="fo-sidebar-content-container">
            <div class="fo-sidebar-content-heading">Filter By Categories</div>
            <div class="fo-sidebar-content-body">
                @for($i=1; $i<=10; $i++)
                <label class="checkbox-container">Clothing
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                @endfor
            </div>
        </div>
        <div class="fo-sidebar-content-container">
            <div class="fo-sidebar-content-heading">Clothing</div>
            <div class="fo-sidebar-content-body">
                <span class="fo-store-details">Kohl's Department Stores, Inc. operates department stores in the United States. The company offers apparel, footwear, accessories, and home products to middle-income customers.</span>
            </div>
        </div>
    </div>
    <div class="fo-detailbar">
        <div class="fo-detailbar-heading">Clothing Coupons & Promo Codes</div>
        <div class="fo-detailbar-offers-list-container">
            @for($i=1; $i<= 10; $i++)
            <div class="fo-detailbar-offerbody-container">
                <a href="#" class="fo-detailbar-offer-link">
                    <div class="fo-detailbar-anchor">
                        <span>40%</span>
                        <span>OFF</span>
                    </div>
                    <div class="fo-detailbar-offer-container">
                        <div class="fo-detailbar-type-and-verified-container">
                            <div class="fo-detailbar-offertype-code">Code</div>
                            <div class="store-offer-verification-container"><i class="fa fa-check-circle"></i>Verfied</div>
                        </div>
                        <div class="fo-detailbar-offertitle">40% off total purchase with discount</div>
                        <div class="fo-detailbar-offerdetails">40% off total purchase with discount</div>
                        <div class="fo-detailbar-offer-expires"><i class="fa fa-clock-o"></i>Expires: 30/10/18</div>
                    </div>
                    <div class="fo-detailbar-offer-button-container">
                        <span class="offer-button" id="offer-button">View Code</span>
                    </div>
                </a>
            </div>
            @endfor
        </div>
    </div>
</div>

@endsection