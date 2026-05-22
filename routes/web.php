<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pasien/{id}/struk', function ($id) {
    $pasien = \App\Models\Pasien::findOrFail($id);
    return view('pasien.struk', compact('pasien'));
})->name('pasien.struk');

// Logout route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
