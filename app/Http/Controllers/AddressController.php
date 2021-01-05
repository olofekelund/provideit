<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AddressController extends Controller
{
    public function createRoute(Request $request) {
        $fromAddress = $request->input('fromAddress');
        $toAddress = $request->input('toAddress');

        $data = Http::get('https://route.ls.hereapi.com/routing/7.2/calculateroute.json?' .
            'apiKey=J389zkI0yqfQGnyqnrcTzqYkjeRgiAOHGwXW0GEr_CQ' .
            '&mode=fastest;car;' .
            '&waypoint0=geo!' . $fromAddress['lat'] . ',' . $fromAddress['lng'] .
            '&waypoint1=geo!' . $toAddress['lat'] . ',' . $toAddress['lng'] .
            '&departure=2014-03-12T10:00:00' .
            '&routeattributes=sh,bb,gr');

        return response($data)->header('Content-Type', 'application/json');
    }

    public function autocomplete(Request $request)
    {
        $data = Http::get('https://geocode.search.hereapi.com/v1/geocode?q=' . $request->address . '&apiKey=J389zkI0yqfQGnyqnrcTzqYkjeRgiAOHGwXW0GEr_CQ');

        return response($data)->header('Content-Type', 'application/json');
    }
}
