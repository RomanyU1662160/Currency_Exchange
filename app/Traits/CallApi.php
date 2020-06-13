<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

/**
 * All  Methods dealing with the API
 */
trait CallApi
{

    public  function getRates($base)
    {
        // $response = Http::get('https://gbp.fxexchangerate.com/rss.xml');
        $response = Http::get("http://www.floatrates.com/daily/$base.xml");
        //dd($response->body());

        $body = $response->body();

        $xml = simplexml_load_string($body, 'SimpleXMLElement', LIBXML_NOCDATA);

        $json = json_encode($xml);   //convert Xml to json
        //dd($json);

        $array = json_decode($json, true);
        //dd($array['item']);

        return  $collection = collect($array['item']);
        // return view('test.index', compact('collection'));
    }
}
