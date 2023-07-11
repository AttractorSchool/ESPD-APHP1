@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="promo">
                <h1>Сообщество близких по духу предпринимателей.</h1>
                <p class="promo-text"> Нам по пути, если бизнес для тебя не просто деньги,а помощь другим и личная миссия</p>
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
        <div class="wrapper">
            <div class="reviews-text">
                <h2>Чем «Woman Create» отличается от других сообществ?</h2>
            </div>
            <i id="left" class="fa-solid fa-angle-left"></i>
            <ul class="carousel">
                @foreach ($reviews as $review)
                    <li class="card">
                        <div class="img">
                            <img src="https://vokrug.tv/pic/news/f/b/9/2/fb927aca1ca4a42d9bd46ce4e3330bdd.jpg" alt="img" draggable="false">
                        </div>
                        <h2 style="overflow: hidden">{{ $review->user->name }}</h2>
                        <span>{{ $review->body }}</span>
                    </li>
                @endforeach
            </ul>
            <i id="right" class="fa-solid fa-angle-right"></i>
        </div>
        <div class="residents">
            <h2 style="overflow:hidden;">Наши резиденты</h2>
            <div class="carousel-wrapper">
                <i id="left" class="fa-solid fa-angle-left icon-left"></i>

                <div class="carousel">
                    @foreach ($users as $user)
                        <div class="resident">
                            <img src="https://vokrug.tv/pic/news/f/b/9/2/fb927aca1ca4a42d9bd46ce4e3330bdd.jpg" alt=" ">
                            <div class="resident-info">
                                @foreach ($user->reviews as $review)
                                    <p>{{ $review->body }}</p>
                                @endforeach
                            </div>
                            <h3 style="overflow:hidden;">{{ $user->name }}</h3>
                        </div>
                    @endforeach

                </div>

                <i id="right" class="fa-solid fa-angle-right icon-right"></i>
            </div>
            <a href="{{ route('residents') }}" class="residents-link">
                <span>Показать всех резидентов</span>
                <i class="fas fa-arrow-right arrow-right res-link"></i>
            </a>
        </div>
        <div class="event-calendar">
            <div class="event-info">
                <h2 style="overflow: hidden">Получи полный календарь мероприятий</h2>
                <p>Получи подробную презентацию, календарь мероприятий клуба, информацию о резидентах и возможностях нашей
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
                            <p class="card-text" style="color: black">Оставить заявку, чтобы мы ответили на все вопросы и рассказали о жизни
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
                                            <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: black">Получить
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
                            <h5>{{$subscription->price}} $</h5>

                            <button type="button" class="btn btn-warning rounded-5" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                Оставить заявку
                            </button>
                            {{--                            <a href="#" class="btn btn-warning rounded-5">Выбрать тариф</a>--}}
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
        <div class="accordian">
            <div class="card">
                <div class="card-header">
                    <h3>Heading One </h3>
                    <span class="fa fa-minus"></span>
                </div>
                <div class="card-body active">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniamLorem ipsum dolor sit amet,
                        consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>Heading Two </h3>
                    <span class="fa fa-plus"></span>
                </div>
                <div class="card-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniamLorem ipsum dolor sit amet,
                        consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>Heading Three </h3>
                    <span class="fa fa-plus"></span>
                </div>
                <div class="card-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniamLorem ipsum dolor sit amet,
                        consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
                </div>
            </div>
        </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            $(".card-header").click(function () {
                if ($(this).next(".card-body").hasClass("active")) {
                    $(this).next(".card-body").removeClass("active").slideUp()
                    $(this).children("span").removeClass("fa-minus").addClass("fa-plus")
                }
                else {
                    $(".card .card-body").removeClass("active").slideUp()
                    $(".card .card-header span").removeClass("fa-minus").addClass("fa-plus");
                    $(this).next(".card-body").addClass("active").slideDown()
                    $(this).children("span").removeClass("fa-plus").addClass("fa-minus")
                }
            })
        })
    </script>
    <script src="{{ asset('js/script.js') }}"></script>
@endsection
