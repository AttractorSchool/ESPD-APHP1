<?php

namespace App\Orchid\Layouts\Course;

use App\Models\Course;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CourseListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'сourses';

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
                ->render(fn(Course $course) => Link::make($course->id)
                    ->route('platform.course.edit', ['course' => $course])),
            TD::make('picture')
                ->render(function (Course $course) {
                    if ($course->photo !== null){
                        if (strpos($course->photo, 'storage') !== false){
                            return "<img src='" . asset($course->photo) . "' width='100' height='100'>";
                        }
                        return "<img src='" . asset('storage/' . $course->photo) . "' width='100' height='100'>";
                    }
                    return "<img src='https://static.tildacdn.com/tild3233-6135-4939-b563-333265623830/onlajn-kursy3.jpg' width='100' height='100'>";
                }),
            TD::make('name', 'Названия')
                ->render(fn(Course $course) => Link::make($course->name)
                    ->route('platform.course.edit', ['course' => $course])),
            TD::make('author_id', 'Автор')
                ->render(fn(Course $course) => ($course->user->name)),
            TD::make('interest_id', 'Интерес')
                ->render(fn(Course $course) => ($course->interests->name)),
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
