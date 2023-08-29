@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Выберите тариф</h1>

        <div class="subscriptions">
            @foreach($subscriptions as $subscription)
                <div class="subscription-card">
                    <h2>{{ $subscription->type }}</h2>
                    <p class="text-dark">{{ $subscription->description }}</p>
                    <p class="text-dark">Цена: {{ round($subscription->price) }}</p>
                    @auth
                        <a class="subscribe-btn btn btn-primary"
                           href="{{ route('payment', ['type' => $subscription->type,
                        'subscriptionId' => $subscription->id,
                        'subscriptionPrice' => $subscription->price]) }}"
                        >
                            Подписаться
                        </a>
                    @else
                        <p>Чтобы подписаться, необходимо войти в свой аккаунт.</p>
                    @endauth

                </div>
            @endforeach
        </div>
    </div>
@endsection
