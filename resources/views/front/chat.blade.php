@extends('layouts.app')
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
    </style>
    <div class="wrapper-chat" style="margin:-1.6rem 0; height: 100vh">
        <div class="title">Chat with "{{$response->first->name}}"
            <div class="icon"></div>
        </div>
        <div class="body">
            <div class="box">
                <div id="messages"></div>
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

