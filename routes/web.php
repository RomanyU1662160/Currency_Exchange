<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('home');
});

Route::get("/rates/{base}", "ApiController@getRates")->name("rates");
Route::get("/form", "CurrencyController@getForm")->name("getForm");
Route::post("/form", "CurrencyController@postForm");

Route::get("/rates/{base}/{target}/{amount}", "ApiController@calculate")->name("rates");
Route::get("/rates/reverse/{base}/{target}/{amount}", "ApiController@reverseCalculate")->name("rates");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
