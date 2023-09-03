@extends('layouts.app')

@section('content')
    @foreach($authors as $author)
    @endforeach
    <div class="container">
        <a href="{{ url()->previous() }}" class="arrow-back-register mb-2"><i class="fas fa-arrow-left"></i></a>
        <div class="card-show-mentor">
            <img
                src="https://d1ymz67w5raq8g.cloudfront.net/Pictures/1024x536/P/web/n/z/b/onlinecourses_shutterstock_490891228_2000px_728945.jpg"
                alt="Avatar" class="card-img-top">
            <div class="show-course-body">
                <h5 class="card-title mt-4 mb-3">{{ $course->name }}</h5>
                <div class="course-details">
                    <div class="course-author">
                        @php
                            $author = $authors->firstWhere('id', $course->author_id)
                        @endphp
                        Автор: {{$author->name}}
                    </div>
                    <div class="course-duration">
                        Длительность:
                    </div>
                    <div class="course-rating">
                        Рейтинг курса:
                    </div>
                </div>
                <div class="course-divider"></div>
                <p class="card-text text-start course-description">{{ $course->description }}</p>
                <div class="course-divider"></div>
                <div class="course-feedback">
                    <h5 class="card-title">Отзывы о курсе</h5>
                    <h5><a class="course-all-feedback" href="{{route('show.reviews', ['id' => $course->id])}}">Все отзывы</a></h5>
                </div>
                @foreach ($course->reviews as $review)
                    @php
                        $author = $author->firstWhere('id', $review->author_id);
                    @endphp
                            <div class="feedback-details">
                            <img class="mr-3" src="{{asset('images/3.jpg')}}" style="width: 40px; height: 40px; border-radius: 50%" alt="Generic placeholder image">
                            <div class="media-body">
                                <h5 class="mt-0 mb-1 feedback-author-name">{{$author->name}}</h5>
                            </div>
                                </div>
                                {{$review->body}}
                            </div>
                    <div class="feedback-divider"></div>
                @endforeach
            </div>
           <a href="{{route('course', ['course' => $course->id])}}"><button  type="button" class="button-68-play-course" id="showCoursesBtn">Начать курс</button></a>
        </div>
@endsection
