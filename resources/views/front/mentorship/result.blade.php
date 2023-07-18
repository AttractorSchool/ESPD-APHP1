@extends('layouts.app')

@section('content')
    <div class="result-container">
        <div class="result-card">
            <div class="result-card-body">
                <h2 class="result-card-title">Рекомендуемый ментор</h2>
                <p class="result-card-text"><strong>Имя ментора:
                        <a class="mentor-link" href="{{ route('mentors.show', ['id' => $selectedMentor->id]) }}"> {{ $selectedMentor->name }}</a>
                    </strong></p>
                <p class="result-card-text"><strong>Схожий интерес:</strong> {{ $interest->name }}</p>
            </div>
        </div>
    </div>
@endsection
