@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="text-start">
            <div class="mentor-card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="mentor-card-title mb-0">Найди подходящего ментора уже сейчас</h5>
                        <p class="mentor-card-text text-start mb-5">Пройди тест - получи рекомендации по менторству</p>
                        <a href="{{ route('mentorship.test') }}" class="mentor-btn">Найти ментора</a>
                    </div>
                    <div>
                        <img src="{{ asset('images/icons/study_icon.png') }}" alt="Иконка">
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 mb-2 d-flex justify-content-between align-items-center">
            <h4 class="">ТОП-менторы</h4>
            <a href="{{ route('mentors') }}" class="mentor-url">Все менторы
                @foreach($cities as $city)
                @endforeach
            </a>
        </div>

        <div class="row">
            @foreach ($topMentors as $topMentor)
                @php
                    $requested = false;
                    $city = $cities->firstWhere('id', $topMentor->city);
                @endphp
                <div class="col-lg-6 col-md-6 col-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <a href="{{ route('mentors.show', ['id' => $topMentor->id]) }}" class="mentor-link">
                                <img src="{{ asset('storage/' . $topMentor->avatar) }}" alt="Avatar" class="avatar">
                            </a>
                            <h6 class="card-title">
                                <a href="{{ route('mentors.show', ['id' => $topMentor->id]) }}" class="mentor-link">{{ $topMentor->name }}</a>
                            </h6>
                            <div class="star-rating" data-rating="{{ $topMentor->ratings_avg_rating }}">
                                @php
                                    $rating = $topMentor->ratings_avg_rating;
                                    $fullStars = floor($rating);
                                    $halfStar = $rating - $fullStars >= 0.5;
                                    $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                @endphp
                                @for ($i = 0; $i < $fullStars; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                                @if ($halfStar)
                                    <i class="fas fa-star-half-alt"></i>
                                @endif
                                @for ($i = 0; $i < $emptyStars; $i++)
                                    <i class="far fa-star"></i>
                                @endfor
                            </div>
                            <p style="color: gray">{{$city->name}}</p>
                            <div class="interest-text">
                                @foreach ($topMentor->interests as $interest)
                                    <span>{{ $interest->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if(count($recommendedMentors) > 0)
            <h4 class="mt-4">Рекомендуем вам</h4>
            <div class="row">
                @foreach ($recommendedMentors as $recommendedMentor)
                    @php
                        $requested = false;
                        $city = $cities->firstWhere('id', $recommendedMentor->city);
                    @endphp
                    @if($city->id === auth()->user()->city)
                        <div class="col-lg-6 col-md-6 col-6">
                            <div class="card text-center">
                                <div class="card-body">
                                    <a href="{{ route('mentors.show', ['id' => $recommendedMentor->id]) }}" class="mentor-link">
                                        <img src="{{ asset('storage/' . $recommendedMentor->avatar) }}" alt="Avatar" class="avatar">
                                    </a>
                                    <h6 class="card-title">
                                        <a href="{{ route('mentors.show', ['id' => $recommendedMentor->id]) }}" class="mentor-link">{{ $recommendedMentor->name }}</a>
                                    </h6>
                                    <div class="star-rating" data-rating="{{ $recommendedMentor->ratings_avg_rating }}">
                                        @php
                                            $rating = $recommendedMentor->ratings_avg_rating;
                                            $fullStars = floor($rating);
                                            $halfStar = $rating - $fullStars >= 0.5;
                                            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                        @endphp
                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                        @if ($halfStar)
                                            <i class="fas fa-star-half-alt"></i>
                                        @endif
                                        @for ($i = 0; $i < $emptyStars; $i++)
                                            <i class="far fa-star"></i>
                                        @endfor
                                    </div>
                                    <p style="color: gray">{{$city->name}}</p>
                                    <div class="interest-text">
                                        @foreach ($recommendedMentor->interests as $interest)
                                            <span>{{ $interest->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>

@endsection
