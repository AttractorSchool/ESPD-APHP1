@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('mentorship') }}" class="arrow-back-mentors mb-2">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div class="card-show-mentor">
            <table class="table table-responsive">
                <tbody>
                @foreach($mentors as $mentor)
{{--                    @php--}}
{{--                        $requested = false;--}}
{{--                        $city = $cities->firstWhere('id', $mentor->city);--}}
{{--                    @endphp--}}
                    <tr>
                        <td>
                            <a href="{{ route('mentors.show', ['id' => $mentor->id]) }}">
                                @if ($mentor->avatar !== null)
                                    @if (strpos($mentor->avatar, 'storage') !== false)
                                        <img class="img-fluid card-mentors" src="{{asset($mentor->avatar)}}" alt="Avatar">
                                    @else
                                        <img class="img-fluid card-mentors" src="{{asset('/storage/' . $mentor->avatar)}}" alt="{{$mentor->avatar}}">
                                    @endif
                                @else
                                    <img class="img-fluid card-mentors" src='https://i.pinimg.com/originals/9a/7c/6c/9a7c6c2c028e05473faf627ac33cef94.jpg' alt="Avatar">
                                @endif
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
                                <p style="color: gray">{{$mentor->city}}</p>
                                <div class="interest-text">
                                    @foreach ($mentor->interests as $interest)
                                        <span>{{ $interest->name }}</span>
                                    @endforeach
                                </div>
                @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-12">
                    {{ $mentors->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
@endsection
