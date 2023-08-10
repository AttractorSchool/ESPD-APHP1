<!DOCTYPE html>
<html>

<head>
    <title>Тестирование</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>

<div class="background-test-academy d-flex" style="height: 100vh">
    <div class="text-center p-5" style="height: 90vh;width:55rem;margin: auto;font-size: 2.6rem">
        <p>Результат теста</p>
        <p>Ты молодец,ответил на {{$score->score}} из 4</p>
        <button type="submit" id="submitButton" style="display: none;margin: 240px auto;font-size: 2.5rem"
                class="btn btn-outline-success rounded-5 col-8">
            Завершить тестирование
        </button>
        <progress id="myProgress" value="100" max="100" class="col-10" style=""></progress>
    </div>
</div>
</body>

</html>
