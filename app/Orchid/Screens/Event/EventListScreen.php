<?php

namespace App\Orchid\Screens\Event;

use App\Models\Course;
use App\Models\Event;
use App\Orchid\Layouts\Event\EventListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class EventListScreen extends Screen
{
    /** @var string $name */
    public string $name = 'Мероприятия';
    /** @var string $description */
    public string $description = 'Все мероприятия';

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'events' => Event::filters()->orderBy('id', 'desc')->defaultSort('id')->paginate(5)
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
            Link::make('Создать мероприятие')
                ->icon('pencil')
                ->route('platform.event.create')
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
            EventListLayout::class
        ];
    }
}
