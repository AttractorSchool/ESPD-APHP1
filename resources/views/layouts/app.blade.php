<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/app.js"></script>
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        html, body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #f5f5f5;
            padding: 10px;
        }

        .footer-mobile {
            display: none;
        }

        .footer-desktop {
            display: none;
        }

        @media (max-width: 767px) {
            .footer-desktop {
                display: none;
            }

            .footer-mobile {
                display: block;
            }
        }

        @media (min-width: 768px) {
            .footer-mobile {
                display: none;
            }

            .footer-desktop {
                display: block;
            }
        }
    </style>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand d-none d-md-block d-m-none" href="{{ url('/home') }}">
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
                        <a class="nav-link" href="#">Нетворкинг</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Менторство</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Академия</a>
                    </li>
                    <!-- Authentication Links -->
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
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

{{--@if($isMobile)--}}
{{--    <footer class="footer footer-mobile">--}}
{{--        <ul class="footer-icons nav d-flex justify-content-between">--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="#">--}}
{{--                    <i class="fas fa-home"></i>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="#">--}}
{{--                    <i class="fas fa-search"></i>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="#">--}}
{{--                    <i class="fas fa-bell"></i>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            @guest--}}
{{--                @if (Route::has('login'))--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
{{--                    </li>--}}
{{--                @endif--}}

{{--                @if (Route::has('register'))--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
{{--                    </li>--}}
{{--                @endif--}}
{{--            @else--}}
{{--                <li class="nav-item dropdown">--}}
{{--                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"--}}
{{--                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                        <i class="fas fa-user-circle"></i>--}}
{{--                    </a>--}}

{{--                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">--}}
{{--                        <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--                           onclick="event.preventDefault();--}}
{{--                                 document.getElementById('logout-form').submit();">--}}
{{--                            {{ __('Logout') }}--}}
{{--                        </a>--}}

{{--                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
{{--                            @csrf--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--            @endguest--}}
{{--        </ul>--}}
{{--    </footer>--}}
{{--@else--}}
{{--    <footer class="footer footer-desktop">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-6">--}}
{{--                    <ul class="footer-icons nav d-flex justify-content-start">--}}
{{--                        <li class="nav-item social-link">--}}
{{--                            <a class="nav-link" href="https://www.instagram.com">--}}
{{--                                <i class="fab fa-instagram"></i>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item social-link">--}}
{{--                            <a class="nav-link" href="https://web.whatsapp.com">--}}
{{--                                <i class="fab fa-whatsapp"></i>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item social-link">--}}
{{--                            <a class="nav-link" href="https://web.telegram.org">--}}
{{--                                <i class="fab fa-telegram"></i>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--                <div class="col-lg-6">--}}
{{--                    <ul class="footer-links nav d-flex justify-content-end">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link contacts" href="#">Контакты</a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link faq" href="#">Вопросы FAQ</a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </footer>--}}
{{--@endif--}}
</body>
</html>
