@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h5 class="mb-5">Добро пожаловать на WCC тест!</h5>
        <div class="purple-card">
            <div class="purple-card-content">
                <div class="purple-card-balls"></div>
            </div>
        </div>
        <form action="{{ route('mentorship.result') }}" method="POST">
            @csrf
            <div class="question-card">
                <label for="interest">Что из нижеперечисленного вам по душе?</label><br>
            </div>
            @foreach ($interests->take(4) as $interest)
                <div class="text-start mt-4 my-card">
                    <input type="radio" id="interest{{ $interest->id }}" name="interest" value="{{ $interest->id }}">
                    <label class="mb-0" for="interest{{ $interest->id }}">{{ $interest->name }}</label>
                </div>
            @endforeach
            <button type="submit" class="mt-5 my-custom-btn">Следующий вопрос</button>
        </form>
    </div>
@endsection

@section('js')
    <script>
        function getRandomNumber(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        function getRandomColor() {
            return '#AD43C7';
        }

        function checkCollision(circles, x, y, diameter) {
            for (let i = 0; i < circles.length; i++) {
                const circle = circles[i];
                const circleX = parseInt(circle.style.left, 10);
                const circleY = parseInt(circle.style.top, 10);
                const circleDiameter = parseInt(circle.style.width, 10);

                const dx = x - circleX;
                const dy = y - circleY;
                const distance = Math.sqrt(dx * dx + dy * dy);

                if (distance < (diameter / 2 + circleDiameter / 2)) {
                    return true;
                }
            }

            return false;
        }

        function drawCircles(count) {
            const container = document.querySelector('.purple-card-content');
            const cardWidth = container.offsetWidth;
            const cardHeight = container.offsetHeight;
            const circles = [];

            for (let i = 0; i < count; i++) {
                const circle = document.createElement('div');
                const diameter = getRandomNumber(30, 80);
                const color = getRandomColor();
                let x, y;

                do {
                    x = getRandomNumber(0, cardWidth - diameter);
                    y = getRandomNumber(0, cardHeight - diameter);
                } while (checkCollision(circles, x, y, diameter));

                circle.style.width = `${diameter}px`;
                circle.style.height = `${diameter}px`;
                circle.style.backgroundColor = color;
                circle.style.borderRadius = '50%';
                circle.style.position = 'absolute';
                circle.style.top = `${y}px`;
                circle.style.left = `${x}px`;

                container.appendChild(circle);
                circles.push(circle);
            }
        }

        drawCircles(5);
    </script>
@endsection
