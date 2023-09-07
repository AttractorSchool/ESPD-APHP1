@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="text">
            <h4>Люди, которых вы можете знать в Алматы по тегу #design</h4>
        </div>

        <div class="res">
            <div class="filter">
                <form action="{{ route('allResidents') }}" method="GET">
                    @foreach($cities as $city)
                    @endforeach
                </form>
            </div>

            <div class="profile-cards">
                @foreach($users as $user)
                    @if($user->id !== auth()->user()->id)
                        @php
                            $requested = false;
                            $city = $cities->firstWhere('id', $user->city);
                        @endphp
                            <div class="profile-card">
                                <img class="card-background-image"
                                     src="https://img.rawpixel.com/private/static/images/website/2022-05/v944-bb-16-job598.jpg?w=1200&h=1200&dpr=1&fit=clip&crop=default&fm=jpg&q=75&vib=3&con=3&usm=15&cs=srgb&bg=F4F4F3&ixlib=js-2.2.1&s=846eb3fbf937d787169767fd6a98a4b8">
                                <img class="image" src="{{asset('/storage/' . $user->avatar)}}" alt="{{$user->name}}">
                                <h2>{{$user->name}}</h2>
                                <p>Профессия</p>
                                <p>
                                    @foreach ($user->interests as $interest)
                                        <span>{{ $interest->name }}</span>
                                    @endforeach
                                </p>
                                <p>{{$user->city}}</p>
                                <form class="connect-form" method="POST" action="{{ route('connect') }}">
                                    @csrf
                                    @foreach($notifications as $notification)
                                        @if($notification->first_id == auth()->user()->id && $notification->user_id == $user->id)
                                            @php
                                                $requested = true;
                                            @endphp
                                            <button class="requested" disabled>Запрошено</button>
                                        @endif
                                    @endforeach
                                    @unless($requested)
                                        <div class="notification_btn">
                                            <input type="hidden" value="{{ $user->id }}" name="second_id">
                                            <button class="connect-button">Подключиться</button>
                                        </div>
                                    @endunless
                                </form>
                            </div>
                        @endif
                @endforeach

            </div>
        </div>
        <div class="res_1">
            <a class="all_res" href="{{route('networking')}}">Ближе всех</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.connect-form').submit(function (event) {
                event.preventDefault();

                let form = $(this);
                let connectButton = form.find('.connect-button');

                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serialize(),
                    success: function () {
                        connectButton.prop('disabled', true);
                        connectButton.text('Запрошено');
                        connectButton.removeClass('connect-button');
                        if ($(window).width() < 400) {
                            connectButton.addClass('requested-mobile');
                        } else {
                            connectButton.addClass('requested');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endsection
