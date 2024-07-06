<?php

use App\Http\Controllers\Guest\Welcome;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Profiles\ProfileController;
use App\Http\Controllers\Dashboard\Dashboard;

Route::get('/', [Welcome::class, 'index'])->name('welcome');

Route::get('/dashboard', [Dashboard::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/chakra', function () {
    return Inertia::render('Chakra');
})->name('chakra');


Route::get('/chatbot', function () {
    return Inertia::render('Chatbot/Chatbot');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
