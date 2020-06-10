<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{



    public  function getTargetCurrency($baseCurrencyCollection, $target)
    {
        $targetCurrency = $baseCurrencyCollection->where('targetCurrency', $target)->first();

        return $targetCurrency;
    }


    public function reverseCalculate($base, $target, $amount)
    {
        $collection = $this->getRates($base);
        // dd($collection);
        $baseCurrency = $collection->where('targetCurrency', $base)->first();
        $targetCurrency = $collection->where('targetCurrency', $target)->first();
        $rate = $baseCurrency['inverseRate'];
        $value = $amount * $rate;
        return view('form.index', compact(['baseCurrency', 'targetCurrency', 'rate', 'value']));
    }


    public  function getRates($base = "gbp")
    {
        //$response = Http::get('https://gbp.fxexchangerate.com/rss.xml');
        $response = Http::get("http://www.floatrates.com/daily/$base.xml");
        //dd($response->body());


        $body = $response->body();

        $xml = simplexml_load_string($body, 'SimpleXMLElement', LIBXML_NOCDATA);

        $json = json_encode($xml);   //convert Xml to json

        //dd($json);
        $array = json_decode($json, true);
        //dd($array['item']);


        return $collection = collect($array['item']);
        // return view('test.index', compact('collection'));
    }
}
