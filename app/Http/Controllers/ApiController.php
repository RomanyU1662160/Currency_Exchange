<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{



    public  function getSelectedCurrency($value)
    {
        $collection = $this->getRates();
        return  $baseCurrency = $collection->where('targetCurrency', $value)->first();
    }


    public function reverseCalculate($base, $target, $amount)
    {
        $collection = $this->getRates();
        // dd($collection);
        $baseCurrency = $collection->where('targetCurrency', $base)->first();
        $targetCurrency = $collection->where('targetCurrency', $target)->first();
        $rate = $baseCurrency['inverseRate'];
        $value = $amount * $rate;
        return view('form.index', compact(['baseCurrency', 'targetCurrency', 'rate', 'value']));
    }


    private function getRates()
    {
        //$response = Http::get('https://gbp.fxexchangerate.com/rss.xml');
        $response = Http::get('http://www.floatrates.com/daily/gbp.xml');
        //dd($response->body());


        $body = $response->body();

        $xml = simplexml_load_string($body, 'SimpleXMLElement', LIBXML_NOCDATA);

        $json = json_encode($xml);   //convert Xml to json

        //dd($json);
        $array = json_decode($json, true);
        //dd($array['item']);


        return   $collection = collect($array['item']);

        //dd($collection);

    }
}
