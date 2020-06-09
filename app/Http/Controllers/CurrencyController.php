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
        $base = $api->getSelectedCurrency($data['from']);
        $target = $api->getSelectedCurrency($data['to']);
        $result = $this->calculate($base, $data['amount']);
        return view('form/index', compact(['base', 'target', 'result']));
    }

    private function calculate($base, $amount)
    {
        $rate = $base['exchangeRate'];
        $value = $amount * $rate;
        return $value;
    }
}
