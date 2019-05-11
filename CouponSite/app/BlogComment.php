<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    protected $table = "blog_comments";
    protected $primaryKey = "id";

    public function blog(){
        return $this->belongsTo('App\Blog','blog_id');
    }
}
