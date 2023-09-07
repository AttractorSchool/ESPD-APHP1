@extends('layouts.app')
<head>
    @vite(['resources/sass/course.css'])
</head>
@section('content')
    <div class="header_course">
        <div class="image">
            @if ($course->photo !== null)
                @if (strpos($course->photo, 'storage') !== false)
                    <img src="{{asset($course->photo)}}" alt="course_picture">
                @else
                    <img src="{{asset('/storage/' . $course->photo)}}" alt="{{$course->photo}}">
                @endif
            @else
                    <img src='https://i.pinimg.com/originals/9a/7c/6c/9a7c6c2c028e05473faf627ac33cef94.jpg' width='100' height='100'>
            @endif
        </div>
        <div class="h1_course">
            <h1>{!! $course->name !!}</h1>
        </div>
        <form method="POST" action="{{ route('favourite.save') }}" >
            @csrf

            <input type="hidden" name="course_id" value="{{ $course->id }}">
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

            <button type="submit" class="heart-button_c" data-course-id="{{ $course->id }}"> <i class="fas fa-heart" style="color: {{\App\Models\Favourite::where('course_id', $course->id)->where('user_id', \Illuminate\Support\Facades\Auth::id())->first() ? '#27ae60' : '#fffff'}}"></i></button>
        </form>
    </div>
    <div class="course_material">
        <h2 style="margin-left: 10px">Материалы по курсу</h2>
        <div class="videos">
            @foreach($course->videos as $video)
{{--                @if($course->videos->first()->id === $video->id)--}}
                    <a href="{{ route('video', ['video' => $video]) }}" class="video">{{$video->name}}</a>
{{--                @elseif(!is_null($score->where('video_id', $course->videos[$video->id - 2]->id)->first()))--}}
{{--                    <a href="{{ route('video', ['video' => $video->id]) }}" class="video">{{$video->name}}</a>--}}
{{--                @else--}}
{{--                    <a class="video" href="{{ route('without_point') }}">{{ $video->name }}</a>--}}
{{--                @endif--}}
            @endforeach
        </div>
    </div>
    <hr class="border-2">
    <div class="feedback">
        <div class="feedback_main">
            <p>Оставить отзыв</p>
            <a href="#">Все отзывы</a>
        </div>
        <div class="rating_css">
            <form action="{{ route('review_add') }}" method="post" class="form">
                @csrf
                <div class="star_icon">
                        @for($i = 1; $i < 6; $i++)
                            <input type="radio" value="{{$i}}" name="rating" id="rating{{$i}}" @if($i === 1) checked @endif >
                            <label for="rating{{$i}}" class="fa fa-star" ></label>
                        @endfor
                </div>
                <input type="hidden" name="course_id" value="{{$course->id}}">
                    <textarea name="body" class="textarea"></textarea>
                <div class="button">
                    <button type="submit">Отправить отзыв!</button>
                </div>
            </form>
        </div>
    </div>
@endsection
