<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConnectRequest;
use App\Models\Notification;
use App\Models\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActionController extends Controller
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
            $notification = new Notification();
            $notification->first_id = Auth::id();
            $notification->user_id  = $request->input('second_id');
            $notification->save();

            $newResponse = new Response();
            $newResponse->first_id = $authenticatedUserId;
            $newResponse->second_id = $secondUserId;
            $newResponse->confirm_first = true;
            $newResponse->save();

            return redirect()->back()->with('status', 'Вы успешно отправили запрос на подключение пользователю.');
        }

        return redirect()->route('login')->with('status', 'You are not logged in.');
    }

    public function connect_final(Request $request, Response $response, Notification $notification)
    {
        $response->confirm_second = $request->input('confirm_second');

        $response->update();

        $notification->delete();

        return redirect()->route('showChat', ['id' => $response->id]);
    }
    public function delete_notification(Notification $notification){
        $notification->delete();

        return redirect()->back()->with('status', 'You are delete notification');
    }
}
