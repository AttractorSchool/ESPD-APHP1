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
    @else
        @if($favourite->course_id)
            <a href="{{{ route('events.show', ['id' => $favourite->course->id]) }}}">
                <div class="mentor_favourite">
                    <div class="favourite-img" style="width: 100px">
                        <img class="mentor-photo" style="margin-left: 20px" src="{{ asset('storage/' . $favourite->course->photo) }}" alt="course-photo">
                    </div>
                    <div class="mentor-favourite-text">
                        <p style="color: black">{{ $favourite->course->name }}</p>
                    </div>
                </div>
            </a>
        @endif
    @endif
@endforeach
@endsection
