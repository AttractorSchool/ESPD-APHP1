@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="{{asset('css\chat.css')}}">
    <title>Chat</title>
</head>
<body>

<div class="wrapper-chat">
    <div class="title">Chat with
        <div class="icon">
        </div>
    </div>
    <div class="body">
        <div class="box">
            <div id="messages">
                <p></p>
            </div>
        </div>
    </div>
    <div class="typing-area">
        <form id="messageForm" action="{{route('chat.send')}}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="input-field">
                <input type="hidden" name="response_id" value="{{$response->id}}">
                <input id="body" name="body" type="text" placeholder="Type your message" required>
                <button type="submit">Send</button>
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
                            console.log('me');
                        } else if (message.user_id !== {{auth()->user()->id}}) {
                            newDiv.classList.add('other', 'col-12');
                            console.log('other');
                        }
                        var messageElement = document.createElement('p');
                        messageElement.classList.add('col-5', 'text-chat');
                        messageElement.textContent = message.body;


                        newDiv.appendChild(messageElement);
                        messagesDiv.appendChild(newDiv);
                        console.log(newDiv);
                        console.log(messagesDiv);
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
</body>
</html>
@endsection

