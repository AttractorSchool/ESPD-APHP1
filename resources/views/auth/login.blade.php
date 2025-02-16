@extends('layouts.app')

@section('content')
    <div class="container" style="margin-bottom:1.5rem;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-header">
                    <img
                        src="https://www.allbrightcollective.com/_next/image?url=%2Fimages%2Fplus-memberships.png&w=3840&q=75"
                        alt="login" class="col-12">
                </div>

                <div class="card-body">
                    <h1 class="mt-3">{{__('AllBright Digital')}}</h1>
                    <p>{{__('Everything you need to supercharge your network and your career.')}}</p>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email"
                                   class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror" name="email"
                                       value="{{ old('email') }}" required autocomplete="email" autofocus
                                       placeholder="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password"
                                   class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required autocomplete="current-password"
                                       placeholder="password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{--                        <div class="row mb-3">--}}
                        {{--                            <div class="col-md-6 offset-md-4">--}}
                        {{--                                <div class="form-check">--}}
                        {{--                                    <input class="form-check-input" type="checkbox" name="remember"--}}
                        {{--                                           id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

                        {{--                                    <label class="form-check-label" for="remember">--}}
                        {{--                                        {{ __('Remember Me') }}--}}
                        {{--                                    </label>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        <div class="row mb-0">
                            <div class="col-12 offset-md-4">
                                <button type="submit" class="btn btn-success rounded-5 col-12">
                                    {{ __('Continue >') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link col-12 text-center" href="{{ route('password.request') }}">
                                        {{ __('Reset password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

