@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('mentorship') }}" class="arrow-back-mentors mb-2">
            <i class="fas fa-arrow-left"></i>
            @foreach($cities as $city)
            @endforeach
        </a>
        <div class="card-show-mentor">
            <table class="table table-responsive">
                <tbody>
                @foreach($mentors as $mentor)
                    @php
                        $requested = false;
                        $city = $cities->firstWhere('id', $mentor->city);
                    @endphp
                    <tr>
                        <td>
                            <a href="{{ route('mentors.show', ['id' => $mentor->id]) }}">
                                <img src="{{ asset('storage/' . $mentor->avatar) }}" alt="Avatar" class="img-fluid card-mentors">
                            </a>
                        </td>
                        <td class="text-center">
                            <h5 class="card-title">
                                <a href="{{ route('mentors.show', ['id' => $mentor->id]) }}"
                                   class="mentor-link">{{ $mentor->name }}</a>
                            </h5>
                            <p class="card-text">{{ $mentor->description }}</p>
                            <div class="star-rating" data-rating="{{ $mentor->ratings_avg_rating }}">
                                @php
                                    $rating = $mentor->ratings_avg_rating;
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
                                <p style="color: gray">{{$city->name}}</p>
                                <div class="interest-text">
                                    @foreach ($mentor->interests as $interest)
                                        <span>{{ $interest->name }}</span>
                                    @endforeach
                                </div>
                @endforeach
                </tbody>
            </table>
        </div>
@endsection
