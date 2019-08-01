<?php

namespace App\Repository;

use Cache;
use Carbon\Carbon;
use App\Store;
use App\Category;

class Ajax{

    public function getTopStores(){
        $topstores = Cache::remember('header_topstores', Carbon::now()->addMinutes(5), function () {
            return Store::select('id', 'title', 'secondary_url', 'logo_url')->where('is_topstore', 'y')->where('is_active', 'y')->limit(11)->get();
        });
        return $topstores;
    }
    public function getPopularStores(){
        $popularstores = [];
        if (Cache::has('header_popularstores')) {
            $popularstores = Cache::get('header_popularstores');
        } else if (Cache::has('allstores')) {
            $popularstores = Cache::remember('header_popularstores', Carbon::now()->addMinutes(5), function () {
                return Cache::get('allstores')->select('id','title','secondary_url')
                ->where('is_topstore', 'n')
                ->where('is_popularstore', 'y')
                ->limit(30)->get();
            });
        } else {
            $popularstores = Cache::remember('header_popularstores', Carbon::now()->addMinutes(5), function () {
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
        }
        return $popularstores;
    }
    public function getTopCategories(){
        $topcategories = Cache::remember('header_topcategories', Carbon::now()->addMinutes(5), function () {
            return Category::select('id', 'title', 'url', 'logo_url')->where('is_topcategory', 'y')->where('is_active', 'y')->limit(11)->get();
        });
        return $topcategories;
    }
    public function getPopularCategories(){
        $popularcategories = [];
        if (Cache::has('header_popularcategories')) {
            $popularcategories = Cache::get('header_popularcategories');
        } else if (Cache::has('allcategories')) {
            $popularcategories = Cache::remember('header_popularcategories', Carbon::now()->addMinutes(5), function () {
                return Cache::get('allcategories')->select('id','title','url')
                ->where('is_topcategory','n')
                ->where('is_popularcategory','y')
                ->limit(30)->get();
            });
        } else {
            $popularcategories = Cache::remember('header_popularcategories', Carbon::now()->addMinutes(5), function () {
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
        }
        return $popularcategories;
    }
    public function getSearchedStores($title){
        $searchedstores = [];
        if (Cache::has('allstores')) {
            $searchedstores = Cache::get('allstores')->select('title','secondary_url','logo_url')
            ->where('title', 'like', '%' . $title . '%')
            ->limit(4)->get();
        } else {
            $searchedstores = Store::select('title','secondary_url','logo_url')->where('title', 'like', '%' . $title . '%')->where('is_active','y')->limit(4)->get();
        }
        return $searchedstores;
    }
    public function getSearchedCategories($title){
        $searchedcategories = [];
        if (Cache::has('allcategories')) {
            $searchedcategories = Cache::get('allcategories')->select('title','url')
            ->where('title', 'like', '%' . $title . '%')
            ->where('is_active','y')
            ->limit(4)->get();
        } else {
            $searchedcategories = Category::select('title','url')->where('title', 'like', '%' . $title . '%')->where('is_active','y')->limit(4)->get();
        }
        return $searchedcategories;
    }

}