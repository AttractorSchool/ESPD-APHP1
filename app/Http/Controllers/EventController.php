<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
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

    /**
     * @param $id
     * @return View
     */
    public function show($id): View
    {
        $event = Event::findOrFail($id);

        return view('front.events.event-show', compact('event'));
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function buyTicket($id): RedirectResponse
    {
        $event = Event::findOrFail($id);

        if ($event->quantity > 0) {
            $event->quantity -= 1;
            $event->save();

            return redirect()->route('events.show', ['id' => $id])->with('status', 'Билет успешно куплен.');
        } else {
            return redirect()->route('events.show', ['id' => $id])->with('status', 'Извините, билеты закончились.');
        }
    }
}
