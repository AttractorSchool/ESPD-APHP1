<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\Interest;
use Illuminate\Http\Request;

class InterestController extends Controller
{
    public function index()
    {
        $interests = Interest::withCount('courses')->get();

        return view('front.academy.interests', compact('interests'));
    }

}

