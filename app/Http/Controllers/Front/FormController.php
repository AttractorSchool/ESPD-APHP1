<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\FormClient;
use App\Models\Photograph;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FormController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $formClient = new FormClient();
        $formClient->name = $request->input('name');
        $formClient->email = $request->input('email');
        $formClient->message = $request->input('message');
        $formClient->save();

        return back();
    }
}
