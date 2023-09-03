@extends('layouts.app')

@section('content')
    <section class="profile-show h-100 gradient-custom-2">
        <div class="container py-5 h-100 show-profile">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-9 col-xl-7">
                    <div class="card">
                        <div class="rounded-top text-white d-flex flex-row"
                             style="background-color: #000; height:200px;">
                            <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                                <img @if(isset($user, $user->avatar)) src="{{ asset('/storage/' . $user->avatar) }}"
                                     @endif class="img-fluid img-thumbnail mt-4 mb-2"
                                     style="width: 150px; height: 150px; z-index: 1">
                                <a href="{{route('edit_profile')}}" style="display: flex; text-decoration: none">
                                    <button type="button" class="btn btn-outline-dark" data-mdb-ripple-color="dark"
                                            style="z-index: 1;">
                                        Edit profile
                                    </button>
                                </a>
                            </div>
                            <div class="ms-3" style="margin-top: 130px;">
                                <h5>{{$user->name. " " .$user->lastname}}</h5>
                                <div class="profile-email">{{$user->email}}</div>
                            </div>
                        </div>
                        <div class="profile-parameters">
                            <div class="p-4 text-black" style="background-color: #f8f9fa;">
                                <div class="d-flex justify-content-end text-center py-1">
                                    <div>
                                        <p class="mb-1 h5">Страна</p>
                                        <p class="small text-muted mb-0">{{$user->country}}</p>
                                    </div>
                                    <div class="px-3">
                                        <p class="mb-1 h5">Город</p>
                                        <p class="small text-muted mb-0">{{$user->city}}</p>
                                    </div>
                                    <div>
                                        <p class="mb-1 h5">Телефон</p>
                                        <p class="small text-muted mb-0">{{$user->phone}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-4 text-black">
                            <div class="mb-5">
                                <div class="lead fw-normal mb-1">Мои интересы</div>
                                <div class="p-4" style="background-color: #f8f9fa;">
                                    @foreach ($user->interests as $interest)
                                        <div class="font-italic mb-1">{{ $interest->name }}</div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="lead fw-normal mb-0">Мои курсы</div>
                            </div>
                            <div class="row g-2">
                                @foreach($courses as $course)
                                <div class="col">
                                    <img @if(isset($course, $course->photo)) src="{{ asset('/storage/' . $course->photo) }}"
                                         @endif
                                         alt="image 1" class="w-100 rounded-3">
                                    <div>{{ $course->name }}</div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


