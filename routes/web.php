<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    return view('welcome');

    //return $lists;
});

Route::post('/home', 'TradingAccountController@createTradingAccount');

Route::get('/home', function () {
    $lists = ShareMarketGame\Share::all();
    $lists2 = ShareMarketGame\TradingAccount::all();

    return view('home', compact('lists', 'lists2'));
    //return $lists;
});

Route::get('/nickname', function () {

    return view('nickname', compact('lists'));
    //return $lists;
});

Route::get('/reg-tradeaccount', function () {
    $lists = ShareMarketGame\Share::all();

    return view('tradeAccount', compact('lists'));
    //return $lists;
});

Route::get('/general-settings', function () {
    $lists = ShareMarketGame\Share::all();

    return view('settings', compact('lists'));
    //return $lists;
});

Route::get('/transfer', function () {
    $lists = ShareMarketGame\Share::all();

    return view('transfer', compact('lists'));
    //return $lists;
});

Route::get('/search', function () {
    $lists = ShareMarketGame\Share::all();

    return view('dashboard.search', compact('lists'));
    //return $lists;
});

Route::post('/buy', 'HoldingController@buyShares');

Auth::routes();
