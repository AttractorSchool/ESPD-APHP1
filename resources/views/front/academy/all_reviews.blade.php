@extends('layouts.app')
@section('content')
    @foreach($authors as $author)
    @endforeach
    <a href="{{ url()->previous() }}" class="arrow-back-register mb-2"><i class="fas fa-arrow-left"></i></a>
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-0 border" style="background-color: #f0f2f5;">
                <div class="card-body p-4">
                    <div class="form-outline mb-4">
                        <input type="text" id="addANote" class="form-control" placeholder="Type comment..."/>
                        <label class="form-label" for="addANote">+ Add a note</label>
                    </div>
                    @foreach ($course->reviews as $review)
                        @php
                            $author = $author->firstWhere('id', $review->author_id);
                        @endphp
                        <div class="card mb-4">
                            <div class="card-body">
                                <p style="color: #0b4e58">{{$review->body}}</p>
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
