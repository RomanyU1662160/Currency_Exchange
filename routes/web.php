<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('home');
});


Route::get("/rates/{base}", "CurrencyController@getRates")->name("rates");


Auth::routes();
