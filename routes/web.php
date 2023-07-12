<?php

use App\Http\Controllers\ActionController;
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
Route::put('/connect_final/{response}/{notification}', [ActionController::class, 'connect_final'])->name('connect_final');

Route::get('/network', [PageController::class, 'networking'])->name('networking');

Route::get('/notification', [PageController::class, 'notifications'])->name('notifications');
Route::delete('/notification/{notification}', [PageController::class, 'delete_notification'])->name('delete_notification');

Auth::routes();

