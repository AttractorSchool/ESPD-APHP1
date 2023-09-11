@extends('layouts.app')
<style>
    .star_rat{
        color: #4d5154;
    }
    .feedback p{
        text-decoration: underline;
        color: black;
    }
    .feedback_main p{
        font-size: 17px;
    }
    .feedback_main{
        margin: 0 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .rating_css div{
        color: #ffe400;
        font-size: 20px;
        font-weight: 800;
        text-align: center;
        text-transform: uppercase;

    }
    .rating_css input{
        display: none;
    }
    .rating_css input + label {
        font-size: 20px;
        text-shadow: 1px 1px 0 #8f8420;
        cursor: pointer;
    }
    .rating_css input:checked + label ~ label{
        color: #bfafaf;
    }
    .rating_css label:active{
        transform: scale(0.8);
        transition: 0.3s ease;
    }
</style>
@section('content')
    @foreach($authors as $author)
    @endforeach
    <a href="{{ url()->previous() }}" class="arrow-back-register mb-2"><i class="fas fa-arrow-left"></i></a>
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-0 border" style="background-color: #f0f2f5;">
                <div class="card-body p-4">
                    <div class="form-outline mb-4">
                        <div class="rating_css">
                        <form action="{{ route('comment_add') }}" method="post" class="form">
                            @csrf
                            <div class="star_icon">
                                @for($i = 1; $i < 6; $i++)
                                    <input type="radio" value="{{$i}}" name="rating" id="rating{{$i}}" @if($i === 1) checked @endif >
                                    <label for="rating{{$i}}" class="fa fa-star" ></label>
                                @endfor
                            </div>
                            <input type="hidden" name="course_id" value="{{$course->id}}">
                            <textarea type="text" name="body" id="addANote" class="form-control" placeholder="Type comment..."></textarea> </>
                            <div class="button">
                                <button type="submit" class="form-label"  style="border: none; margin-top: 5px">+ Add a note</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    @foreach ($course->comments as $comment)
                        @php
                            $author = $author->firstWhere('id', $comment->author_id);
                        @endphp
                        <div class="card mb-4">
                            <div class="card-body">
                                <p style="color: #0b4e58">{{$comment->body}}</p>
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center">
                                        <img src="{{asset('images/3.jpg')}}"
                                             alt="avatar" width="35"
                                             height="35"/>
                                        <p style="color: #1a88ff" class="small mb-0 ms-2">{{$author->name}}</p>
                                    </div>
                                    <div class="d-flex flex-row align-items-center">
                                        <p class="small text-muted mb-0">Upvote?</p>
                                        <i class="far fa-thumbs-up mx-2 fa-xs text-black"
                                           style="margin-top: -0.16rem;"></i>
                                        <p class="small text-muted mb-0">3</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
