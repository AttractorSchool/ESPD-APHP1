<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Response;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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
    public function networking(): View
    {
        $users = User::paginate(9);

        $notifications = Notification::all();
        return view('front.mainNetwork', compact('users', 'notifications'));
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
