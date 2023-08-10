@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 d-flex align-items-center" style="height: 25px">
                <a href="{{ route('events') }}" class="arrow">
                    <i class="fa fa-arrow-left custom-arrow" style="color: #000"></i>
                </a>
                <p class="events-text">Все мероприятия</p>
            </div>

            <div class="toggle-switch" style="margin-top: 25px">
                <input type="checkbox" class="toggle-input" id="toggle">
                <label class="toggle-label" for="toggle">
                    <div class="toggle-slider"></div>
                    <div class="toggle-text">
                        <span class="toggle-text-color" style="color: #5669ff; margin-left: 50px">Предстоящие</span>
                        <span class="toggle-text-color" style="color: #5669ff; margin-right: 50px">Прошедшие</span>
                    </div>
                </label>
            </div>
            <a href="{{route('events.calendar')}}">
            <div class="center-image">
                <img src="{{ asset('images/4.png') }}" alt="Your Image" style="margin-top: 70px">
            </div>
            </a>
            <div class="button-container" style="margin-top: 80px">
                <a href="{{route('events.calendar')}}" class="custom-button">
                    Посмотреть все мероприятия
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
@endsection
