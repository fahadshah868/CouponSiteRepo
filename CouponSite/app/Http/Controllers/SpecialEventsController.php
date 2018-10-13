<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpecialEventsController extends Controller
{
    public function getSpecialEventsList(){
        $data['status'] = true;
        return response($data);
    }
}
