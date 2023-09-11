<?php

namespace App\Orchid\Screens\Review;

use App\Models\Review;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class ReviewEditScreen extends Screen
{

    /**
     * @var Review
     */
    public $review;
    /**
     * @return array
     */
    public function query(Review $review): iterable
    {

        return [
            'review' => $review
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->review->exists ? 'Обновить отзыв' : 'Создать отзыв';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Создать отзыв')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->review->exists),

            Button::make('Обновить отзыв')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->review->exists),

            Button::make('Удалить отзыв')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->review->exists),
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
            Layout::rows([
                Relation::make('review.user_id')
                    ->title('Выберите автора отзыва')
                    ->fromModel(User::class, 'name', 'id')->required()
                ->horizontal(),

                Input::make('review.body')
                ->title('Введите отзыв')
                ->required()
                    ->horizontal()
            ])
        ];
    }


    /**
     * @return RedirectResponse
     */
    public function createOrUpdate(Review $review, Request $request):RedirectResponse{
        $request->validate([
            'review.user_id' => 'required',
            'review.body'    => 'required|min:10|max:200'
        ]);

        $review->fill($request->get('review'))->save();

        Alert::info('Успешно создался отзыв!');

        return redirect()->route('platform.review.list');
    }

    /**
     * @return RedirectResponse
     */
    public function remove(Review $review):RedirectResponse{

        $review->delete();

        Alert::info('Успешно удалили отзыв!');

        return redirect()->route('platform.review.list');
    }
}
