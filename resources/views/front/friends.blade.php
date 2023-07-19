@extends('layouts.chat')
@section('content')

    <div>
        {{--        style="margin-top: rem "--}}
        {{--        <div class="d-flex">--}}
        {{--            <h2 class="text-dark">Chat WCG</h2>--}}
        {{--        </div>--}}
        @if($responses->isNotEmpty())
            <div class="list-group mt-3">
                @foreach($responses as $response)
                    {{--                    {{$response->print(route('showChat',['id'=>$response->id]))}}--}}
                    <a href="{{route('showChat',['id'=>$response->id])}}"
                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <div class="d-flex row col-11">
                            <img src="https://media.sproutsocial.com/uploads/2022/06/profile-picture.jpeg" alt="Иван"
                                 class="rounded-5 col-3 m-0" style="height: 3.8rem">
                            <div class="d-flex flex-column col-9 m-0">
                                @if($response->first->id==Auth::user()->id)
                                    <span class="ml-2 fs-6">{{$response->second->name}}</span>
                                @else
                                    <span class="ml-2 fs-6">{{$response->first->name}}</span>
                                @endif
                                <p class="text-dark text-start fst-italic"
                                   style="height: 2rem">{{$response->last_Message()->body}}</p>
                            </div>
                        </div>
                        <span
                            class="badge badge-primary badge-pill text-dark">{{$response->last_Message()->created_at->format('D')}}
                        </span>
                    </a>
                @endforeach
            </div>
        @else
            <h1>На данный момент нету доступных чатов</h1>
        @endif
    </div>

@endsection

