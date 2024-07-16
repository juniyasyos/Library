<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Chatbot\Chatbot;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/chatbot', [Chatbot::class, 'sendMessage'])->middleware('auth:sanctum');
