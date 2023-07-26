<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/media.css') }}" rel="stylesheet">
    <script src="/js/app.js"></script>
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand d-none d-md-block d-m-none" href="{{ url('/') }}">
                Woman Create club
            </a>
            <button class="navbar-toggler ms-auto order-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav text-end">
                    <li class="nav-item d-md-none">
                        <a class="nav-link" href="#">Woman Create club</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">События</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('networking') }}">Нетворкинг</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('mentorship') }}">Менторство</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Академия</a>
                    </li>
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
            @if(\Illuminate\Support\Facades\Auth::check())
                <div class="notification">
                    <a href="{{ route('notifications') }}" style="text-decoration: none"><i class="fa-solid fa-bell"
                                                                                            style="text-decoration: none; color: black"></i></a>
                    @if(count(\Illuminate\Support\Facades\Auth::user()->custom_notifications))
                        <div class="not no_overflow">
                            <p class="no_overflow">{{ count(\Illuminate\Support\Facades\Auth::user()->notifications) }}</p>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </nav>

    <main class="py-4">
        @if (session('status'))
            <div class="alert alert-primary" role="alert">
                {{session('status')}}
            </div>
        @endif
        @yield('content')
        @yield('js')
    </main>

</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

<footer class="footer footer-mobile px-4 py-0">
    <ul class="footer-icons nav d-flex justify-content-between">
        <li class="nav-item m-0">
            <div class="icon-container">
                <a class="nav-link py-1" href="/">
                    <i class="fas fa-home" style="color: #8C8C8C"></i>
                </a>
                <span class="icon-label">Home</span>
            </div>
        </li>
        <li class="nav-item m-0">
            <div class="icon-container">
                <a class="nav-link py-1" href="{{ route('networking') }}">
                    <i class="fa-solid fa-user-group" style="color: #000;"></i>
                </a>
                <span class="icon-label">Network</span>
            </div>
        </li>
        <li class="nav-item m-0">
            <div class="icon-container">
                <a class="nav-link py-1" href="#">
                    <i class="fa-solid fa-book-open" style="color: #000;"></i>
                </a>
                <span class="icon-label">Academy</span>
            </div>
        </li>
        <li class="nav-item m-0">
            <div class="icon-container">
                <a class="nav-link py-1" href="{{route('chat')}}">
                    <i class="fas fa-message"></i>
                </a>
                <span class="icon-label">Chat</span>
            </div>
        </li>
        {{--        @guest--}}
        {{--            @if (Route::has('login'))--}}
        {{--                <li class="nav-item m-0">--}}
        {{--                    <div class="icon-container">--}}
        {{--                        <a class="nav-link" href="{{ route('login') }}">--}}
        {{--                            <i class="fas fa-sign-in-alt"></i>--}}
        {{--                        </a>--}}
        {{--                        <span class="icon-label">{{ __('Login') }}</span>--}}
        {{--                    </div>--}}
        {{--                </li>--}}
        {{--            @endif--}}

        {{--            @if (Route::has('register'))--}}
        {{--                <li class="nav-item m-0">--}}
        {{--                    <div class="icon-container">--}}
        {{--                        <a class="nav-link" href="{{ route('register') }}">--}}
        {{--                            <i class="fas fa-user-plus"></i>--}}
        {{--                        </a>--}}
        {{--                        <span class="icon-label">{{ __('Register') }}</span>--}}
        {{--                    </div>--}}
        {{--                </li>--}}
        {{--            @endif--}}
        {{--        @else--}}
        {{--            <li class="nav-item dropdown">--}}
        {{--                <div class="icon-container">--}}
        {{--                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"--}}
        {{--                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
        {{--                        <i class="fas fa-user-circle"></i>--}}
        {{--                    </a>--}}
        {{--                    <span class="icon-label">Profile</span>--}}
        {{--                </div>--}}

        {{--                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">--}}
        {{--                    <a class="dropdown-item" href="{{ route('logout') }}"--}}
        {{--                       onclick="event.preventDefault();--}}
        {{--                                 document.getElementById('logout-form').submit();">--}}
        {{--                        {{ __('Logout') }}--}}
        {{--                    </a>--}}

        {{--                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
        {{--                        @csrf--}}
        {{--                    </form>--}}
        {{--                </div>--}}
        {{--            </li>--}}
        {{--        @endguest--}}
        <li class="nav-item m-0">
            <div class="icon-container">
                <a class="nav-link py-1" href="#">
                    <i class="fas fa-user-circle" style="color: #8C8C8C"></i>
                </a>
                <span class="icon-label">Profile</span>
            </div>
        </li>
    </ul>
</footer>

<footer class="footer footer-desktop">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <ul class="footer-icons nav d-flex justify-content-start">
                    <li class="nav-item social-link">
                        <a class="nav-link" href="https://www.instagram.com">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                    <li class="nav-item social-link">
                        <a class="nav-link" href="https://web.whatsapp.com">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </li>
                    <li class="nav-item social-link">
                        <a class="nav-link" href="https://web.telegram.org">
                            <i class="fab fa-telegram"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6">
                <ul class="footer-links nav d-flex justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link contacts" href="#">Контакты</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link faq" href="#">Вопросы FAQ</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
