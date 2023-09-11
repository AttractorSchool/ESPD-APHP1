<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Course;
use App\Models\CustomNotification;
use App\Models\Event;
use App\Models\Favourite;
use App\Models\Response;
use App\Models\Review;
use App\Models\Role;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserEvent;
use App\Models\UserRole;
use App\Models\Video;
use App\Models\VideoTestScore;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
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

        $login_user = auth()->user();
        $users_filtered= array();
        $users = User::all();

        foreach ($users as $user){
            if ($user->city === $login_user->city) {
                if ($user->name !== $login_user->name) {
                    if ($user->name !== 'admin') {
                        if (!$user->roles->isEmpty()) {
                            if (!($user->roles->first()->name === 'mentor')) {
                                $users_filtered[count($users_filtered) + 1] = $user;
                            }
                        } else {
                            $users_filtered[count($users_filtered) + 1] = $user;
                        }
                    }
                }
            }
        }



        return view('front.mainNetwork', compact('users_filtered'));
    }
    public function allResidents(): View
    {
        $login_user = auth()->user();
        $users_filtered= array();
        $users = User::paginate(8);

        foreach ($users as $user){
                if ($user->name !== $login_user->name) {
                    if ($user->name !== 'admin') {
                        if (!$user->roles->isEmpty()) {
                            if (!($user->roles->first()->name === 'mentor')) {
//                                $users_filtered[count($users_filtered) + 1] = $user;
                                $users->where('id', $user->id);
                            }
                        } else {
//                            $users_filtered[count($users_filtered) + 1] = $user;
                             $users->where('id', $user->id);
                        }
                    }
                }
            }

        $notifications = CustomNotification::all();
        return view('partials.residents', compact('users', 'notifications'));
    }


    /**
     * @return View
     */
    public function notifications(): View
    {
        $notifications = auth()->user()->custom_notifications;

        return view('front.notification', compact('notifications'));
    }

    public function delete_notification(CustomNotification $notification):RedirectResponse{
        $notification->delete();

        return redirect()->back();
    }

    /**
     * @param Course $course
     * @return View
     */
    public function course(Course $course):View
    {
        $videos = Video::all();
        $videos = $videos->where('course_id', $course->id);
        $score = VideoTestScore::where('user_id', Auth::id());

//        $score =  VideoTestScore::all();

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
    public function favourite()
    {
        $favourites = Auth::user()->favourites;
        return view('front.favourite.favourite', compact('favourites'));
    }
    public function save_favourite(Request $request):RedirectResponse
    {

            if ($request->input('events_id')){
                $favourite_event = Favourite::where('events_id', $request->input('events_id'))->where('user_id', Auth::id())->first();
                if ($favourite_event){
                    $favourite_event->delete();

                    return redirect()->back();
                }
            }elseif ($request->input('course_id')){
                $favourite_course = Favourite::where('course_id', $request->input('course_id'))->where('user_id', Auth::id())->first();
                if ($favourite_course){
                    $favourite_course->delete();

                    return redirect()->back();
                }
            }elseif ($request->input('mentor_id')){
                $favourite_mentor = Favourite::where('mentor_id', $request->input('mentor_id'))->where('user_id', Auth::id())->first();
                if ($favourite_mentor){
                    $favourite_mentor->delete();

                    return redirect()->back();
                }
            }

            $data = $request->all();

            $favourite = Favourite::create($data);


            return redirect()->back();
    }

}
