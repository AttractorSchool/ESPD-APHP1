<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Video;
use App\Models\VideoTestScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function test(Video $video)
    {
        return view('front.course.test', compact('video'));
    }

    public function countPoints(Request $request)
    {
        $point = 0;
        $user = Auth::user();
        $video = Video::find($request['video']);

        for ($i = 0; $i < count($video->questions); $i++) {
            $answer = Answer::find($request['question' . $i]);

            if ($answer != null) {
                if ($answer->boolean) {
                    $point++;
                }
            }
        }

        $score = new VideoTestScore();
        $score->user_id = $user->id;
        $score->video_id = $video->id;
        $score->score = $point;
        $score->save();

        return redirect()->route('academy.test.result', compact('score'));
    }

    public function skipTest(Video $video)
    {
        $score = new VideoTestScore();
        $score->user_id = Auth::user()->id;
        $score->video_id = $video->id;
        $score->score = 0;
        $score->save();

        //        Заменить роут куда нужно переслать пользователя
        return back();
    }

    public function result(VideoTestScore $score)
    {
        return view('front.course.result', compact('score'));
    }
}
