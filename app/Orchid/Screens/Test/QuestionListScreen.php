<?php

namespace App\Orchid\Screens\Test;

use App\Models\Course;
use App\Models\Question;
use App\Orchid\Layouts\Course\EventListLayout;
use App\Orchid\Layouts\Test\QuestionListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class QuestionListScreen extends Screen
{
    /** @var string $name */
    public string $name = 'Вопросы для теста';
    /** @var string $description */
    public string $description = 'Все вопросы';

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'questions' => Question::filters()->defaultSort('id')->paginate()
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
            Link::make('Создать вопрос для тестирования')
                ->icon('pencil')
                ->route('platform.question.create')
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
            QuestionListLayout::class
        ];
    }
}
