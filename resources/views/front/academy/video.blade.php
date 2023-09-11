    <link rel="stylesheet" href="https://cdn.plyr.io/3.5.6/plyr.css" />
    <script src="https://cdn.plyr.io/3.5.6/plyr.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const player = Plyr.setup('.js-player');
        });
    </script>
@extends('layouts.app')

@section('content')
    <a class="back" href="{{ route('course', ['course' => $video->course]) }}"> < Back </a>
    <h1>{{$video->name}}</h1>
    @if (!is_null($video->attachment->first()))
        <video class="js-player" controls preload>
            <source src="{{ asset('storage/' . $video->attachment->first()->path . $video->attachment->first()->name . '.' . $video->attachment->first()->extension)}}" type="video/mp4">
        </video>
    @else
        <video class="js-player" controls preload>
            <source src="{{ asset('upload') }}/{{$video->video}}" type="video/mp4">
        </video>
    @endif

    <div class="tests">
        <a href="{{route('academy.test', ['video' => $video])}}" class="test">Пройти тест></a>
    </div>
@endsection
