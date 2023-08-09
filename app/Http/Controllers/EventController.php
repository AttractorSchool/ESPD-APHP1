<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $events = Event::all();

        return  view ('front.events.events',compact('events'));
    }

    public function show(): View
    {

    }
}
