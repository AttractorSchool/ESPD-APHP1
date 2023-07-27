{{--<p>ФИО: {{ $data['name'] }} </p>--}}
{{--<p>Компания: {{ $data['company'] }}</p>--}}
{{--<p>Email: {{ $data['email'] }}</p>--}}
{{--<p>Отзыв: {{ $data['feedback'] }}</p>--}}

@if($data['type']==1)
    <div>
        <h1>Привет {{ $data['name'] }} к вам поступило 1 уведомление по поводу дружбы</h1>
        <h3>К вам поступил запрос на дружбу с резидентом {{ $data['sender']->name }}</h3>
        <img src="{{ asset('storage/' . $data['sender']->avatar) }}" alt="Avatar"
             class="rounded-5 col-3 m-0"
             style="height: 3.8rem">
        <p>Зайдите на сайт <a href="{{route('home')}}">WCC</a> и подтвердите заявку на дружбу для перехода в чат</p>
    </div>
@else
    <div>
        <h1>Привет {{ $data['name'] }} к вам поступило 1 уведомление</h1>
        <h3>К вам поступило уведомление {{ $data['title'] }} </h3>
        <p>{{$data['body']}}</p>
        <p>Зайдите на сайт <a href="{{route('home')}}">WCC</a> и подтвердите заявку на дружбу для перехода в чат</p>
    </div>
@endif
