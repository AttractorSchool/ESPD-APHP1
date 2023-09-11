<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\Review;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $reviews = Review::with('user')->get();
        $users = User::all();
        $subscriptions = Subscription::all();
        $calendar = Calendar::all()->first();

        return view('home',compact('reviews', 'users', 'subscriptions', 'calendar'));
    }
}
