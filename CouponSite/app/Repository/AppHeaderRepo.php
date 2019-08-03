<?php

namespace App\Repository;

use Cache;
use App\Event;

class AppHeaderRepo{

    public function getEvents(){
        $events = Cache::remember('header_events', config('constants.EXPIRES_AT'), function () {
            return Event::select('id','title','url')->where('is_active','y')->get();
        });
        return $events;
    }

}