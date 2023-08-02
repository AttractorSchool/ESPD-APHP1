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
                        <button class="subscribe-btn btn btn-primary" data-id="{{ $subscription->id }}" data-type="{{ $subscription->type }}">Подписаться</button>
                    @else
                        <p>Чтобы подписаться, необходимо войти в свой аккаунт.</p>
                    @endauth

                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const subscribeButtons = document.querySelectorAll('.subscribe-btn');

            subscribeButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const subscriptionId = this.dataset.id;
                    const subscriptionType = this.dataset.type;

                    Swal.fire({
                        title: 'Вы уверены, что хотите купить подписку?',
                        text: `Тариф "${subscriptionType}" будет активен после подтверждения.`,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Да',
                        cancelButtonText: 'Отмена',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            subscribe(subscriptionId, subscriptionType);
                        }
                    });
                });
            });

            function subscribe(subscriptionId, subscriptionType) {
                fetch(`/subscribe/${subscriptionId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        subscription_type: subscriptionType,
                    }),
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: 'Успешно!',
                                text: `Вы успешно подписались на тариф "${subscriptionType}"!`,
                                icon: 'success',
                            });
                        } else {
                            Swal.fire({
                                title: 'Ошибка!',
                                text: 'Скорее всего, у вас уже есть подписка!',
                                icon: 'error',
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Ошибка!',
                            text: 'Что-то пошло не так. Попробуйте позже.',
                            icon: 'error',
                        });
                    });
            }
        });
    </script>
@endsection
