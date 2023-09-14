<?php

namespace App\Orchid\Screens\Interest;

use App\Models\Interest;
use App\Orchid\Layouts\Interest\InteresLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;

class InterestScreen extends Screen
{

    /** @var string $name */
    public string $name = 'Интересы';
    /** @var string $description */
    public string $description = 'Интересы для курсов';

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'interests' => Interest::filters()->defaultSort('id')->paginate()
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
            Link::make('Создать интерес')
                ->icon('pencil')
                ->route('platform.interest.create')
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
            InteresLayout::class
        ];
    }
}
