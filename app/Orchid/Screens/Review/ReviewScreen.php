<?php

namespace App\Orchid\Screens\Review;

use App\Models\Review;
use App\Orchid\Layouts\Review\ReviewListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class ReviewScreen extends Screen
{
    /** @var string $name */
    public string $name = 'Отзывы';
    /** @var string $description */
    public string $description = 'Отзывы в главной страницы';

    /**
     * @return array
     */
    public function query(): iterable
    {
        return [
            'reviews' => Review::filters()->defaultSort('id')->paginate(7)
        ];
    }

    /**
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Создать отзыв')
                ->icon('pencil')
                ->route('platform.review.create')
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
            ReviewListLayout::class
        ];
    }
}
