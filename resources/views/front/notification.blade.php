@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($notifications as $notification)
            @if($notification->type==1)
                <div class="notification_container">
                    <div class="notification_bar">
                        <div class="notification_img">
                            <img src="{{ asset('images/3.jpg') }}" alt="Фото профиля">
                        </div>
                        <div class="notification_text">
                            <h6 class="no_overflow"><strong>{{ $notification->sender->name }}</strong> отправил(-а) вам приглашение на общение</h6>
                            <p>623 подключения</p>
                        </div>
                    </div>
                    <div class="notification_btn">
                        <form method="POST" action="{{ route('connect_final', ['response' => $notification->response() , 'notification' => $notification])}}">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="confirm_second" value="1">
                            <button>Подключиться</button>
                        </form>
                    </div>
                </div>
            @endif
            @if($notification->type==2)
                <div class="notification_container_text">
                    <div class="title">
                        <h4 class="no_overflow">{{ $notification->title }}</h4>
                    </div>
                    <div class="body">
                        <p>{{ $notification->body }}</p>
                    </div>
                    <div class="exit_del">
                        <form action="{{ route('delete_notification', ['notification' => $notification]) }}" method="POST">
                            @method('delete')
                            @csrf
                            <button class="no_overflow">X</button>
                        </form>
                    </div>
                </div>
            @endif
        @endforeach
{{--        @foreach($users as $user)--}}
{{--            <div class="notification_container">--}}
{{--                <div class="notification_bar">--}}
{{--                    <div class="notification_img">--}}
{{--                        <img src="{{ asset('images/3.jpg') }}" alt="Фото профиля">--}}
{{--                    </div>--}}
{{--                    <div class="notification_text">--}}
{{--                        <h4 class="no_overflow">Джек Рассел</h4>--}}
{{--                        <h6 class="no_overflow">Профессия</h6>--}}
{{--                        <p>623 подключения</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="notification_btn no_overflow">--}}
{{--                    <a href="#">Подключиться</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endforeach--}}
    </div>
@endsection
