<style>
</style>
@extends('layouts.app')
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
                @if($reviews->isEmpty())
                    <div class="carousel-item active">
                        <li class="card">
                            <div class="img">
                                <img class="img-fluid card-mentors"
                                     src='https://cdn4.iconfinder.com/data/icons/people-of-medical-education-and-science/512/People_Medical_Education_Science_lab_scientist_woman-1024.png' alt="review_fake">
                            </div>
                            <h2 style="overflow: hidden">Анастасия</h2>
                            <span class="text-center">Очень крутой сайт!</span>
                        </li>
                    </div>
                    <div class="carousel-item">
                        <li class="card">
                            <div class="img">
                                <img class="img-fluid card-mentors"
                                     src='https://cdn4.iconfinder.com/data/icons/people-of-medical-education-and-science/512/People_Medical_Education_Science_lab_scientist_woman-1024.png' alt="review_fake">
                            </div>
                            <h2 style="overflow: hidden">Джоан</h2>
                            <span class="text-center">Очень крутой сайт!</span>
                        </li>
                    </div>
                    <div class="carousel-item">
                        <li class="card">
                            <div class="img">
                                <img class="img-fluid card-mentors"
                                     src='https://cdn4.iconfinder.com/data/icons/people-of-medical-education-and-science/512/People_Medical_Education_Science_lab_scientist_woman-1024.png' alt="review_fake">
                            </div>
                            <h2 style="overflow: hidden">Кристина</h2>
                            <span class="text-center">Очень крутой сайт!</span>
                        </li>
                    </div>
                @else
                    @foreach($reviews as $review)

                            <div class="carousel-item {{$review->id === $reviews->first()->id ? 'active' : ''}}">
                                <li class="card">
                                    <div class="img">
                                        @if(is_null($review->user->avatar))
                                            <img class="img-fluid card-mentors"
                                                 src='https://cdn4.iconfinder.com/data/icons/people-of-medical-education-and-science/512/People_Medical_Education_Science_lab_scientist_woman-1024.png' alt="review">
                                        @else
                                            @if (strpos($review->user->avatar, 'storage') !== false)
                                                <img class="img-fluid card-mentors" src="{{asset($review->user->avatar)}}" alt="review">
                                            @else
                                                <img class="img-fluid card-mentors" src="{{asset('/storage/' . $review->user->avatar)}}" alt="review">
                                            @endif
                                        @endif
                                    </div>
                                    <h2 style="overflow: hidden">{{ $review->user->name }}</h2>
                                    <span class="text-center">{{ $review->body }}</span>
                                </li>
                            </div>
                    @endforeach
                @endif
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
                            <div class="carousel-item {{$users->first()->id === $user->id ? 'active' : ''}}">
                                <div class="resident mx-auto">
                                    @if(is_null($user->avatar))
                                        <img src="https://cdn4.iconfinder.com/data/icons/people-of-medical-education-and-science/512/People_Medical_Education_Science_lab_scientist_woman-1024.png" alt="user_photo">
                                    @else
                                        @if (strpos($user->avatar, 'storage') !== false)
                                            <img class="img-fluid card-mentors" src="{{asset($user->avatar)}}" alt="Avatar">
                                        @else
                                            <img class="img-fluid card-mentors" src="{{asset('/storage/' . $user->avatar)}}" alt="Avatar    ">
                                        @endif
                                    @endif
                                    <div class="resident-info">
                                        @foreach ($user->reviews as $review)
                                            <p>{{ $review->body }}</p>
                                        @endforeach
                                    </div>
                                    <h3 style="overflow:hidden;">{{ $user->name }}</h3>
                                </div>
                            </div>
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
                <a href="{{$calendar ? asset('storage/' . $calendar->attachment->first()->path . $calendar->attachment->first()->name
                . '.' . $calendar->attachment->first()->extension) : "#"}}" class="calendar-button" style="text-decoration: none; color: white">Получить календарь</a>

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
                            <h5>{{ round($subscription->price) }} тг.</h5>
                            @auth
                                <a class="subscribe-btn btn btn-primary" style="background-color: #f9c70a"
                                   href="{{ route('payment', ['type' => $subscription->type,
                        'subscriptionId' => $subscription->id,
                        'subscriptionPrice' => $subscription->price]) }}">
                                    Подписаться
                                </a>
                                </form>
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
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Вопрос Первый
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniamLorem ipsum dolor sit
                    amet,
                    consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    Вопрос Второй
                </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniamLorem ipsum dolor sit
                    amet,
                    consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                    Вопрос Третий
                </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniamLorem ipsum dolor sit
                    amet,
                    consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                </div>
            </div>
        </div>
    </div>
@endsection
