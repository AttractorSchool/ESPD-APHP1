@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="position-relative">
                <a href="{{ route('events') }}" class="arrow-back-register mb-2">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <a href="#" class="heart-button">
                    <i class="fas fa-bookmark"></i>
                </a>
                <div class="card-show-mentor">
                    <img src="{{ asset('storage/' . $event->picture) }}" alt="Avatar" class="card-img-top">
                    <div class="card-body">
                        <h1>{{ $event->title }}</h1>

                        <div class="row mb-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar-container">
                                    <i class="far fa-calendar-alt fa-3x"></i>
                                </div>
                                <div class="text-center" style="margin-left: 20px;">
                                    <p class="text-dark mb-0">{{ $event->date }}</p>
                                    <small class="text-muted mb-4">{{ $event->time }}</small>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar-container">
                                    <i class="fas fa-map-marker-alt fa-3x"></i>
                                </div>
                                <div class="text-center" style="margin-left: 20px;">
                                    <p class="text-dark mb-0">{{ $event->location }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="d-flex align-items-center">
                                <div class="avatar-container">
                                    <img src="{{ asset('storage/' . $event->user->avatar) }}" alt="Avatar" class="eve">
                                </div>
                                <div class="text-center" style="margin-left: 20px;">
                                    <p class="text-dark mb-0">{{ $event->user->name }} {{ $event->user->lastname }}</p>
                                    <small class="text-muted mb-4">Организатор</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h6 class="mb-0">О мероприятии</h6>
                        <p class="text-dark text-start">{{ $event->description }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 offset-md-3 text-center">
                        @if ($event->quantity > 0)
                            <a href="{{ route('buy-ticket', ['id' => $event->id]) }}" class="btn btn-primary">
                                КУПИТЬ БИЛЕТ {{ round($event->price) }} ТГ. <i class="fas fa-arrow-right"></i>
                            </a>
                        @else
                            <button class="btn btn-primary" disabled>
                                Билеты закончились
                            </button>
                        @endif
                    </div>
                </div>

@endsection
