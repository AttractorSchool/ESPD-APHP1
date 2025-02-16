@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-center mt-5">Люди — главный актив клуба</h1>

        <p class="text-center">Мы тщательно работаем над составом клуба и строим сообщество близких по духу людей. Здесь
            слово каждого
            резидента имеет вес и влияет на изменения в сообществе. Изменения к лучшему, разумеется</p>


        <div class="d-flex row">
            @foreach($users as $user)

                <div class="col-6">
                    <div class="rounded-top-2 d-flex align-items-center bg-body-secondary" style="height: 3rem">
                        <h5 class="card-title align-middle col-12 text-center">{{$user->name}}</h5>
                    </div>
                    <div class="">

                        @if(!is_null($user->avatar))
                            @if (strpos($user->avatar, 'storage') !== false)
                                <img class="card-img-top mb-2 rounded-bottom-2" src="{{asset($user->avatar)}}" alt="Avatar" style="max-height: 183.2px; object-fit: cover">
                            @else
                                <img class="card-img-top mb-2 rounded-bottom-2" src="{{asset('/storage/' . $user->avatar)}}" alt="Avatar">
                            @endif
                        @else
                            <img class="card-img-top mb-2 rounded-bottom-2"
                                 src='https://cdn4.iconfinder.com/data/icons/people-of-medical-education-and-science/512/People_Medical_Education_Science_lab_scientist_woman-1024.png' alt="review_fake">
                        @endif
                    </div>
                </div>

            @endforeach
        </div>

        <h1 class="text-center mt-5">Выбрать свой формат участия</h1>
        <div class="d-flex row p-3">
            @foreach($subscriptions as $subscription)
                @if($subscription->type=='free')
                    <div class="card my-2 text-center">
                        <div class="card-body">
                            <h5 class="card-title">Получить консультацию</h5>
                            <p class="card-text">Оставить заявку, чтобы мы ответили на все вопросы и рассказали о жизни
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
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Получить
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
@endsection
