<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/impersonate/stop', function () {
    return auth()->user()->stopImpersonating();
})->middleware('auth')->name('impersonate.stop');
