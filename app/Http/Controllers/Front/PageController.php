<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Course;
use App\Models\CustomNotification;
use App\Models\Event;
use App\Models\Response;
use App\Models\Review;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserEvent;
use App\Models\Video;
use App\Models\VideoTestScore;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function residents()
    {
        $users = User::all();
        $subscriptions = Subscription::all();
        return view('front.residents', compact('users', 'subscriptions'));
    }
    /**
     * @return View
     */
    public function networking(Request $request): View
    {
        $recommendedUsers = [];

        $recommendedUsers = User::all();
        if (Auth::check()) {
            $userInterests = Auth::user()->interests->pluck('id')->toArray();

            if (!empty($userInterests)) {
                $recommendedUsers = User::whereHas('roles', function ($query) {
                    $query->where('name', 'resident');
                })
                    ->whereHas('interests', function ($query) use ($userInterests) {
                        $query->whereIn('interests.id', $userInterests);
                    })
                    ->with('interests')
                    ->take(2)
                    ->get();
            }
        }
        $cities = City::all();
        $notifications = CustomNotification::all();
        return view('front.mainNetwork', compact('recommendedUsers', 'cities', 'notifications'));
    }
    public function allResidents(Request $request): View
    {
        $users = User::all();
        $cities = City::all();
        $notifications = CustomNotification::all();
        return view('partials.residents', compact('users', 'cities', 'notifications'));
    }


    /**
     * @return View
     */
    public function notifications(): View
    {
        $notifications = auth()->user()->custom_notifications;

        return view('front.notification', compact('notifications'));
    }

    public function course(Course $course):View
    {
        $videos = Video::all();
        $videos = $videos->where('course_id', $course->id);

        $score =  VideoTestScore::all();

        return view('front.academy.course', compact('course',  'videos', 'score'));
    }
    public function video(Video $video)
    {
        return view('front.academy.video', compact('video'));
    }
    public function without_point():RedirectResponse
    {
        return redirect()->back()->with('status', 'Вы не прошли прошлый тест! Пройдите его что бы начать!');
    }
    //$city1 = null
    public function main_event($city = null)
    {
        if ($city){
            $cities = City::all();
            $city = City::find($city);


            return view('front.event.main_event', compact( 'cities', 'city'));
        }
            $city = City::first();
            $cities = City::all();

            return view('front.event.main_event', compact( 'cities', 'city'));
    }
}
