<?php

namespace App\Orchid\Layouts\Review;

use App\Models\Review;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ReviewListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'reviews';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'id')
                ->sort()
                ->filter()
                ->render(fn(Review $review) => Link::make($review->id)
                    ->route('platform.review.edit', compact('review'))),

            TD::make('user_id', 'Автор')
            ->render(fn(Review $review) => Link::make($review->user->name)
                ->route('platform.review.edit', compact('review'))),

            TD::make('body', 'Отзыв')
                ->render(fn(Review $review) => Link::make($review->body)
                    ->route('platform.review.edit', compact('review')))
            ->align(TD::ALIGN_RIGHT)
        ];
    }
}
