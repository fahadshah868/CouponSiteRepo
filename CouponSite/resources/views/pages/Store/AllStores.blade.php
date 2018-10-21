@extends('layouts.app_layout')

@section('title','All Stores')

@section('content')

<div class="all-stores-main-container" style="width: 1150px; margin: 30px auto;">
    <div class="all-stores-heading" style="font-size: 25px;">
        Browse Coupons By Store
    </div>
    <div class="all-stores-list-container" style="width: 100%; margin: 30px 0; border: 1px solid grey;">
        <div class="all-stores-list-heading" style="width: 100%; padding: 15px 20px; background-color: silver; border-bottom: 1px solid grey;">
            Stores List
        </div>
        <div class="all-stores-list" style="width: 100%; background-color: #ffffff; padding: 15px 30px;">
            <ul style="-webkit-column-count: 2; -moz-column-count: 2; column-count: 2; list-style: none;">
                @for($i=1; $i<= 50; $i++)
                    <li><a href="#">Kohl's</a></li>
                @endfor
            </ul>
        </div>
    </div>
</div>

@endsection