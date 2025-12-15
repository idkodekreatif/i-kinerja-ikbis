<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/impersonate/stop', function () {
    $user = auth()->user();

    if ($user && method_exists($user, 'stopImpersonating')) {
        // Tambahkan flash message
        session()->flash('impersonate_stopped', true);

        return $user->stopImpersonating();
    }

    return redirect('/kpi-control-center');
})->name('impersonate.stop')->middleware(['web', 'auth']);

// Route untuk cek status impersonate (optional)
Route::get('/impersonate/status', function () {
    return response()->json([
        'is_impersonated' => auth()->check() && auth()->user()->isImpersonated(),
        'user_id' => auth()->id(),
        'user_name' => auth()->user()->name ?? null,
    ]);
})->middleware(['web', 'auth']);
