<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConnectRequest;
use App\Models\Comment;
use App\Models\CustomNotification;
use App\Models\Response;
use App\Models\Review;
use App\Models\SessionBooking;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class   ActionController extends Controller
{
    /**
     * @param ConnectRequest $request
     * @return RedirectResponse
     */
    public function connect(ConnectRequest $request): RedirectResponse
    {
        if (Auth::check()) {
            $authenticatedUserId = Auth::id();
            $secondUserId = $request->input('second_id');

            if ($authenticatedUserId == $secondUserId) {
                return redirect()->back()->with('status', 'Вы не можете отправить запрос на подключение самому себе!');
            }

            $response = Response::where('first_id', $authenticatedUserId)
                ->where('second_id', $secondUserId)
                ->first();

            if ($response) {
                $isFirstUser = $response->first_id == $authenticatedUserId;
                $isSecondUser = $response->second_id == $authenticatedUserId;

                if (($isFirstUser && !$response->confirm_first) || ($isSecondUser && !$response->confirm_second)) {
                    if ($isFirstUser) {
                        $response->confirm_first = true;
                    } else {
                        $response->confirm_second = true;
                    }

                    $response->save();
                    return redirect()->back()->with('status', 'В обработке');
                }

                return redirect()->back()->with('status', 'Вы уже подтвердили подключение.');
            }
            $notification = new CustomNotification();
            $notification->sender_id = Auth::user()->id;
            $notification->user_id = $request->input('second_id');
            $notification->type = 1;
            $notification->save();

            $newResponse = new Response();
            $newResponse->first_id = $authenticatedUserId;
            $newResponse->second_id = $secondUserId;
            $newResponse->confirm_first = true;
            $newResponse->save();

//            return redirect()->back()->with('status', 'Вы успешно отправили запрос на подключение пользователю.');
            return redirect()->route('notification.send', compact('notification'))->with(
                'status',
                'Вы успешно отправили запрос на подключение пользователю.'
            );
        }

        return redirect()->route('login')->with('status', 'You are not logged in.');
    }

    /**
     * @param ConnectRequest $request
     * @return RedirectResponse
     */
    public function connectToMentor(ConnectRequest $request): RedirectResponse
    {
        if (Auth::check()) {
            $authenticatedUserId = Auth::id();
            $secondUserId = $request->input('second_id');

            if ($authenticatedUserId == $secondUserId) {
                return redirect()->back()->with('status', 'Вы не можете отправить запрос на подключение самому себе!');
            }

            if (!$this->canBookSession($secondUserId)) {
                return redirect()->back()->with(
                    'status',
                    'Вы не можете забронировать сессию, т.к. уже забронирована сессия с ментором.'
                );
            }

            $response = Response::where('first_id', $authenticatedUserId)
                ->where('second_id', $secondUserId)
                ->first();

            if ($response) {
                $isFirstUser = $response->first_id == $authenticatedUserId;
                $isSecondUser = $response->second_id == $authenticatedUserId;

                if (($isFirstUser && !$response->confirm_first) || ($isSecondUser && !$response->confirm_second)) {
                    if ($isFirstUser) {
                        $response->confirm_first = true;
                    } else {
                        $response->confirm_second = true;
                    }

                    $response->save();
                    return redirect()->back()->with('status', 'В обработке');
                }

                return redirect()->back()->with('status', 'Вы уже подтвердили подключение.');
            }

            $notification = new CustomNotification();
            $notification->sender_id = Auth::user()->id;
            $notification->user_id = $request->input('second_id');
            $notification->type = 1;
            $notification->save();

            $newResponse = new Response();
            $newResponse->first_id = $authenticatedUserId;
            $newResponse->second_id = $secondUserId;
            $newResponse->confirm_first = true;
            $newResponse->save();

            Auth::user()->update(['last_booking_date' => Carbon::now()]);

            return redirect()->back()->with('status', 'Вы успешно забронировали сессию у ментора.');
        }

        return redirect()->route('login')->with('status', 'You are not logged in.');
    }

    public function connect_final(Request $request, Response $response, CustomNotification $notification)
    {
        $response->confirm_second = $request->input('confirm_second');

        $response->update();

        $notification->delete();

        return redirect()->route('showChat', ['id' => $response->id]);
    }

    public function delete_notification(CustomNotification $notification)
    {
        $notification->delete();

        return redirect()->back()->with('status', 'You are delete notification');
    }

    /**
     * @param int $userId
     * @return bool
     */
    private function canBookSession(int $userId): bool
    {
        $lastBookingDate = Auth::user()->last_booking_date;
        if ($lastBookingDate && Carbon::now()->diffInMonths($lastBookingDate) < 1) {
            return false;
        }

        $existingBooking = SessionBooking::where('user_id', Auth::id())
            ->where('mentor_id', $userId)
            ->whereIn('status', ['requested', 'booked'])
            ->exists();

        if ($existingBooking) {
            return false;
        }

        return true;
    }

    public function comments(Request $request):RedirectResponse
    {
        $comment_exsts = Comment::where('course_id', $request->input('course_id'))->where('author_id', Auth::id());
        $request->validate([
            'body'  => 'required|min:5|max:128',
        ]);

        if ($comment_exsts->first()){
            $comment_exsts->update($request->except('_token'));

        }else{
            $comment = new Comment();
            if ($request->input('rating')){
                $comment->rating    = $request->input('rating');
            }
            $comment->body      = $request->input('body');
            $comment->author_id = Auth::id();
            $comment->course_id = $request->input('course_id');
            $comment->save();
        }

        return redirect()->back()->with('status', 'Вы оставили отзыв');
    }
}
