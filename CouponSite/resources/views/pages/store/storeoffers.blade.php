@extends('layouts.app_layout')

@section('title','Store Coupons')

@section('content')

<div class="fo-main-container">
    <div class="fo-sidebar">
        <div class="fo-sidebar-storelogo-container">
            <a class="fo-sidebar-store-link" href="{{$store->network_url}}" target="_blank">
                <div class="fo-sidebar-storelogo">
                    <img src="{{$panel_assets_url.$store->logo_url}}" style="width: 100%; height: 100%;"/>
                </div>
                <div class="fo-sidebar-storetitle">{{$store->title}}</div>
            </a>
        </div>
        <hr style="border-top: 1px solid #d1d1d1; width: 100%;">
        <div class="fo-sidebar-offers-availability">{{count($store->offers)}} Offers Available</div>
        <hr style="border-top: 1px solid #d1d1d1; width: 100%;">
        
        <div class="fo-sidebar-content-container">
            <div class="fo-sidebar-content-heading">
                <span>Filter By Category</span>
                <span class="reset-category-filters">Reset</span>
            </div>
            <div class="fo-sidebar-content-body">
                @foreach($categories as $category)
                <label class="checkbox-container">{{$category{0}->category->title}}
                    <input type="checkbox" class="{{$category{0}->category->title}}">
                    <span class="checkmark"></span>
                </label>
                @endforeach
            </div>
        </div>
        <div class="fo-sidebar-content-container">
            <div class="fo-sidebar-content-heading">Top Stores</div>
            <div class="fo-sidebar-list-container">
                <ul>
                    @foreach($alltopstores as $topstore)
                    <li>
                        <a class="fo-sidebar-list-item" href="/store/{{$topstore->secondary_url}}" title="Target coupons">
                            <span class="item-title">{{$topstore->title}}</span>
                            <span class="coupons-count">{{$topstore->offers_count}}</span>
                        </a>
                    </li>
                    @endforeach
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
                @foreach($store->offers as $offer)
                <li class="fo-detailbar-offerbody-container {{$offer->category->title}}">
                    <div class="fo-detailbar-anchor">
                        @foreach(explode(' ', $offer->anchor) as $anchor) 
                            <span>{{$anchor}}</span>
                        @endforeach
                    </div>
                    <div class="fo-detailbar-action-container">
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
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $(`.reset-category-filters`).click(function(){
            $('.checkbox-container').find('input:checkbox').prop(`checked`, false);
            $('li.fo-detailbar-offerbody-container').not('.hidden').show();
            $('.reset-category-filters').css('display','none');
            if($('li.fo-detailbar-offerbody-container:visible').length > 1){
                $(`.fo-sidebar-offers-availability`).html($('li.fo-detailbar-offerbody-container:visible').length+` Offers Available`);
            }
            else{
                $(`.fo-sidebar-offers-availability`).html($('li.fo-detailbar-offerbody-container:visible').length+` Offer Available`);
            }
        });
        $(`.checkbox-container`).click(function(){
            if($('.checkbox-container').find('input:checkbox:checked').length > 0){
                $('.reset-category-filters').css('display','block');
                $('li.fo-detailbar-offerbody-container').hide();
                $('.checkbox-container').find('input:checked').each(function () {
                    $('li.fo-detailbar-offerbody-container.' + $(this).attr('class')).not('.hidden').show();
                });
            } 
            else{
                $('.reset-category-filters').css('display','none');
                $('li.fo-detailbar-offerbody-container').not('.hidden').show();
            }
            if($('li.fo-detailbar-offerbody-container:visible').length > 1){
                $(`.fo-sidebar-offers-availability`).html($('li.fo-detailbar-offerbody-container:visible').length+` Offers Available`);
            }
            else{
                $(`.fo-sidebar-offers-availability`).html($('li.fo-detailbar-offerbody-container:visible').length+` Offer Available`);
            }
        });
    });
</script>

@endsection