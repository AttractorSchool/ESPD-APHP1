<?php

namespace App\Http\Controllers;

use App\Http\Form\ProfileForm;
use App\Models\Interest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $interests = Interest::all();

        return view('front/profile', compact('user', 'interests'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user->fill([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'country' => $request->input('country'),
            'city' => $request->input('city'),
            'phone' => $request->input('phone'),
            'description' => $request->input('description'),
        ]);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $path = $file->store('pictures', 'public');
            $user->avatar = $path;
        }
        $user->save();

        return redirect()->route('home')->with('status', "Profile successfully updated!");
    }
}
