<?php

namespace App\Http\Controllers;

use App\Models\Response;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function send(Request $request)
    {
        $message = new Message();
        $message->body = $request['body'];
        $message->response_id = $request['response_id'];
        $message->user_id = auth()->user()->id;
        $message->save();

        return response()->json($message);
    }

    public function show($id)
    {
        $response = Response::find($id);
        if ($response) {
            return response()->json($response->messages);
        }
        return back()->with(['status' => 'error']);
    }
    public function showBlade($id)
    {
        $response = Response::find($id);

        return view('front.chat', compact('response'));
    }
}

