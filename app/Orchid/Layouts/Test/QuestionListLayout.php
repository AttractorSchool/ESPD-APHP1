<?php

namespace App\Orchid\Layouts\Test;

use App\Models\Course;
use App\Models\Question;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class QuestionListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'questions';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'Id')
                ->sort()
                ->filter()
                ->render(fn(Question $question) => Link::make($question->id)
                    ->route('platform.question.edit', compact('question'))),
            TD::make('name', 'Вопрос')
                ->render(fn(Question $question) => Link::make($question->question)
                    ->route('platform.question.edit', compact('question'))),
            TD::make('video_id', 'Для какого видео вопрос')
                ->render(fn(Question $question) => ($question->video->name)),
//            TD::make('interest_id', 'Интерес')
//                ->render(fn(Question $question) => ($question->interest->name)),
//            TD::make('mini_description', 'Короткое описание')
//                ->render(fn(Course $course) => ($course->mini_description)),
//            TD::make('description', 'Описание')
//                ->render(fn(Course $course) => ($course->description)),
//            TD::make('picture')
//                ->render(function (Course $course) {
//                    return "<img src='" . asset('storage/' . $course->picture) . "' width='100' height='100'>";
//                }),

        ];
    }
}
