@vite('resources/sass/favourite.css')
@extends('layouts.app')
@section('content')
@foreach($favourites as $favourite)
    @if($favourite->mentor_id)
        <a href="{{ route('mentors.show', ['id' => $favourite->mentor->id]) }}"><div class="mentor_favourite">
                <div class="favourite-img" style="width: 100px">
                    <img class="mentor-photo" src="{{ asset('storage/' . $favourite->mentor->avatar) }}" alt="mentor-photo">
                </div>
            <div class="mentor-favourite-text">
                <p style="color: black">{{ $favourite->mentor->name }}</p>
            </div>
        </div>
        </a>
    @elseif($favourite->course_id)
            <a href="{{{ route('show.course', ['id' => $favourite->course->id]) }}}">
                <div class="mentor_favourite">
                    <div class="favourite-img" style="width: 100px">
                        <img class="mentor-photo" style="margin-left: 20px" src="{{ asset('storage/' . $favourite->course->photo) }}" alt="course-photo">
                    </div>
                    <div class="mentor-favourite-text">
                        <p style="color: black">{{ $favourite->course->name }}</p>
                    </div>
                </div>
            </a>

    @elseif($favourite->events_id)
        @php($event = \App\Models\Event::where('id', $favourite->events_id)->first())
            <a href="{{{ route('events.show', ['id' => $favourite->events_id]) }}}">
                <div class="mentor_favourite">
                    <div class="favourite-img" style="width: 100px">
                        @if ($event->picture !== null)
                            @if (strpos($event->picture, 'storage') !== false)
                                <img class="mentor-photo" style="margin-left: 20px" src="{{asset($event->picture)}}" alt="course_picture">
                            @else
                                <img class="mentor-photo" style="margin-left: 20px" src="{{asset('/storage/' . $event->picture)}}" alt="{{$event->picture}}">
                            @endif
                        @else
                            <img class="mentor-photo" style="margin-left: 20px" src='https://i.pinimg.com/originals/9a/7c/6c/9a7c6c2c028e05473faf627ac33cef94.jpg' width='100' height='100'>
                        @endif
                    </div>
                    <div class="mentor-favourite-text">
                        <p style="color: black">{{ $event->title }}</p>
                    </div>
                </div>
            </a>
    @endif
@endforeach
@endsection
