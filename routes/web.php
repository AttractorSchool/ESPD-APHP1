<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Front\FormController;
use App\Http\Controllers\Front\PageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/residents', [PageController::class, 'residents'])->name('residents');
Route::post('/form', [FormController::class, 'store'])->name('front.form');
Route::post('/connect', [ActionController::class, 'connect'])->name('connect');

Route::post('/message', [ChatController::class, 'send'])->name('chat.send');
Route::get('/message/{id}', [ChatController::class, 'show'])->name('chat.show');
Route::get('/messages/{id}', [ChatController::class, 'showBlade'])->name('show');

Route::get('/refresh/{model}', [ActionController::class, 'update'])->name('refresh');
Route::post('/confirm', [ActionController::class, 'confirm'])->name('confirm');

Auth::routes();

