<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConnectRequest;
use App\Models\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    /**
     * @param ConnectRequest $request
     * @return RedirectResponse
     */
    public function connect(ConnectRequest $request): RedirectResponse
    {
        $authenticatedUser = auth()->user();
        $secondUserId = $request->input('user_id');

        $response = Response::whereIn('first_id', [$authenticatedUser->id, $secondUserId])
            ->whereIn('second_id', [$authenticatedUser->id, $secondUserId])
            ->first();

        if ($response) {
            if ($response->first_id == $authenticatedUser->id && !$response->confirm_first) {
                $response->confirm_first = true;
                $response->save();
                return back()->with(['status' => 'В обработке']);
            }

            if ($response->second_id == $authenticatedUser->id && !$response->confirm_second) {
                $response->confirm_second = true;
                $response->save();
                return back()->with(['status' => 'В обработке']);
            }

            return back()->with(['status' => 'Вы уже подтвердили подключение.']);
        }

        $response = new Response();
        $response->first_id = $authenticatedUser->id;
        $response->second_id = $secondUserId;
        $response->confirm_first = true;
        $response->save();

        return back()->with(['status' => 'Вы успешно отправили приглашение для перехода в чат.']);
    }

}
