@extends('layouts.chat')
@section('content')

    <div>
        @if($responses->isNotEmpty())
            <div class="list-group mt-3">
                @foreach($responses as $response)
                    <a href="{{route('showChat',['id'=>$response->id])}}"
                       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <div class="d-flex row col-11">
                            @if($response->first->id==Auth::user()->id)
                                <img src="{{ asset('storage/' . $response->second->avatar) }}" alt="Avatar"
                                     class="rounded-5 col-3 m-0"
                                     style="height: 3.8rem">
                            @else
                                <img src="{{ asset('storage/' . $response->first->avatar) }}" alt="Avatar"
                                     class="rounded-5 col-3 m-0"
                                     style="height: 3.8rem">
                            @endif
                            <div class="d-flex flex-column col-9 m-0">
                                @if($response->first->id==Auth::user()->id)
                                    <span class="ml-2 fs-6">{{$response->second->name}}</span>
                                @else
                                    <span class="ml-2 fs-6">{{$response->first->name}}</span>
                                @endif
                                <p class="text-dark text-start fst-italic"
                                   style="height: 2rem">
                                    @if(isset($response->last_Message()->body))
                                        {{$response->last_Message()->body}}
                                    @else
                                        Нету сообщении
                                    @endif
                                </p>
                            </div>
                        </div>
                        <span
                            class="badge badge-primary badge-pill text-dark">
                            @if(isset($response->last_Message()->body))
                                {{$response->last_Message()->created_at->format('D')}}
                            @else
                            @endif
                        </span>
                    </a>
                @endforeach
            </div>
        @else
            <h1>На данный момент нету доступных чатов</h1>
        @endif
    </div>

@endsection

