<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Notification;
use App\Models\Response;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Contracts\View\View;
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
        $notifications = Notification::all();
        return view('front.mainNetwork', compact('recommendedUsers', 'cities', 'notifications'));
    }
    public function allResidents(Request $request): View
    {
        $users = User::all();
        $cities = City::all();
        $notifications = Notification::all();
        return view('partials.residents', compact('users', 'cities', 'notifications'));
    }


    /**
     * @return View
     */
    public function notifications(): View
    {
        $notifications = auth()->user()->notifications;

        return view('front.notification', compact('notifications'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
