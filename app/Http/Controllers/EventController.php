<?php

namespace App\Http\Controllers;

use App\Models\CustomNotification;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
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
        $notifications = CustomNotification::all();


        return view('front.events.event-show', compact('event', 'notifications'));
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

    public function showEvents()
    {
        $events = Event::all();

        return view('front.events', compact('events'));
    }

    public function filterEvents(Request $request)
    {
        $filter = $request->input('filter', 'upcoming');

        if ($filter === 'upcoming') {
            $events = Event::where('date', '>', now())->get();
        } elseif ($filter === 'past') {
            $events = Event::where('date', '<', now())->get();
        } else {
            $events = Event::all();
        }

        return view('front.eventsUpcoming', compact('events', 'filter'));
    }

    public function calendar(Request $request)
    {
        $today = Carbon::today();
        $year = $request->input('year', $today->year);
        $month = $request->input('month', $today->month);

        $firstDay = Carbon::createFromDate($year, $month, 1);
        $lastDay = $firstDay->copy()->endOfMonth();

        $events = Event::whereBetween('date', [$firstDay, $lastDay])->get();

        $monthName = $firstDay->formatLocalized('%B');
        $prevMonthDate = $firstDay->copy()->subMonth();
        $nextMonthDate = $firstDay->copy()->addMonth();

        $days = [];

        $currentDay = $firstDay->copy()->startOfWeek();

        while ($currentDay <= $lastDay) {
            $days[] = [
                'day' => $currentDay->day <= $lastDay->day ? $currentDay->copy() : null,
                'event' => $events->contains('date', $currentDay),
            ];
            $currentDay->addDay();
        }

        $upcomingEvents = Event::whereBetween('date', [$today, $lastDay])
            ->orderBy('date')
            ->get();

        return view('front.calendar', compact(
            'year', 'month', 'monthName', 'prevMonthDate', 'nextMonthDate', 'days', 'upcomingEvents'
        ));
    }
}
