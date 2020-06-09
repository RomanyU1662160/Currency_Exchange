<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestApiController extends Controller
{

    public function getRates()
    {
        //$response = Http::get('https://gbp.fxexchangerate.com/rss.xml');
        $response = Http::get('http://www.floatrates.com/daily/gbp.xml');
        //dd($response->body());

        $body = $response->body();

        $xml = simplexml_load_string($body, 'SimpleXMLElement', LIBXML_NOCDATA);
        $json = json_encode($xml);   //convert Xml to json

        // dd($json);
        $array = json_decode($json, true);
        // dd($array['item']);
        $collection = collect($array['item']);

        //dd($collection);
        return view('test.index', compact('collection'));
    }
}
