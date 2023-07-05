<?php

namespace App\Http\Controllers;

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
        $agent = new Agent();
        $isMobile = $agent->isMobile();
        $reviews = Review::with('user')->get();
        $users = User::all();
        $subscriptions = Subscription::all();

        return view('home', compact('isMobile', 'reviews', 'users', 'subscriptions'));
    }
}
