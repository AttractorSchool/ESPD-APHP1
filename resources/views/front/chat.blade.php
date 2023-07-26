@extends('layouts.app')
{{--<link href="{{ asset('css/media.css') }}" rel="stylesheet">--}}
@section('content')
    <style>
        .icon {
            background-image: url("https://www.art-spb.ru/upload/good_image/16324.jpg");
        }
        ::-webkit-scrollbar {
            width: 0.5rem;
        }

        ::-webkit-scrollbar-track {
            background: darkgray;
        }

        ::-webkit-scrollbar-thumb {
            background-color: lightslategray;
            border-radius: 1rem;
            background-clip: content-box;
        }
        .default_messages{
            min-height: 40px;
            background-color: #EAE5DF;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }
        .default_messages .default_message{
            width: 48%;
            height: 30px;
            display: flex;
            justify-content: center;
        }
        .default_messages .default_message .default_button{
            border: none;
            border-radius: 20px;
            background-color: white;
            color: black;
            font-size: 10px;
            padding: 0 5px;
        }
    </style>
    <div class="wrapper-chat" style=" height: 85vh">
        <div class="title">Chat with "{{$response->first->name}}"
            <div class="icon"></div>
        </div>
        <div class="body">
            <div class="box">
                <div id="messages">
                    @if(!count($response->messages))
                        <h1>Вы еще не общались</h1>
                        <div class="default_messages">
                                <form class="default_message" id="messageForm" action="{{route('chat.send')}}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <input type="hidden" name="response_id" value="{{$response->id}}">
                                    <input type="hidden" id="body" name="body" value="Привет! Как у вас дела?">
                                    <button type="submit" class="default_button">Привет! Как у вас дела?</button>
                                </form>

                                <form class="default_message" id="messageForm" action="{{route('chat.send')}}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <input type="hidden" name="response_id" value="{{$response->id}}">
                                    <input type="hidden" id="body" name="body" value="Здравствуйте! Как ваши дела?">
                                    <button type="submit" class="default_button">Здравствуйте! Как ваши дела?</button>
                                </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="typing-area container">
            <form id="messageForm" action="{{route('chat.send')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <input type="hidden" name="response_id" value="{{$response->id}}">
                <div class="d-flex row align-items-center">
                    <div class="mb-3 col-9">
                        <label for="body" class="form-label">Type your message</label>
                        <input type="text" class="form-control" id="body" name="body">
                    </div>
                    <button type="submit" class="col-3 btn btn-primary" style="height: 30%">Send</button>
                </div>
            </form>
        </div>
    </div>
    <button id="showModal" class="d-none"></button>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var messageForm = document.getElementById('messageForm');
            var messagesDiv = document.getElementById('messages');
            var showModalBtn = document.getElementById('showModal');
            var errorDiv = document.getElementById('error');

            messageForm.addEventListener('submit', function (e) {
                e.preventDefault();

                var formData = new FormData(messageForm);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('chat.send') }}', true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);

                        var messageElement = document.createElement('p');
                        messageElement.textContent = response.body;

                        var newDiv = document.createElement('div');
                        newDiv.classList.add('me', 'col-12');

                        messageElement.classList.add('col-5', 'text-chat');

                        newDiv.appendChild(messageElement);
                        messagesDiv.appendChild(newDiv);

                        var bodyInput = document.getElementById('body');
                        bodyInput.value = '';
                    } else {
                        errorDiv.style.display = 'block';
                        errorDiv.textContent = 'Произошла ошибка при выполнении запроса.';
                    }
                };
                xhr.onerror = function () {
                    errorDiv.style.display = 'block';
                    errorDiv.textContent = 'Произошла ошибка при выполнении запроса.';
                };
                xhr.send(formData);
            });

            showModalBtn.addEventListener('click', function () {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '{{ route('chat.show', ['id'=>$response->id]) }}', true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        messagesDiv.innerHTML = '';
                        response.forEach(function (message) {
                            var newDiv = document.createElement('div');
                            if (message.user_id === {{auth()->user()->id}}) {
                                newDiv.classList.add('me', 'col-12');
                            } else if (message.user_id !== {{auth()->user()->id}}) {
                                var icon = document.createElement('div');
                                icon.classList.add('icon');
                                newDiv.appendChild(icon);
                                newDiv.classList.add('other', 'col-12');
                            }
                            var messageElement = document.createElement('p');
                            messageElement.classList.add('col-5', 'text-chat');
                            messageElement.textContent = message.body;


                            newDiv.appendChild(messageElement);
                            messagesDiv.appendChild(newDiv);
                        });
                    } else {
                        console.error('Произошла ошибка при выполнении запроса.');
                    }
                };
                xhr.onerror = function () {
                    console.error('Произошла ошибка при выполнении запроса.');
                };
                xhr.send();
            });

            function autoClick() {
                showModalBtn.click();
            }

            setInterval(autoClick, 3000);

        });
    </script>
@endsection

