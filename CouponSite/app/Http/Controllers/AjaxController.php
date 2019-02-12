<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;

class AjaxController extends Controller
{
    public function getAjaxRequest($action){
        if($action == 1){
            $data['topstores'] = Store::where('is_topstore','yes')->limit(5)->get();
            $response = [
                "status" => "true",
                "topstores" => count($data['topstores']),
                "success_message" => "success"
            ];
            return response()->json($response);
        }
        else{
            return response()->json("no");
        }
    }
}
