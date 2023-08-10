<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
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

    public function show()
    {
        $events = Event::all();

        return view('front.events', compact('events'));
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
