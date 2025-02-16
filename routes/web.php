<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EventController;
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
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show')->middleware('auth');
Route::get('/profile_edit', [ProfileController::class, 'edit'])->name('edit_profile')->middleware('auth');
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


Route::get('/events', [EventController::class, 'index'])->name('events')->middleware('auth');
Route::get('/events/upcoming', [EventController::class, 'filterEvents'])->name('events.upcoming')->middleware('auth');
Route::get('/events/calendar', [EventController::class, 'calendar'])->name('events.calendar')->middleware('auth');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
Route::get('/events/{id}/buy', [EventController::class, 'buyTicket'])->name('buy-ticket')->middleware('auth');


Route::get('/notification', [PageController::class, 'notifications'])->name('notifications')->middleware('auth');
Route::delete('/notification/{notification}', [PageController::class, 'delete_notification'])->name(
    'delete_notification'
);

Route::post('/connectToMentor', [ActionController::class, 'connectToMentor'])->name('connectToMentor');

Route::get('/mentorship', [MentorController::class, 'index'])->name('mentorship')->middleware('auth');
Route::get('/mentorship/test', [MentorController::class, 'mentorshipTest'])->name('mentorship.test')->middleware(
    'auth'
);
Route::post('/mentorship/result', [MentorController::class, 'mentorshipResult'])->name('mentorship.result')->middleware(
    'auth'
);
Route::get('/mentors', [MentorController::class, 'showAllMentors'])->name('mentors');
Route::get('/mentors/{id}', [MentorController::class, 'show'])
    ->name('mentors.show')
    ->middleware('auth');

Route::get('/notification/toEmail/{notification}', [\App\Http\Controllers\NotificationController::class, 'send'])->name(
    'notification.send'
);

Route::get('/subscriptions', [SubscriptionsController::class, 'index'])->name('subscriptions');
Route::get('/subscriptions/payment', [SubscriptionsController::class, 'showCardForm'])->name('payment');
Route::post('/subscribe', [SubscriptionsController::class, 'subscribe'])
    ->name('subscribe')
    ->middleware('auth');


Route::post('/academy', [\App\Http\Controllers\CourseController::class, 'countPoints'])->name('academy.countPoints');
Route::get('/academy/{video}', [\App\Http\Controllers\CourseController::class, 'test'])->name('academy.test');
Route::get('/academy/result/{score}', [\App\Http\Controllers\CourseController::class, 'result'])->name(
    'academy.test.result'
);
Route::get('/interests', [\App\Http\Controllers\InterestController::class, 'index'])->name('academy');
Route::get('/filtered-courses', [\App\Http\Controllers\CourseController::class, 'showFilteredCourses'])->name(
    'filtered.courses'
);
Route::get('/courses/{id}', [\App\Http\Controllers\CourseController::class, 'show'])->name('show.course');
Route::get('/comments/{id}', [\App\Http\Controllers\CourseController::class, 'showAllComments'])->name('show.comments');

Route::delete('/academy/{video}', [\App\Http\Controllers\CourseController::class, 'skipTest'])->name(
    'academy.skipTest'
);
Route::get('/courses/{course}/main', [PageController::class, 'course'])->name('course');
Route::get('/videos/{video}', [PageController::class, 'video'])->name('video');
Route::get('course_without_pint', [PageController::class, 'without_point'])->name('without_point');

Route::post('comments', [ActionController::class, 'comments'])->name('comment_add');

//События
Route::get('/events_main/{city?}', [PageController::class, 'main_event'])->name('events_main')->middleware('auth');

//Избранное
Route::get('/favourite', [PageController::class, 'favourite'])->name('favourite');
Route::post('/favourite', [PageController::class, 'save_favourite'])->name('favourite.save');
//http://127.0.0.1:8000/notification/toEmail/
Auth::routes();

