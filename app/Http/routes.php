<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get(
    '/',
    function () {
        return view('welcome');
    }
);
Route::get(
    '/welcome',
    function () {
        return view('welcome');
    }
);

Route::get('/random', 'Actions\Random\IndexAction@act');
Route::get('/bomb/{number?}', 'Actions\Bomb\IndexAction@act')->where(['name' => '[0-9]+']);
Route::get('/count', 'Actions\Count\IndexAction@act');
