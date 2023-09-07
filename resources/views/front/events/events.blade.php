@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 d-flex align-items-center">
                <a href="{{ route('events_main') }}" class="arrow">
                    <i class="fa fa-arrow-left custom-arrow" style="color: #000"></i>
                </a>
                <p class="events-text">Все мероприятия</p>
            </div>
            <div class="calendar-btn">
                <a class="calendar-link" href="{{route('events.upcoming')}}"><p class="calendar-info">Календарь мероприятий</p></a>
            </div>
            @foreach($events as $event)
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="event-card">
                            <div class="row no-gutters">
                                <div class="col-4">
                                    <div class="card-img-container">
                                        @if (isset($event, $event->picture))
                                                @if (strpos($event->picture, 'storage') !== false)
                                                <a href="{{ route('events.show', ['id' => $event->id]) }}">
                                                    <img class="card-img-top" src="{{asset($event->picture)}}" alt="course_picture">
                                                </a>
                                                @else
                                                <a href="{{ route('events.show', ['id' => $event->id]) }}">
                                                    <img class="card-img-top" src="{{asset('/storage/' . $event->picture)}}" alt="{{$event->picture}}">
                                                </a>
                                            @endif
                                        @else
                                            <a href="{{ route('events.show', ['id' => $event->id]) }}">
                                                <img src="placeholder.jpg" class="card-img" alt="Placeholder Image" style="width: 100px; height: 100px;">
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="d-flex align-items-start">
                                        <div>
                                            <a href="{{ route('events.show', ['id' => $event->id]) }}">
                                            <h5 class="date-text">{{ $event->date }}</h5>
                                            </a>
                                            <p class="description-text">{{ $event->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
