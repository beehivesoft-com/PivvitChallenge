<?php

use Illuminate\Http\Request;

Route::get('offerings', 'OfferingsController@index');

Route::resource('/purchases', 'PurchasesController', ['only' => [
    'index', 'store'
]]);