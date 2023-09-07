<?php

namespace App\Orchid\Layouts\Event;

use App\Models\Course;
use App\Models\Event;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class   EventListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'events';

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
                ->render(fn(Event $event) => Link::make($event->id)
                    ->route('platform.event.edit', ['event' => $event])),
            TD::make('picture')
                ->render(function (Event $event) {
                    if ($event->picture !== null){
                        if (strpos($event->picture, 'storage') !== false){
                            return "<img src='" . asset($event->picture) . "' width='100' height='100'>";
                        }
                        return "<img src='" . asset('storage/' . $event->picture) . "' width='100' height='100'>";
                    }
                    return "<img src='https://i.pinimg.com/originals/9a/7c/6c/9a7c6c2c028e05473faf627ac33cef94.jpg' width='100' height='100'>";
                }),
            TD::make('title', 'Названия')
                ->render(fn(Event $event) => Link::make($event->title)
                    ->route('platform.event.edit', ['event' => $event])),
            TD::make('date', 'Дата')
                ->render(fn(Event $event) => ($event->date)),
            TD::make('price', 'Цена')
                ->render(fn(Event $event) => ($event->price)),
//            TD::make('mini_description', 'Короткое описание')
//                ->render(fn(Course $course) => ($course->mini_description)),
            TD::make('description', 'Описание')
                ->render(fn(Event $event) => ($event->description)),


        ];
    }
}
