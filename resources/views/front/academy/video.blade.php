    <link rel="stylesheet" href="https://cdn.plyr.io/3.5.6/plyr.css" />
    <script src="https://cdn.plyr.io/3.5.6/plyr.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const player = Plyr.setup('.js-player');
        });
    </script>
    @vite(['resources/sass/video.css'])
@extends('layouts.app')

@section('content')
    <a class="back" href="{{ route('course', ['course' => $video->course]) }}"> < Back </a>
    <h1>{{$video->name}}</h1>

    <video class="js-player" controls preload>
        <source src="{{ asset('upload') }}/{{$video->video}}" type="video/mp4">
    </video>

    <div class="tests">
        <a href="#" class="test">Пройти тест></a>
    </div>
@endsection
