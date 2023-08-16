<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/js/app.js', 'resources/sass/event.css'])
</head>
<body>

<footer>
    <div class="footer">
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
            <ul class="dropdown-menu">
                @foreach($cities as $city1)
                    <li><a class="dropdown-item" href="{{route('events_main', ['city' => $city1->id])}}">{{ $city1->name }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="notification">
            <a href="{{ route('notifications') }}"><i class="fa-regular fa-bell" style="color: #ffffff;"></i></a>
        </div>
    </div>
</footer>
<main>
    <div class="title_event">
        <p>Предстоящие мероприятия</p>
        <a href="{{ route('events') }}">Просмотреть все <i class="fa-solid fa-play"></i></a>
    </div>
    <div class="carousel_card">
        @foreach($city->events as $event)
            @if($event->date >= \Carbon\Carbon::now())
                <div class="col">
                    <a href="{{ route('events.show', ['id' =>$event->id ]) }}" style="text-decoration: none">
                        <div class="card" style="border: none">
                            <img src="{{ asset('/storage/' . $event->picture) }}" class="card-img-top" alt="...">
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
                            <a href="#"><i class="fa-solid fa-bookmark" style="color:#f2766d;"></i></a>
                        </div>
                    </div>
                </a>
            @endif

        @endforeach
    </div>

    <div class="invite">
        <h3>Пригласить своих друзей</h3>
        <img class="img_back" src="{{ asset('event/present.png') }}" alt="Present Icon">
        <a href="#" class="invite_button">Пригласить</a>
    </div>

</main>

{{--    <div class="social">--}}
{{--        <h4>Пригласить друга</h4>--}}
{{--        <div class="social-cards">--}}
{{--            <div class="social-card">--}}
{{--                <a href="{{ url('https://t.me/share/url?url=' . \Illuminate\Support\Facades\URL::current() . '&text=Привет') }}"><i class="fa-brands fa-telegram" style="font-size: 25px"></i></a>--}}
{{--                <p>Telegram</p>--}}
{{--            </div>--}}
{{--            <div class="social-card">--}}
{{--                <a><i class="fa-brands fa-whatsapp" style="font-size: 25px"></i></a>--}}
{{--                <p>Whatsapp</p>--}}
{{--            </div>--}}
{{--            <div class="social-card"></div>--}}
{{--        </div>--}}
{{--    </div>--}}
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
</body>
</html>
<script>
    $(document).ready(function(){
        $('.carousel_card').slick({
            infinite: true,
            slidesToShow: 1.9,
            slidesToScroll: 1
        });
    });
</script>
