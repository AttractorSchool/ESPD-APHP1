<?php

namespace App\Orchid\Layouts\Video;

use App\Models\Video;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class VideoListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'videos';

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
                ->render(fn(Video $video) => Link::make($video->id)
                    ->route('platform.video.edit', compact('video'))),
            TD::make('name', 'Названия')
                ->render(fn(Video $video) => Link::make($video->name)
                    ->route('platform.video.edit', compact('video'))),
            TD::make('author_id', 'Автор')
                ->render(fn(Video $video) => ($video->course->user->name)),
            TD::make('course_id', 'Курс')
                ->render(fn(Video $video) => ($video->course->name)),
        ];
    }
}
