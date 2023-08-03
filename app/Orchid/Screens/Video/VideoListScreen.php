<?php

namespace App\Orchid\Screens\Video;

use App\Models\Course;
use App\Models\Video;
use App\Orchid\Layouts\Video\VideoListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class VideoListScreen extends Screen
{
    /** @var string $name */
    public string $name = 'Видио с курсов';
    /** @var string $description */
    public string $description = 'Все видео';

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'videos' => Video::filters()->defaultSort('id')->paginate()
        ];
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Создать видео')
                ->icon('pencil')
                ->route('platform.video.create')
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            VideoListLayout::class
        ];
    }
}
