@extends('layouts.app')
<head>
    @vite(['resources/sass/course.css'])
</head>
@section('content')
    <div class="header_course">
        <div class="image">
            <img src="{{asset('/storage/' . $course->photo)}}" alt="{{$course->photo}}">
        </div>
        <div class="h1_course">
            <h1>{{ $course->name }}</h1>
        </div>
        <a href="#" class="heart-button_c">
            <i class="fas fa-heart"></i>
        </a>
    </div>
    <div class="course_material">
        <h2 style="margin-left: 10px">Материалы по курсу</h2>
        <div class="videos">
            @for($i = 1; $i <= count($videos); $i++)
                    <a class="video" href="@if(($course->videos->first() == $videos->find($i)) || !is_null($score->where('video_id', $videos->find($i-1)->id)->first()))
                     {{ route('video', ['video' => $videos->find($i)]) }}
                     @else
                     {{ route('without_point') }}
                    @endif"><i class="bi bi-play-circle"></i>{{$videos->find($i)->name}}</a>
             @endfor
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
