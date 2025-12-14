<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::post('/impersonate/stop', function () {
    $user = auth()->user();

    if ($user && method_exists($user, 'stopImpersonating')) {
        return $user->stopImpersonating();
    }

    return redirect('/kpi-control-center');
})->name('impersonate.stop')->middleware(['web', 'auth']);
