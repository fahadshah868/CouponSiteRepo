<?php

namespace App\Repository;

use Cache;
use App\Store;
use App\Category;

class AjaxRepo{

    public function getTopStores(){
        $topstores = Cache::remember('header_topstores', config('constants.EXPIRES_AT'), function () {
            return Store::select('id', 'title', 'secondary_url', 'logo_url')->where('is_topstore', 'y')->where('is_active', 'y')->limit(11)->get();
        });
        return $topstores;
    }
    public function getPopularStores(){
        $popularstores = Cache::remember('header_popularstores', config('constants.EXPIRES_AT'), function () {
            return Store::select('id','title','secondary_url')
            ->where('is_topstore','n')
            ->where('is_popularstore','y')
            ->where('is_active','y')
            ->withCount(['offers'=> function($q) {
                $q->where('is_active','y')
                ->where('starting_date', '<=', config('constants.TODAY_DATE'))
                ->where(function($sq){
                    $sq->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                    ->orwhere('expiry_date', null);
                });
            }])->limit(30)->get();
        });
        return $popularstores;
    }
    public function getTopCategories(){
        $topcategories = Cache::remember('header_topcategories', config('constants.EXPIRES_AT'), function () {
            return Category::select('id', 'title', 'url', 'logo_url')->where('is_topcategory', 'y')->where('is_active', 'y')->limit(11)->get();
        });
        return $topcategories;
    }
    public function getPopularCategories(){
        $popularcategories = Cache::remember('header_popularcategories', config('constants.EXPIRES_AT'), function () {
            return Category::select('id','title','url')
            ->where('is_topcategory','n')
            ->where('is_popularcategory','y')
            ->where('is_active','y')
            ->withCount(['offers'=> function($q) {
                $q->where('is_active','y')
                ->where('starting_date', '<=', config('constants.TODAY_DATE'))
                ->where(function($sq){
                    $sq->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                    ->orwhere('expiry_date', null);
                });
            }])->limit(30)->get();
        });
        return $popularcategories;
    }
    public function getSearchedStores($title){
        $searchedstores = [];
        if (Cache::has('allstores')) {
            $searchedstores = Cache::get('allstores')
            ->where('title', 'like', '%' . $title . '%')
            ->limit(4);
        } else {
            $searchedstores = Store::select('title','secondary_url','logo_url')->where('title', 'like', '%' . $title . '%')->where('is_active','y')->limit(4)->get();
        }
        return $searchedstores;
    }
    public function getSearchedCategories($title){
        $searchedcategories = [];
        if (Cache::has('allcategories')) {
            $searchedcategories = Cache::get('allcategories')
            ->where('title', 'like', '%' . $title . '%')
            ->where('is_active','y')
            ->limit(4);
        } else {
            $searchedcategories = Category::select('title','url')->where('title', 'like', '%' . $title . '%')->where('is_active','y')->limit(4)->get();
        }
        return $searchedcategories;
    }

}