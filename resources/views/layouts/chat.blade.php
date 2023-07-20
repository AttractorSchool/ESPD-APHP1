<!doctype html>
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    {{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}

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

<main class="py-4">
    <div class="container">
        <div class="d-flex row align-items-center">
            <a href="{{route('home')}}" class="col-2">
                <img src="{{asset('images/icons/img.png')}}" alt="left" style="width: 24px;height: 24px">
            </a>
            <h2 class="text-dark col-10 fs-1" style="font-weight: 700">Chat WCG</h2>
        </div>
    </div>
    @if (session('status'))
        <div class="alert alert-primary" role="alert">
            {{session('status')}}
        </div>
    @endif
    <div class="container">
        @yield('content')
    </div>
</main>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
