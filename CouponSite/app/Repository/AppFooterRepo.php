<?php

namespace App\Repository;

use Cache;
use App\Event;

class AppFooterRepo{

    public function getEvents(){
        $events = Cache::remember('footer_events', config('constants.EXPIRES_AT'), function () {
            return Event::select('id','title','url')->where('display_in_footer','y')->get();
        });
        return $events;
    }
    
}