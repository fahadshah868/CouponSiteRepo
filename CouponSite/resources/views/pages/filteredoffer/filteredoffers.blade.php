@extends('layouts.app_layout')

@section('title','Filtered Coupons')

@section('content')

<div class="fo-main-container">
    <div class="fo-sidebar">
        <div class="fo-sidebar-offers-availability">950 Offers Available</div>
        <hr style="border-top: 1px solid #d1d1d1; width: 100%;">
        <div class="fo-sidebar-content-container">
            <div class="fo-sidebar-content-heading">Top Stores</div>
            <div class="fo-sidebar-list-container">
                <ul>
                    @for($i=1; $i<=100; $i++)
                    <li>
                        <a class="fo-sidebar-list-item" href="#" title="Target coupons">
                            <span class="item-title">Target</span>
                            <span class="coupons-count">40</span>
                        </a>
                    </li>
                    @endfor
                </ul>
            </div>
        </div>
        <div class="fo-sidebar-content-container">
            <div class="fo-sidebar-content-heading">Top Categories</div>
            <div class="fo-sidebar-list-container">
                <ul>
                    @for($i=1; $i<=100; $i++)
                    <li>
                        <a class="fo-sidebar-list-item" href="#" title="Target coupons">
                            <span class="item-title">Clothing</span>
                            <span class="coupons-count">213</span>
                        </a>
                    </li>
                    @endfor
                </ul>
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
                <div class="fo-detailbar-anchor">
                    <span>40%</span>
                    <span>OFF</span>
                </div>
                <div class="fo-detailbar-action-container">
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
                </div>
            </div>
            @endfor
            {{ $category->links() }}
        </div>
    </div>
</div>

@endsection