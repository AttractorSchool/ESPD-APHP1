<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Front\FormController;
use App\Http\Controllers\Front\PageController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionsController;
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
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::post('/connect', [ActionController::class, 'connect'])->name('connect')->middleware('auth');
Route::put('/connect_final/{response}/{notification}', [ActionController::class, 'connect_final'])->name(
    'connect_final'
)->middleware('auth');

Route::get('/chat', [ChatController::class, 'chat'])->name('chat')->middleware('auth');

Route::post('/message', [ChatController::class, 'send'])->name('chat.send')->middleware('auth');
Route::get('/message/{id}', [ChatController::class, 'show'])->name('chat.show')->middleware('auth');
Route::get('/messages/{id}', [ChatController::class, 'showBlade'])->name('showChat')->middleware('auth');

Route::get('/network', [PageController::class, 'networking'])->name('networking')->middleware('auth');
Route::get('/allresidents', [PageController::class, 'allResidents'])->name('allResidents')->middleware('auth');


Route::get('/notification', [PageController::class, 'notifications'])->name('notifications')->middleware('auth');
Route::delete('/notification/{notification}', [PageController::class, 'delete_notification'])->name(
    'delete_notification'
);

Route::post('/connectToMentor', [ActionController::class, 'connectToMentor'])->name('connectToMentor');

Route::get('/mentorship', [MentorController::class, 'index'])->name('mentorship');
Route::get('/mentorship/test', [MentorController::class, 'mentorshipTest'])->name('mentorship.test');
Route::post('/mentorship/result', [MentorController::class, 'mentorshipResult'])->name('mentorship.result');
Route::get('/mentors', [MentorController::class, 'showAllMentors'])->name('mentors');
Route::get('/mentors/{id}', [MentorController::class, 'show'])
    ->name('mentors.show')
    ->middleware('register.guest');

Route::get('/notification/toEmail/{notification}', [\App\Http\Controllers\NotificationController::class, 'send'])->name(
    'notification.send'
);

Route::get('/subscriptions', [SubscriptionsController::class, 'index'])->name('subscriptions');
Route::post('/subscribe/{subscription}', [SubscriptionsController::class, 'subscribe'])->name('subscribe');


//http://127.0.0.1:8000/notification/toEmail/
Auth::routes();

