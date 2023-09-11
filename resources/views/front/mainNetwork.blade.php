@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="text">
            <h4>Люди, которых вы можете знать в {{auth()->user()->city}}</h4>
        </div>

                <h4 class="mt-4">Рекомендуем вам</h4>
                <div class="row">

                    <div class="profile-cards">

                        @foreach($users_filtered as $user)
                                <div class="profile-card">
                                    <img class="card-background-image"
                                         src="https://img.rawpixel.com/private/static/images/website/2022-05/v944-bb-16-job598.jpg?w=1200&h=1200&dpr=1&fit=clip&crop=default&fm=jpg&q=75&vib=3&con=3&usm=15&cs=srgb&bg=F4F4F3&ixlib=js-2.2.1&s=846eb3fbf937d787169767fd6a98a4b8">
                                    @if(!is_null($user->avatar))
                                        @if (strpos($user->avatar, 'storage') !== false)
                                            <img class="image" src="{{asset($user->avatar)}}" style="object-fit: cover" alt="Avatar">
                                        @else
                                            <img class="image" src="{{asset('/storage/' . $user->avatar)}}" alt="Avatar">
                                        @endif
                                    @else
                                        <img src="{{asset('images/3.jpg')}}" alt="Фото профиля" class="image">
                                    @endif
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
                                            @if(\App\Models\Response::where('first_id', auth()->id())->where('second_id', $user->id)->first())
                                                <button class="requested" disabled>Запрошено</button>
                                            @else
                                                <div class="notification_btn" style="display: {{\App\Models\Response::where('first_id', auth()->id()) ? 'block' : 'none'}}">
                                                    <input type="hidden" value="{{ $user->id }}" name="second_id">
                                                    <button class="connect-button">Подключиться</button>
                                                </div>
                                            @endif

                                    </form>
                                </div>
                        @endforeach
                    </div>
                </div>
            <div class="res_1">
                <a class="all_res" href="{{route('allResidents')}}">Все резиденты</a>
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
