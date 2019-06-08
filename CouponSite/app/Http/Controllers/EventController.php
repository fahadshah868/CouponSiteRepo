<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{
    public function getEventOffers($event){
        $data['event'] = Event::select('id','title','url','description')
        ->where('url',$event)
        ->with(['eventoffers' => function($q){
            $q->select('id','offer_id','event_id')
            ->with(['offer' => function($oq){
                $oq->select('id','store_id','category_id','title','location','type')
                ->where('starting_date', '<=', config('constants.TODAY_DATE'))
                ->where(function($sq){
                    $sq->where('expiry_date', '>=', config('constants.TODAY_DATE'))
                    ->orWhere('expiry_date', null);
                })
                ->with(['store' => function($sq){
                    $sq->select('id','title','secondary_url','logo_url');
                }]);
            }]);
        }])
        ->first();
        $data['stores'] = $data['event']->eventoffers->groupBy(function ($item, $key) {
            return $item->offer->store_id;
        });
        $data['panel_assets_url'] = config('constants.PANEL_ASSETS_URL');
        return view('pages.event.eventoffers',$data);
    }
}
