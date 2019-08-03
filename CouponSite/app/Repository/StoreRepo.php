<?php

namespace App\Repository;
use Cache;
use App\Store;
use App\Category;
use App\Offer;

class StoreRepo{

    public function getAllTopStores(){
        $alltopstores = Cache::remember('alltopstores', config('constants.EXPIRES_AT'), function () {
            return Store::select('id','title','secondary_url','logo_url')
            ->where('is_active','y')
            ->where('is_topstore','y')
            ->get();
        });
        return $alltopstores;
    }
    public function getAllStores(){
        $allstores = Cache::remember('allstores', config('constants.EXPIRES_AT'), function () {
            return Store::select('id','title','logo_url','secondary_url')
            ->where('is_active','y')
            ->orderByRaw('title + 0','ASC','title')->orderBy('title','ASC')
            ->withCount(['offers' => function($q){
                $q->where('starting_date', '<=', config('constants.TODAY_DATE'))
                ->where(function($sq){
                    $sq->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                    ->orWhere('expiry_date', null);
                });
            }])->get();
        });
        return $allstores;
    }
    public function getAllCategories(){
        $allcategories = Cache::remember('allcategories_prioritywise', config('constants.EXPIRES_AT'), function () {
            return Category::select('id','title')
            ->where('is_active','y')
            ->whereHas('offers', function($q){
                $q->where('is_active','y');
            })
            ->orderBy('is_topcategory','asc')
            ->orderBy('is_popularcategory','asc')
            ->get();
        });
        return $allcategories;
    }
}