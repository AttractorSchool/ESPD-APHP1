@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 d-flex align-items-center" style="height: 25px">
                <a href="{{ route('events.upcoming') }}" class="arrow">
                    <i class="fa fa-arrow-left custom-arrow" style="color: #000"></i>
                </a>
                <p class="calendar-text" style="color: #000; font-size: 24px">Calendar</p>
            </div>
        </div>
        <div class="calendar mt-3">
            <div class="calendar-header d-flex justify-content-center m-2">
                <a href="{{ route('events.calendar', ['year' => $prevMonthDate->year, 'month' => $prevMonthDate->month]) }}">
                    <i class="fas fa-chevron-left" style="margin-right: 25px; color: #000"></i>
                </a>
                <h3>{{ $monthName }} {{ $year }}</h3>
                <a href="{{ route('events.calendar', ['year' => $nextMonthDate->year, 'month' => $nextMonthDate->month]) }}">
                    <i class="fas fa-chevron-right" style="margin-left: 25px; color: #000"></i>
                </a>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th>Sun</th>
                    <th>Mon</th>
                    <th>Tue</th>
                    <th>Wed</th>
                    <th>Thu</th>
                    <th>Fri</th>
                    <th>Sat</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($days as $day)
                    @if ($loop->first)
                        <tr>
                            @endif
                            <td>
                                @if ($day['day'] !== null)
                                    <div class="day {{ $day['event'] ? 'event-day' : '' }}">
                                        <div class="day-number">{{ $day['day']->day }}</div>
                                        @if ($day['event'])
                                            <div class="event-dot"></div>
                                        @endif
                                    </div>
                                @endif
                            </td>
                            @if ($loop->iteration % 7 === 0)
                        </tr>
                        @if (!$loop->last)
                            <tr>
                                @endif
                                @endif
                                @if ($loop->last)
                                    @for ($i = 0; $i < 7 - $loop->iteration % 7; $i++)
                                        <td></td>
                                    @endfor
                            </tr>
                        @endif
                        @endforeach
                </tbody>
            </table>
        </div>

        <div class="events-list mt-3">
            @foreach ($upcomingEvents as $event)
                <div class="event-item">
                    <div class="event-image" style="background-color: {{ getRandomColor() }}">
                        @if (isset($event->picture))
                            <img src={{ asset('storage/' . $event->picture) }} alt="{{ $event->title }}">
                        @endif
                    </div>
                    <div class="event-details">
                        <div class="event-date">{{ \Carbon\Carbon::parse($event->date)->format('l, F d, Y') }}</div>
                        <div class="event-title">{{ $event->title }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@php
    function getRandomColor() {
        $colors = ['#FF5733', '#33FF57', '#5733FF', '#33B5FF', '#FF33B5'];
        return $colors[array_rand($colors)];
    }
@endphp
