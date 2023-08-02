<!DOCTYPE html>
<html>

<head>
    <title>Тестирование</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>

<div class="background-test-academy d-flex" style="height: 100vh">
    <div class="exit_del" style="position: absolute;margin: 2vh">
        <form action="{{ route('academy.skipTest', ['video' => $video]) }}" method="POST">
            @method('delete')
            @csrf
            <button class="no_overflow btn btn-link text-white text-decoration-none" style="font-size: 5rem">X</button>
        </form>
    </div>
    <div class="bg-white rounded-5 text-center p-5" style="height: 60vh;width:55rem;margin: auto;font-size: 2.6rem">
        <p style="font-size: 3rem" class="fw-bolder mt-5">Выбирите правильный ответ</p>
        <form id="quizForm" action="{{route('academy.countPoints')}}" method="post">
            @csrf
            <input type="hidden" name="video" value="{{$video->id}}">
            @foreach($video->questions as $index => $question)
                @if(count($video->questions)-1!==$index)
                    <div class="question" style="display: {{$index === 0 ? 'block' : 'none'}};">
                        <p class="my-5">{{$question->question}}</p>
                        <div class="d-flex row justify-content-around">
                            @foreach($question->answers as $answer)
                                <label
                                    class="bg-primary-subtle rounded-5 col-5 my-3 text-center align-items-center d-flex"
                                    style="height: 250px">
                                    <input type="radio" name="question{{$index}}" value="{{$answer->id}}"
                                           class="d-none">
                                    <p style="margin: 0 auto">{{$answer->text}}</p>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="question" style="display: {{$index === 0 ? 'block' : 'none'}};">
                        <p class="my-5">{{$question->question}}</p>
                        <div class="d-flex row justify-content-around">
                            @foreach($question->answers as $answer)
                                <label
                                    class="bg-primary-subtle rounded-5 col-5 my-3 text-center align-items-center d-flex"
                                    style="height: 250px" for="send">
                                    <input type="radio" name="question{{$index}}" value="{{$answer->id}}"
                                           class="d-none">
                                    <p style="margin: 0 auto">{{$answer->text}}</p>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
            <button type="button" id="nextButton" class="btn btn-link d-none">Далее</button>
            <button type="submit" id="submitButton" style="display: none;margin: 240px auto;font-size: 2.5rem"
                    class="btn btn-outline-success rounded-5 col-8">
                Завершить тестирование
            </button>
        </form>
        <div id="nextButton" style="height: 20vh"></div>
        <progress id="myProgress" value="0" max="{{count($video->questions)+1}}" class="col-10" style=""></progress>
    </div>
    <div class="exit_del" style="position: absolute;bottom: 3vh;right:3vh" id="skip">
        <form action="{{ route('academy.skipTest', ['video' => $video]) }}" method="POST">
            @method('delete')
            @csrf
            <button class="no_overflow btn btn-link text-white text-decoration-none" style="font-size: 3rem">Skip
            </button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('quizForm');
        const questions = form.querySelectorAll('.question');
        const nextButton = document.getElementById('nextButton');
        const submitButton = document.getElementById('submitButton');
        const progressElement = document.getElementById('myProgress');
        const skip = document.getElementById('skip');
        let currentQuestion = 0;

        const labels = document.querySelectorAll('label');

        labels.forEach(label => {
            label.addEventListener('click', () => {
                const labelFor = label.getAttribute('for');

                if (labelFor === 'send') {
                    submitButton.click();
                } else {
                    nextButton.click();
                }
            });
        });


        function showQuestion(index) {
            for (let i = 0; i < questions.length; i++) {
                questions[i].style.display = (i === index) ? 'block' : 'none';
            }
        }

        function onNextButtonClick() {
            let currentValue = parseFloat(progressElement.getAttribute('value'));
            currentValue++;
            progressElement.setAttribute('value', currentValue);

            const currentAnswers = questions[currentQuestion].querySelectorAll('input[type="radio"]:checked');
            if (currentAnswers.length > 0) {
                currentQuestion++;
                if (currentQuestion < questions.length) {
                    showQuestion(currentQuestion);
                    if (currentQuestion === questions.length - 1) {
                        nextButton.style.display = 'none';
                        progressElement.style.display = 'none';
                        skip.style.display = 'none';
                        // submitButton.style.display = 'block';
                    }
                }
            }
        }

        nextButton.addEventListener('click', onNextButtonClick);
    });
</script>
</body>

</html>
