@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('home') }}" class="arrow" >
                    <i class="fa fa-arrow-left" style="color: #000"></i>
                </a>
                <span>Мой профиль</span>
                <div class="profile-body">
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-4 avatar-profile">
                            <label for="picturePreview" class="photo-add">Добавить фото</label>
                            <input type="file" name="avatar" class="form-control-file d-none" id="picturePreview" accept="image/*" onchange="preview()">
                            <img id="avatarPreview"
                                 @if(isset($user, $user->avatar)) src="{{ asset('/storage/' . $user->avatar) }}"
                                 @endif style="width:75px;height:75px;" class="mb-1">
                        </div>
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Имя" value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <input type="text" name="lastname" class="form-control" placeholder="Фамилия" value="{{ $user->lastname }}">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}">
                        </div>

                        <div class="form-group">
                            <input type="text" name="country" class="form-control" placeholder="Страна" value="{{ $user->country }}">
                        </div>

                        <div class="form-group">
                            <input type="text" name="city" class="form-control" placeholder="Город" value="{{ $user->city }}">
                        </div>

                        <div class="form-group">
                            <input type="text" name="phone" class="form-control" placeholder="Телефон" value="{{ $user->phone }}">
                        </div>

                        <div class="form-group">
                            <input type="text" name="description" class="form-control" placeholder="Описание" value="{{ $user->description }}">
                        </div>

                        <div class="form-group" id="interests-select-container">
                            <label for="interests">Выбрать интересы</label>
                            <select id="interests" class="form-select" name="interests[]" multiple>
                                @foreach ($interests as $interest)
                                    <option value="{{ $interest->id }}">{{ $interest->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="interests-container">
                                @foreach ($user->interests as $interest)
                                    <input type="text" class="form-control" name="selected_interests[]" value="{{ $interest->name }}" readonly>
                                @endforeach
                            </div>
                        </div>
                        <button class="btn-save btn" style="background-color: #804EEB; width: 100%">Сохранить данные</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function preview() {
            const input = event.currentTarget;
            const imagePreview = document.getElementById('avatarPreview');
            imagePreview.src = URL.createObjectURL(input.files[0]);
        }

    </script>
@endsection


