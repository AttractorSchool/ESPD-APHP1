<style>
    @vite(['resources/sass/home.css'])
</style>
@extends('layouts.app')
@vite(['resources/sass/home.css'])
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="promo">
                <h1>Сообщество близких по духу предпринимателей.</h1>
                <p class="promo-text"> Нам по пути, если бизнес для тебя не просто деньги,а помощь другим и личная
                    миссия</p>
                <div class="block-card">
                    <div class="mini-block">
                        <i class="fas fa-business-time"></i>
                        <p class="mini-block-text">Находи партнеров и новых друзей</p>
                    </div>
                    <div class="mini-block">
                        <i class="fas fa-heart"></i>
                        <p class="mini-block-text">Делай эффективнее и прибыльнее свой бизнес</p>
                    </div>
                    <div class="mini-block">
                        <i class="fas fa-chart-line"></i>
                        <p class="mini-block-text">Помогай другим и находи помощь сам</p>
                    </div>
                    <div class="mini-block">
                        <i class="fas fa-users"></i>
                        <p class="mini-block-text">Отдыхай и общайсяв кругу единомышленников</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <div class="reviews-text text-center">
            <h2>Чем «Woman Create» отличается от других сообществ?</h2>
        </div>

        <ul class="carousel">
        </ul>


        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-inner">

                @foreach($reviews as $review)
                    @if($review===$reviews[0])
                        <div class="carousel-item active">
                            <li class="card">
                                <div class="img">
                                    <img src="https://vokrug.tv/pic/news/f/b/9/2/fb927aca1ca4a42d9bd46ce4e3330bdd.jpg"
                                         alt="img"
                                         draggable="false">
                                </div>
                                <h2 style="overflow: hidden">{{ $review->author->name }}</h2>
                                <span class="text-center">{{ $review->body }}</span>
                            </li>
                        </div>
                    @else
                        <div class="carousel-item">
                            <li class="card">
                                <div class="img">
                                    <img src="https://vokrug.tv/pic/news/f/b/9/2/fb927aca1ca4a42d9bd46ce4e3330bdd.jpg"
                                         alt="img"
                                         draggable="false">
                                </div>
                                <h2 style="overflow: hidden">{{ $review->author->name }}</h2>
                                <span class="text-center">{{ $review->body }}</span>
                            </li>
                        </div>
                    @endif
                @endforeach

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-5 p-2" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-5 p-2" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </div>
    <div class="container">
        <div class="residents">
            <h2 style="overflow:hidden;">Наши резиденты</h2>

            <div id="carouselExampleCaptions2" class="carousel slide text-center mx-auto" style="width: 100%">
                <div class="carousel-inner">

                    @foreach($users as $user)
                        @if($user===$users[0])
                            <div class="carousel-item active">
                                <div class="resident mx-auto">
                                    <img src="https://vokrug.tv/pic/news/f/b/9/2/fb927aca1ca4a42d9bd46ce4e3330bdd.jpg"
                                         alt=" ">
                                    <div class="resident-info">
                                        @foreach ($user->reviews as $review)
                                            <p>{{ $review->body }}</p>
                                        @endforeach
                                    </div>
                                    <h3 style="overflow:hidden;">{{ $user->name }}</h3>
                                </div>
                            </div>
                        @else
                            <div class="carousel-item">
                                <div class="resident mx-auto">
                                    <img src="https://vokrug.tv/pic/news/f/b/9/2/fb927aca1ca4a42d9bd46ce4e3330bdd.jpg"
                                         alt=" ">
                                    <div class="resident-info">
                                        @foreach ($user->reviews as $review)
                                            <p>{{ $review->body }}</p>
                                        @endforeach
                                    </div>
                                    <h3 style="overflow:hidden;">{{ $user->name }}</h3>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions2"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-warning rounded-5 p-2" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions2"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-warning rounded-5 p-2" aria-hidden="true"></span>
                </button>
            </div>


            <a href="{{ route('residents') }}" class="residents-link">
                <span>Показать всех резидентов</span>
                <i class="fas fa-arrow-right arrow-right res-link"></i>
            </a>
        </div>
        <div class="event-calendar">
            <div class="event-info">
                <h2 style="overflow: hidden">Получи полный календарь мероприятий</h2>
                <p>Получи подробную презентацию, календарь мероприятий клуба, информацию о резидентах и возможностях
                    нашей
                    платформы
                </p>
                <button class="calendar-button">Получить календарь</button>
            </div>

        </div>
        <h1 class="text-center mt-5 price-text">Выбрать свой формат участия</h1>
        <div class="d-flex row p-3">
            @foreach($subscriptions as $subscription)
                @if($subscription->type=='free')
                    <div class="card my-2 text-center">
                        <div class="card-body">
                            <h5 class="card-title">Получить консультацию</h5>
                            <p class="card-text" style="color: black">Оставить заявку, чтобы мы ответили на все вопросы
                                и рассказали о жизни
                                клуба</p>
                            <h5>Бесплатно</h5>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-warning rounded-5" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                Оставить заявку
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: black">
                                                Получить
                                                консультацию</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('front.form')}}" method="POST">
                                                @csrf
                                                <div class="u-form-group u-form-name my-4">
                                                    <input type="text" placeholder="Введите свое имя" name="name"
                                                           class="col-12 form-control"
                                                           required>
                                                </div>
                                                <div class="u-form-email u-form-group my-4">
                                                    <input type="email" placeholder="Введите свой email"
                                                           name="email"
                                                           class="col-12 form-control"
                                                           required>
                                                </div>
                                                <div class="u-form-group u-form-message my-4">
                                            <textarea placeholder="Введите свое сообщение" rows="4" cols="50"
                                                      name="message"
                                                      class="col-12 form-control"
                                                      required></textarea>
                                                </div>
                                                <button type="submit"
                                                        class="my-4 btn btn-secondary">
                                                    Оставить данные
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @else
                    <div class="card bg-dark text-white my-2 text-center">
                        <div class="card-body">
                            <h5 class="card-title">{{$subscription->type}}</h5>
                            <p class="card-text">{{$subscription->description}}</p>
                            <h5>{{$subscription->price}} тг.</h5>
                            @auth
                                <button class="subscribe-btn " data-id="{{ $subscription->id }}" data-type="{{ $subscription->type }}">Подписаться</button>
                            @else
                                <p>Чтобы подписаться, необходимо войти в свой аккаунт.</p>
                            @endauth
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Heading One
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniamLorem ipsum dolor sit
                    amet,
                    consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    Heading Two
                </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniamLorem ipsum dolor sit
                    amet,
                    consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                    Heading Three
                </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniamLorem ipsum dolor sit
                    amet,
                    consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</div>
            </div>
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
