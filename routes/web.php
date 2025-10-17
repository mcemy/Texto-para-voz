<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TextToSpeechController;

Route::get('/', [TextToSpeechController::class, 'index'])->name('home');
Route::post('/convert', [TextToSpeechController::class, 'convert'])->name('convert');
