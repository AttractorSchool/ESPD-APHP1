<?php

namespace App\Orchid\Screens\Course;

use App\Models\Course;
use App\Orchid\Layouts\Course\CourseListLayout;
use App\Orchid\Layouts\Event\EventListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class CourseListScreen extends Screen
{
    /** @var string $name */
    public string $name = 'Курсы';
    /** @var string $description */
    public string $description = 'Все курсы';

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'сourses' => Course::filters()->defaultSort('id')->paginate()
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
            Link::make('Создать курс')
                ->icon('pencil')
                ->route('platform.course.create')
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
//            EventListLayout::class
            CourseListLayout::class
        ];
    }
}
