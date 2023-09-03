@extends('layouts.app')

@section('content')
    <a href="{{ url()->previous() }}" class="arrow-back-register mb-2"><i class="fas fa-arrow-left"></i></a>
    <h1>Выберите интересы</h1>
    <div class="container">
        <div class="interests-container">
            @foreach ($interests as $interest)
                <div class="card bg-dark text-white interest-card">
                    <img src="https://rnn.ng/wp-content/uploads/2023/01/computer-sci.jpg" class="interest-img" alt="...">
                    <div>
                    </div>
                    <div class="card-img-overlay-interest  interest" data-id="{{ $interest->id }}">
                        <div class="interest-detail">
                        <h5 class="card-title interest-title" >{{ $interest->name }}</h5>
                        <p class="interest-count">{{ $interest->courses_count }} Courses
                        </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    <button type="button" class="button-68" id="showCoursesBtn">Показать курсы</button>
    </div>

    <script>
        const filteredCoursesRoute = '{{ route('filtered.courses') }}';
            const interests = document.querySelectorAll('.interest-card');

            document.getElementById('interestSearch').addEventListener('input', function () {
            const searchTerm = this.value.trim().toLowerCase();

            interests.forEach(interest => {
            const interestTitle = interest.querySelector('.interest-title').innerText.toLowerCase();
            const interestCount = interest.querySelector('.interest-count').innerText.toLowerCase();
            const isMatching = interestTitle.includes(searchTerm) || interestCount.includes(searchTerm);
            interest.style.display = isMatching ? 'block' : 'none';
        });
        });
    </script>
@endsection
