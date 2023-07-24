@extends('layouts.app')

@section('content')
    @foreach($cities as $city)
    @endforeach
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="position-relative">
                <a href="{{ url()->previous() }}" class="arrow-back mb-2">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <a href="#" class="heart-button">
                    <i class="fas fa-heart"></i>
                </a>
                <div class="card-show-mentor">
                    <img src="{{ asset('storage/' . $mentor->avatar) }}" alt="Avatar" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title mt-4 mb-3">{{ $mentor->name }}</h5>
                        <div class="star-rating" data-rating="{{ $mentor->ratings_avg_rating }}">
                            @php
                                $rating = $mentor->ratings_avg_rating;
                                $fullStars = floor($rating);
                                $halfStar = $rating - $fullStars >= 0.5;
                                $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                $numRatings = $mentor->ratings()->count();
                                $city = $cities->firstWhere('id', $mentor->city);
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
                            <span class="num-ratings">{{ $numRatings }} проголосовавших</span>
                        </div>
                        <h5 class="card-title mt-4">О менторе</h5>
                        <p style="display: flex; color: gray">г. {{$city->name}}</p>
                        <p class="card-text text-start">{{ $mentor->description }}</p>
                        <div class="interest-text-show text-start mt-4">
                            @foreach ($mentor->interests as $interest)
                                <span class="interest-text-show text-start">{{ $interest->name }}</span>
                            @endforeach
                        </div>
                        <h5 class="card-title mt-4 mb-4">Материалы от {{ $mentor->name }}</h5>
                        <div class="card-materials bg-white">
                            <p class="text-materials">50 шагов "От цели до результата в бизнесе"</p>
                            <a href="#"><i class="fas fa-download"></i></a>
                        </div>
                        <div class="text-center">
                            @auth
                                @php
                                    $subscription = auth()->user()->subscriptions()->first();
                                    $isSubscribed = $subscription && in_array($subscription->subscription_id, [2, 3]);
                                @endphp

                                @if ($isSubscribed)
                                    <button class="booking-button mt-4">Забронировать сессию</button>
                                @else
                                    <button class="booking-button mt-4" disabled style="background-color: gray;" >Забронировать сессию</button>
                                @endif
                            @else
                                <a href="{{ route('register') }}" class="booking-button mt-4">Забронировать сессию</a>
                            @endauth
                        </div>

                    </div>
                </div>

@endsection
