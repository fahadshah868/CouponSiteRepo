<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = "offers";
    protected $primaryKey = "id";

    public function store(){
        return $this->belongsTo('App\Store');
    }
    public function category(){
        return $this->belongsTo('App\Category');
    }
}
