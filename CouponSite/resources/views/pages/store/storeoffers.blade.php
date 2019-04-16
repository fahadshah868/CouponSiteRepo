@extends('layouts.app_layout')

@section('title','Store Coupons')

@section('content')

<div class="fo-main-container">
    <div class="fo-sidebar">
        <div class="fo-sidebar-storelogo-container">
            <a class="fo-sidebar-store-link" href="#">
                <div class="fo-sidebar-storelogo">
                    <img src="{{$panel_assets_url.$store->logo_url}}" style="width: 100%; height: 100%;"/>
                </div>
                <div class="fo-sidebar-storetitle">{{$store->title}}</div>
            </a>
        </div>
        <hr style="border-top: 1px solid #d1d1d1; width: 100%;">
        <div class="fo-sidebar-offers-availability">{{count($store->offer)}} Offers Available</div>
        <hr style="border-top: 1px solid #d1d1d1; width: 100%;">
        
        <div class="fo-sidebar-content-container">
            <div class="fo-sidebar-content-heading">Filter By Category</div>
            <div class="fo-sidebar-content-body">
                @foreach($storecategories as $storecategory => $val)
                <label class="checkbox-container">{{$storecategory}}
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
                @endforeach
            </div>
        </div>
        <div class="fo-sidebar-content-container">
            <div class="fo-sidebar-content-heading">You May Also Like</div>
            <div class="fo-sidebar-list-container">
                <ul>
                    @for($i=1; $i<=100; $i++)
                    <li>
                        <a class="fo-sidebar-list-item" href="#" title="Target coupons">
                            <span>Target</span>
                            <span>40 Coupons</span>
                        </a>
                    </li>
                    @endfor
                </ul>
            </div>
        </div>
        <div class="fo-sidebar-content-container">
            <div class="fo-sidebar-content-heading">About {{$store->title}}</div>
            <div class="fo-sidebar-content-body">
                <span class="fo-store-details">{!!$store->description!!}</span>
            </div>
        </div>
    </div>
    <div class="fo-detailbar">
        <div class="fo-detailbar-heading">{{$store->title}} Coupons & Promo Codes</div>
        <div class="fo-detailbar-offers-list-container">
            <ul>
                @foreach($store->offer as $offer)
                <li class="fo-detailbar-offerbody-container">
                    <div class="fo-detailbar-anchor">
                        @foreach(explode(' ', $offer->anchor) as $anchor) 
                            <span>{{$anchor}}</span>
                        @endforeach
                    </div>
                    <div class="fo-detailbar-offer-container">
                        <div class="fo-detailbar-type-and-verified-container">
                            <div class="fo-detailbar-offertype-code">{{$offer->location.' '.$offer->type}}</div>
                            @if(strcasecmp($offer->is_verified,'yes') == 0)
                            <div class="store-offer-verification-container"><i class="fa fa-check-circle"></i>Verfied</div>
                            @endif
                        </div>
                        <div class="fo-detailbar-offertitle">{{$offer->title}}</div>
                        <div class="fo-detailbar-offerdetails">{{$offer->details}}</div>
                        <div class="fo-detailbar-offer-expires"><i class="fa fa-clock-o"></i>Expires: {{ Carbon\Carbon::parse($offer->expiry_date)->format('d/m/Y') }}</div>
                    </div>
                    <div class="fo-detailbar-offer-button-container">
                        @if(strcasecmp($offer->location,'Online & In-Store') == 0)
                        <span class="offer-button" id="offer-button">
                            USE ONLINE
                        </span>
                        <span class="offer-button" id="offer-button">
                            USE IN-STORE
                        </span>
                        @else
                        <span class="offer-button" id="offer-button">
                            @if(strcasecmp($offer->type,"code") == 0)
                                VIEW CODE
                            @else
                                GET DEAL
                            @endif
                        </span>
                        @endif
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

@endsection