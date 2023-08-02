@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ url()->previous() }}" class="arrow-back-register mb-2"><i class="fas fa-arrow-left"></i></a>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                        <div class="form-group row mb-3">
                            <label for="avatar" class="col-md-4 col-form-label text-md-right"></label>

                            <div class="col-md-6 d-flex align-items-end justify-content-center">
                                <div class="avatar-preview">
                                    @if (isset($user) && $user->avatar)
                                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar Preview">
                                    @else
                                        <div class="avatar-placeholder"></div>
                                    @endif
                                </div>
                                <label for="avatar" class="avatar-edit ml-2">
                                    <img src="{{ asset('images/icons/edit.png') }}" alt="edit.png">
                                </label>
                                <input id="avatar" type="file" hidden class="form-control @error('avatar') is-invalid @enderror" name="avatar" accept="image/*">

                                @error('avatar')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name"
                                   class="col-md-4 col-form-label text-md-end"></label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                       class="form-control @error('name') is-invalid @enderror" name="name"
                                       value="{{ old('name') }}" required autocomplete="name" autofocus
                                       placeholder="Имя">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="lastname"
                                   class="col-md-4 col-form-label text-md-end"></label>

                            <div class="col-md-6">
                                <input id="lastname" type="text"
                                       class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                       value="{{ old('lastname') }}" required autocomplete="lastname" autofocus
                                       placeholder="Фамилия">

                                @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email"
                                   class="col-md-4 col-form-label text-md-end"></label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror" name="email"
                                       value="{{ old('email') }}" required autocomplete="email" placeholder="E-mail">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="country"
                                   class="col-md-4 col-form-label text-md-end"></label>

                            <div class="col-md-6">
                                <input id="country" type="text"
                                       class="form-control @error('country') is-invalid @enderror" name="country"
                                       value="{{ old('country') }}" required autocomplete="country"
                                       placeholder="Страна">

                                @error('country')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="city"
                                   class="col-md-4 col-form-label text-md-end"></label>

                            <div class="col-md-6">
                                <input id="city" type="text"
                                       class="form-control @error('city') is-invalid @enderror" name="city"
                                       value="{{ old('city') }}" required autocomplete="city"
                                       placeholder="Город">

                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone"
                                   class="col-md-4 col-form-label text-md-end"></label>

                            <div class="col-md-6">
                                <input id="phone" type="text"
                                       class="form-control @error('phone') is-invalid @enderror" name="phone"
                                       value="{{ old('phone') }}" required autocomplete="phone"
                                       placeholder="Телефон">

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-5">
                            <label for="password"
                                   class="col-md-4 col-form-label text-md-end"></label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required autocomplete="new-password" placeholder="Пароль">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-5 text-center">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="booking-button rounded-2">
                                    Зарегистрироваться
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#avatar').change(function() {
                if (this.files && this.files[0]) {
                    let reader = new FileReader();

                    reader.onload = function(e) {
                        $('.avatar-placeholder').hide();
                        $('.avatar-preview').html('<img src="' + e.target.result + '" alt="Avatar Preview">');
                    }

                    reader.readAsDataURL(this.files[0]);
                }
            });

            $('.avatar-preview, .avatar-placeholder').on('click', function() {
                $('#avatar').val('');
                $('.avatar-placeholder').show();
                $('.avatar-preview').html('');
            });
        });
    </script>
@endsection
