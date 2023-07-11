@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($users as $user)
            <div class="notification_container">
                <div class="notification_bar">
                    <div class="notification_img">
                        <img src="{{ asset('images/3.jpg') }}" alt="Фото профиля">
                    </div>
                    <div class="notification_text">
                        <h4 class="no_overflow">Джек Рассел</h4>
                        <h6 class="no_overflow">Профессия</h6>
                        <p>623 подключения</p>
                    </div>
                </div>
                <div class="notification_btn no_overflow">
                    <a href="#">Подключиться</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
