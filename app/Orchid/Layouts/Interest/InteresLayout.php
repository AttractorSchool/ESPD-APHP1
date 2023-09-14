<?php

namespace App\Orchid\Layouts\Interest;

use App\Models\Interest;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class InteresLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'interests';

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
                    ->render(fn(Interest $interest) => Link::make($interest->id)
                        ->route('platform.interest.edit', compact('interest'))),
            TD::make('Имя', 'имя')
                ->render(fn(Interest $interest) => Link::make($interest->name)
                    ->route('platform.interest.edit', compact('interest'))),
            TD::make('Фото')
                ->render(function (Interest $interest) {
                    if ($interest->picture !== null){
                        if (strpos($interest->picture, 'storage') !== false){
                            return "<img src='" . asset($interest->picture) . "' width='100' height='100' style = 'border-radius:50%; object-fit: contain'>";
                        }
                        return "<img src='" . asset('storage/' . $interest->picture) . "' width='100' height='100' style = 'border-radius:50%; object-fit: contain'>";
                    }
                    return "<img src='https://gas-kvas.com/uploads/posts/2023-01/1674055606_gas-kvas-com-p-risunok-na-temu-deyatelnost-23.jpg' width='100' height='100'>";
                }),
            TD::make('updated_at', __('Last edit'))
                ->align(TD::ALIGN_RIGHT)
                ->sort()
                ->render(fn(Interest $interest) => Link::make($interest->updated_at)
                    ->route('platform.interest.edit', compact('interest'))),
        ];
    }
}
