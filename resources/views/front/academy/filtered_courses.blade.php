@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ url()->previous() }}" class="arrow-back-register mb-2"><i class="fas fa-arrow-left"></i></a>
        <div class="form-group has-search">
            <span class="fa fa-search form-control-feedback coursesSearch"></span>
            <input type="text" class="form-control" placeholder="Search courses..." id="courseSearch">
        </div>
        @foreach($authors as $author)
        @endforeach
        <h5 class="checkCourses">Check the course</h5>
        @foreach ($courses as $course)
            @php
                $author = $authors->firstWhere('id', $course->author_id)
            @endphp
            <div class="card bg-dark text-white course-card">
                <img class="card-img course-img"
                     src="https://d1ymz67w5raq8g.cloudfront.net/Pictures/1024x536/P/web/n/z/b/onlinecourses_shutterstock_490891228_2000px_728945.jpg"
                     alt="Card image">
                <div class="card-img-overlay">
                    <h5 class="card-title">
                        <a class="course-title" href="{{route('show.course', ['id' => $course->id])}}">{{ $course->name }} </a>
                    </h5>
                    <p class="card-text-course-text">{{$course->mini_description}}</p>
                    <p class="card-text-course-bottom">Author: {{$author->name}}</p>
                    <form method="POST" action="{{ route('favourite.save') }}" >
                        @csrf

                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        <button type="submit" class="favorite-btn" data-course-id="{{ $course->id }}" style="background-color: {{\App\Models\Favourite::where('course_id', $course->id)->where('user_id', \Illuminate\Support\Facades\Auth::id())->first() ? '#27ae60' : '#fffff'}}"></button>
                    </form>
                </div>
            </div>
            </a>
        @endforeach
    </div>
    <script>
        let selectedInterests = @json($selectedInterests ?? []);
        const courseSearch = document.getElementById('courseSearch');
        const searchBtn = document.getElementById('searchBtn');

        function performSearch() {
            const searchTerm = courseSearch.value.trim();

            const url = '{{ route('filtered.courses') }}' + '?' + 'interests[]=' + selectedInterests.join('&interests[]=')
                + (searchTerm ? '&search=' + encodeURIComponent(searchTerm) : '');
            window.location.href = url;
        }

        courseSearch.addEventListener('keypress', function (event) {
            if (event.key === 'Enter') {
                performSearch();
            }
        });
        const favoriteButtons = document.querySelectorAll('.favorite-btn');

        favoriteButtons.forEach(button => {
            button.addEventListener('click', function () {
                this.classList.toggle('active');
            });
        });

    </script>
@endsection
