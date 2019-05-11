<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreCategory extends Model
{
    protected $table = "store_categories";
    protected $primaryKey = "id";

    //belongs to
    public function store(){
        return $this->belongsTo('App\Store','store_id');
    }
    public function category(){
        return $this->belongsTo('App\Category','category_id');
    }
}
