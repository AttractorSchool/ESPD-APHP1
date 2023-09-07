<?php

namespace App\Orchid\Screens\Test;

use App\Http\Requests\AdminCourseRequest;
use App\Models\Answer;
use App\Models\Course;
use App\Models\Question;
use App\Models\Video;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class QuestionEditScreen extends Screen
{
    /** @var ?string $name */
    public ?string $name = 'Создания вопроса для теста';
    /** @var ?string $description */
    public ?string $description = 'Вопрос для теста';
    /** @var bool $exists */
    protected bool $exists = false;
    /** @var ?Question $question */
    protected ?Question $question;

//    /** @var bool $confirm */
//    protected bool $confirm = false;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Question $question): iterable
    {
        $this->exists = $question->exists;

        if ($this->exists) {
            $this->name = 'Редактирования вопроса для теста';
            $question->load('answers');
            $this->question = $question;
        } else {
            $this->question = new Question();
        }

        return compact('question');
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Создать вопрос')
                ->icon('pencil')
                ->method('save')
                ->canSee(!$this->exists),
            Button::make('Обновить вопрос')
                ->icon('note')
                ->method('save')
                ->canSee($this->exists),
            Button::make('Удалить')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exists),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return Layout[]|string[]
     */
    public function layout(): iterable
    {
        $rows = $this->question->answers->map(function ($answer) {
            return Input::make('answers.' . $answer->id . '.text1')
                ->title('Ответ')
                ->type('text')
                ->value($answer->text)
                ->required();
        })->toArray();

        if (empty($rows)) {
            $rows = [
                Input::make('answers.text1')
                    ->title('Ответ')
                    ->type('text'),
                Input::make('answers.text2')
                    ->title('Ответ')
                    ->type('text'),
            ];
        }

        return [
            Layout::rows([
                Input::make('question.question')
                    ->title('Вопрос')
                    ->type('text')
                    ->required(),
                Relation::make('question.video_id')
                    ->title('Видео')
                    ->fromModel(Video::class, 'name', 'id')->required(),
            ]),
            Layout::rows($rows),
        ];
    }

    /**
     * @param Question $question
     * @param AdminCourseRequest $request
     * @return RedirectResponse
     */
    public function save(Question $question, Request $request): RedirectResponse
    {
        $question->fill($request->get('question'))->save();

        $answer1 = new Answer();
        $answer1->question_id = $question->id;
        $answer1->text        = $request->input('answers.text1');
        $answer1->boolean     = 1;
        $answer1->save();

        $answer2 = new Answer();
        $answer2->question_id = $question->id;
        $answer2->text        = $request->input('answers.text2');
        $answer2->boolean     = 0;
        $answer2->save();

        Alert::info(
            sprintf(
                'You are successfully %s an course',
                $this->exists ? 'updated' : 'created'
            )
        );

        return redirect()->route('platform.question.list');
    }


    /**
     * @param Question $question
     * @return RedirectResponse
     */
    public function remove(Question $question): RedirectResponse
    {
        if ($question->delete()) {
            Alert::info('You have successfully deleted');
            return redirect()->route('platform.question.list');
        }

        Alert::warning('An error has occurred');

        return redirect()->route('platform.question.edit', $question);
    }
}
