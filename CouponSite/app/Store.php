<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = "stores";
    protected $primaryKey = "id";

    //has many
    public function offer(){
        return $this->hasMany('App\Offer');
    }
    // public function storecategorygroup(){
    //     return $this->hasMany('App\StoreCategoryGroup');
    // }
    // public function carouseloffer(){
    //     return $this->hasMany('App\CarouselOffer');
    // }
    // //belongs to
    // public function network(){
    //     return $this->belongsTo('App\Network');
    // }
}
