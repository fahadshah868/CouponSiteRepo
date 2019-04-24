@extends('layouts.app_layout')

@section('title','Filtered Coupons')

@section('content')

<div class="fo-main-container">
    <div class="fo-sb">
        <div class="fo-sb-offers-availability">{{$filteredoffers->total()}} Offers Available</div>
        <hr style="border-top: 1px solid #d1d1d1; width: 100%;">
        <div class="fo-sb-content-container">
            <div class="fo-sb-content-heading">
                <span>Filter By Store</span>
                <span class="reset-category-filters">Reset</span>
            </div>
            <div class="fo-sb-content-body">
                @foreach($stores as $store)
                <label class="checkbox-container">{{$store{0}->store->title}}
                    <input type="checkbox" id="{{$store{0}->store->id}}">
                    <span class="checkmark"></span>
                </label>
                @endforeach
            </div>
        </div>
        <div class="fo-sb-content-container">
            <div class="fo-sb-content-heading">Top Categories</div>
            <div class="fo-sb-list-container">
                <ul>
                    @foreach($alltopcategories as $topcategory)
                        @if($topcategory->id != $category->id)
                        <li>
                            <a class="fo-sb-list-item" href="/coupons/{{$topcategory->url}}" title="{{$topcategory->title}} Coupons">
                                <span class="item-title">{{$topcategory->title}}</span>
                                <span class="coupons-count">{{$topcategory->offers_count}}</span>
                            </a>
                        </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="fo-sb-content-container">
            <div class="fo-sb-content-heading">{{$category->title}}</div>
            <div class="fo-sb-content-body">
                <span class="fo-store-details">{!!$category->description!!}</span>
            </div>
        </div>
    </div>
    <div class="fo-db">
        <div class="fo-db-heading">{{$category->title}} Coupons & Promo Codes</div>
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