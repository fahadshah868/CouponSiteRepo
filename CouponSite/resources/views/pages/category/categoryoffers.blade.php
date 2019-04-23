@extends('layouts.app_layout')

@section('title','Filtered Coupons')

@section('content')

<div class="fo-main-container">
    <div class="fo-sidebar">
        <div class="fo-sidebar-offers-availability">{{$filteredoffers->total()}} Offers Available</div>
        <hr style="border-top: 1px solid #d1d1d1; width: 100%;">
        <div class="fo-sidebar-content-container">
            <div class="fo-sidebar-content-heading">
                <span>Filter By Store</span>
                <span class="reset-category-filters">Reset</span>
            </div>
            <div class="fo-sidebar-content-body">
                @foreach($stores as $store)
                <label class="checkbox-container">{{$store{0}->store->title}}
                    <input type="checkbox" id="{{$store{0}->store->id}}">
                    <span class="checkmark"></span>
                </label>
                @endforeach
            </div>
        </div>
        <div class="fo-sidebar-content-container">
            <div class="fo-sidebar-content-heading">Top Categories</div>
            <div class="fo-sidebar-list-container">
                <ul>
                    @foreach($alltopcategories as $topcategory)
                    <li>
                        <a class="fo-sidebar-list-item" href="/coupons/{{$topcategory->url}}" title="Target coupons">
                            <span class="item-title">{{$topcategory->title}}</span>
                            <span class="coupons-count">{{$topcategory->offers_count}}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="fo-sidebar-content-container">
            <div class="fo-sidebar-content-heading">{{$category->title}}</div>
            <div class="fo-sidebar-content-body">
                <span class="fo-store-details">{!!$category->description!!}</span>
            </div>
        </div>
    </div>
    <div class="fo-detailbar">
        <div class="fo-detailbar-heading">{{$category->title}} Coupons & Promo Codes</div>
        <section id="filtered-offers">
        @include('partialviews.filteredoffers')
        </section>
    </div>
</div>


<script type="text/javascript">
    $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');  
        getArticles(url);
    });
    function getArticles(url) {
        $.ajax({
            url : url
        }).done(function (data) {
            $('#filtered-offers').html(data);  
        }).fail(function () {
            alert('Articles could not be loaded.');
        });
    }
</script>

@endsection