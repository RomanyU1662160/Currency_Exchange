<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CurrencyController extends  Controller
{
    public function getForm()
    {
        return view('form.index');
    }

    public function postForm(Request $request)
    {
        $api = new ApiController();
        $data = $request->except('_token');

        $baseCollection = $api->getRates('GBP');

        $target = $api->getTargetCurrency($baseCollection, 'USD');

        $result = $this->calculate($target, 10);
        return $result;
        //return view('form.index', compact(['target', 'result']));
    }

    private function calculate($target, $amount)
    {

        $rate = $target['exchangeRate'];
        $value = $amount * $rate;
        return $value;
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
}
