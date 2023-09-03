<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\CustomNotification;
use App\Models\User;
use App\Models\Interest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MentorController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $topMentors = User::whereHas('roles', function ($query) {
            $query->where('name', 'mentor');
        })
            ->withAvg('ratings', 'rating')
            ->with('interests')
            ->orderByDesc('ratings_avg_rating')
            ->take(2)
            ->get();

        $recommendedMentors = [];

        if (Auth::check()) {
            $userInterests = Auth::user()->interests->pluck('id')->toArray();

            if (!empty($userInterests)) {
                $recommendedMentors = User::whereHas('roles', function ($query) {
                    $query->where('name', 'mentor');
                })
                    ->whereHas('interests', function ($query) use ($userInterests) {
                        $query->whereIn('interests.id', $userInterests);
                    })
                    ->whereNotIn('id', $topMentors->pluck('id')->toArray())
                    ->withAvg('ratings', 'rating')
                    ->with('interests')
                    ->take(2)
                    ->get();
            }
        }

        return view('front.mentorship.mentorship', compact('topMentors', 'recommendedMentors'));
    }

    /**
     * @param $id
     * @return View
     */
    public function show($id): View
    {
        $mentor = User::where('id', $id)
            ->with('ratings')
            ->withAvg('ratings', 'rating')
            ->first();

        $cities = City::all();
        $notifications = CustomNotification::all();

        return view('front.mentorship.show-mentor', compact('mentor', 'cities', 'notifications'));
    }

    /**
     * @return View
     */
    public function showAllMentors(): View
    {
        $mentors = User::whereHas('roles', function ($query) {
            $query->where('name', 'mentor');
        })->withAvg('ratings', 'rating')
            ->with('interests')
            ->orderByDesc('ratings_avg_rating')
            ->paginate();

        $cities = City::all();

        return view('front.mentorship.mentors', compact('mentors', 'cities'));
    }


    /**
     * @return View
     */
    public function mentorshipTest(): View
    {
        $interests = Interest::all();

        return view('front.mentorship.test', compact('interests'));
    }

    /**
     * @param Request $request
     * @return View
     */
    public function mentorshipResult(Request $request): View
    {
        $user = $request->user();

        $interest = Interest::find($request->input('interest'));

        $mentors = User::whereHas('roles', function ($query) {
            $query->where('name', 'mentor');
        })->whereHas('interests', function ($query) use ($interest) {
            $query->where('interests.id', $interest->id);
        })->get();

        $selectedMentor = $mentors->random();

        return view('front.mentorship.result', compact('selectedMentor', 'interest'));
    }
}
