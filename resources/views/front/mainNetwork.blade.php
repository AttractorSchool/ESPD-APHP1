@extends('layouts.app')
@section('content')
        <div class="container">
            <div class="text">
                <h4>Люди, которых вы можете знать в Алматы по тегу #design</h4>
            </div>

            <div class="res">
                <div class="profile-cards">
                @foreach($users as $user)
                        <div class="profile-card">
                            <img src="{{asset('images/3.jpg')}}" alt="Фото профиля">
                            <h2>Имя профиля 1</h2>
                            <p>Профессия</p>
                            <p>Место работы</p>
                            <form method="POST" action="{{ route('connect') }}">
                                @csrf
                                <input type="hidden" value="{{ $user->id }}" name="second_id">
                                <button>Подключиться</button>
                            </form>
                        </div>
                @endforeach
                </div>
            </div>

            <div class="res_1">
                <a class="all_res" href="{{ route('residents') }}">Все резиденты</a>
            </div>
        </div>
@endsection
