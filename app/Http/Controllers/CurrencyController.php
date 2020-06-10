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
        $baseCollection = $api->getRates($data['from']);

        $target = $api->getTargetCurrency($baseCollection, $data['to']);

        $result = $this->calculate($target, $data['amount']);
        return view('form/index', compact(['target', 'result']));
    }

    private function calculate($target, $amount)
    {

        $rate = $target['exchangeRate'];
        $value = $amount * $rate;
        return $value;
    }
}
