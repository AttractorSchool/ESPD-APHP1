<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('css/event.css') }}">
</head>
<body>


    <div class="footer-event" style="position: relative">
        <div class="dropdown">
            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-bars-staggered icon-bar" style="color:#ffffff;"></i>
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('home') }}">Woman Create club</a></li>
                <li><a class="dropdown-item" href="{{route('events_main')}}">События</a></li>
                <li><a class="dropdown-item" href="{{ route('networking') }}">Нетворкинг</a></li>
                <li><a class="dropdown-item" href="{{ route('mentorship') }}">Менторство</a></li>
                <li><a class="dropdown-item" href="{{route('academy')}}">Академия</a></li>
            </ul>
        </div>
        <div class="dropdown_location">
            <button class="btn dropdown-toggle location-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Ваша локация
            </button>
            <p class="city-location">{{$city->name}}, Казастан</p>
            <ul class="dropdown-menu" style="z-index: 10!important;">
                @foreach($cities as $city1)
                    <li><a class="dropdown-item" style="z-index: 10!important;" href="{{route('events_main', ['city' => $city1->id])}}">{{ $city1->name }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="notification-event">
            <a href="{{ route('notifications') }}"><i class="fa-regular fa-bell" style="color: #ffffff;"></i></a>
        </div>
    </div>
<main>
    <div class="title_event">
        <p>Предстоящие мероприятия</p>
        <a href="{{ route('events') }}">Просмотреть все <i class="fa-solid fa-play"></i></a>
    </div>
    <div class="carousel_card" style="z-index: 1!important; margin-bottom: 10px">
        @foreach($city->events as $event)
            @if($event->date >= \Carbon\Carbon::now())
                <div class="col">
                    <a href="{{ route('events.show', ['id' =>$event->id ]) }}" style="text-decoration: none">
                        <div class="card" style="border: none">
                            @if ($event->picture !== null)
                                @if (strpos($event->picture, 'storage') !== false)
                                    <img class="card-img-top" src="{{asset($event->picture)}}" alt="Event">
                                @else
                                    <img class="card-img-top" src="{{asset('/storage/' . $event->picture)}}" alt="Event">
                                @endif
                            @else
                                <img class="card-img-top" src='https://i.pinimg.com/originals/9a/7c/6c/9a7c6c2c028e05473faf627ac33cef94.jpg' alt="Event">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $event->title }}</h5>
                                <p class="card-text">{{ \App\Models\UserEvent::where('event_id', $event->id)->count() }} участников</p>
                                <p class="card-text"><i class="fa-solid fa-location-dot" style="color: #7c7e8f;"></i>      {{ $city->name }}</p>
                            </div>
                        </div>
                        <div class="data">
                            <p class="day">
                                {{date('d', strtotime($event->date))}}
                            </p>
                            <p class="month">
                                {{date('M', strtotime($event->date))}}
                            </p>
                        </div>
                        <div class="save">
                            <form method="POST" action="{{ route('favourite.save') }}" >
                                @csrf
                                <input type="hidden" name="events_id" value="{{ $event->id }}">
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                <button type="submit" class="heart-button_c" style="background-color: transparent; border: none"> <i class="fa-solid fa-bookmark" style="color: {{\App\Models\Favourite::where('events_id', $event->id)->where('user_id', \Illuminate\Support\Facades\Auth::id())->first() ? '#f2766d' : '#000'}}"></i></button>
                            </form>
                        </div>
                    </a>
                    </div>
                </a>
            @endif

        @endforeach
    </div>

    <div class="invite" style="z-index: -1">
        <h3>Пригласить своих друзей</h3>
        <img class="img_back" src="{{ asset('event/present.png') }}" alt="Present Icon">
        <a href="#" class="invite_button">Пригласить</a>
    </div>

</main>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
<script>
    $(document).ready(function(){
        $('.carousel_card').slick({
            infinite: true,
            slidesToShow: 1.65,
            slidesToScroll: 2
        });
    });
</script>
