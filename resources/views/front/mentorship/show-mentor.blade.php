@extends('layouts.app')

@section('content')
    @foreach($cities as $city)
    @endforeach
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="position-relative">
                <a href="{{ '/mentorship' }}" class="arrow-back mb-2">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <form method="POST" action="{{ route('favourite.save') }}">
                    @csrf

                    <input type="hidden" name="mentor_id" value="{{ $mentor->id }}">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <button type="submit" class="heart-button" style="border: none"><i class="fas fa-heart"
                                                                                       style="color: {{\App\Models\Favourite::where('mentor_id', $mentor->id)->where('user_id', \Illuminate\Support\Facades\Auth::id())->first() ? '#27ae60' : '#fffff'}}"></i>
                    </button>
                </form>
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
                        <p style="display: flex; color: gray">г. {{$mentor->city}}</p>
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
                                    $isSubscribed = $subscription && in_array($subscription->id, [2, 3]);
                                @endphp
                                @if ($isSubscribed)
                                    <form class="connect-form" method="POST" action="{{ route('connectToMentor') }}">
                                        @csrf
                                        @php
                                            $requested = false;
                                        @endphp
                                        @foreach($notifications as $notification)
                                            @if($notification->first_id == auth()->user()->id && $notification->user_id == $mentor->id)
                                                @php
                                                    $requested = true;
                                                @endphp
                                                <button class="booking-button mt-4" disabled
                                                        style="background-color: gray;">Сессия забронирована
                                                </button>
                                            @endif
                                        @endforeach
                                        @unless($requested)
                                            <input type="hidden" value="{{ $mentor->id }}" name="second_id">
                                            <button class="booking-button mt-4">Забронировать сессию</button>
                                        @endunless
                                    </form>
                                @else
                                    <button class="booking-button mt-4" disabled style="background-color: gray;">
                                        Забронировать сессию
                                    </button>
                                @endif
                            @else
                                <a href="{{ route('register') }}" class="booking-button mt-4">Забронировать сессию</a>
                            @endauth
                        </div>
                    </div>
                </div>

@endsection
