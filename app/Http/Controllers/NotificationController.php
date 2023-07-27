<?php

namespace App\Http\Controllers;

use App\Mail\FeedbackMail;
use App\Models\CustomNotification;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Mail;

class NotificationController extends Controller
{

    public function send(CustomNotification $notification): Application|RedirectResponse|Redirector
    {
        if ($notification->type == 1) {
            $data['name'] = $notification->user->name;
            $data['type'] = $notification->type;
            $data['email'] = $notification->user->email;
            $data['sender'] = $notification->sender;

            Mail::to($notification->user->email)->send(new FeedbackMail($data));
            return redirect()->back()->with('status', 'Вы успешно отправили запрос на подключение пользователю.');
        } elseif ($notification->type == 2) {
            $data['name'] = $notification->user->name;
            $data['type'] = $notification->type;
            $data['title'] = $notification->title;
            $data['email'] = $notification->user->email;
            $data['body'] = $notification->body;

            Mail::to($notification->user->email)->send(new FeedbackMail($data));
            return redirect()->back()->with('status', 'Вы успешно отправили уведомление');
        }

        return redirect()->back()->with('status', 'Ошибка письмо не отправилось');
    }
}
