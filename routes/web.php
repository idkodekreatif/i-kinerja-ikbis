<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::post('/impersonate/stop', function () {
    abort_unless(auth()->check(), 403);
    return auth()->user()->stopImpersonating();
})->name('impersonate.stop');
