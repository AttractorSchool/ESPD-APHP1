<?php

namespace App\Orchid\Screens\Event;

use App\Http\Requests\AdminCourseRequest;
use App\Models\Course;
use App\Models\Interest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class EventEditScreen extends Screen
{
    /** @var ?string $name */
    public ?string $name = 'Course Create';
    /** @var ?string $description */
    public ?string $description = 'Course form';
    /** @var bool $exists */
    protected bool $exists = false;

//    /** @var bool $confirm */
//    protected bool $confirm = false;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Course $course): iterable
    {
        $this->exists = $course->exists;

        if ($this->exists) {
            $this->name = 'Course Edit';
        }

        return compact('course');
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Создать курс')
                ->icon('pencil')
                ->method('save')
                ->canSee(!$this->exists),
            Button::make('Обновить курс')
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
        return [
            Layout::rows([
                Input::make('course.name')
                    ->title('Названия курса')
                    ->type('text')
                    ->required(),
                Relation::make('course.author_id')
                    ->title('Автор курса')
                    ->fromModel(User::class, 'name', 'id')->required(),
                Relation::make('course.interest_id')
                    ->title('Область интереса курса')
                    ->fromModel(Interest::class, 'name', 'id')->required(),
                Quill::make('course.mini_description')
                    ->title('Краткое описание курса')
                    ->placeholder('Course mini description')->required(),
                Quill::make('course.description')
                    ->title('Описание курса')
                    ->placeholder('Course description')->required(),
            ])
        ];
    }

    /**
     * @param Course $course
     * @param AdminCourseRequest $request
     * @return RedirectResponse
     */
    public function save(Course $course, AdminCourseRequest $request): RedirectResponse
    {
        $course->fill($request->get('course'))->save();

        Alert::info(
            sprintf(
                'You are successfully %s an course',
                $this->exists ? 'updated' : 'created'
            )
        );

        return redirect()->route('platform.course.list');
    }


    /**
     * @param Course $course
     * @return RedirectResponse
     */
    public function remove(Course $course): RedirectResponse
    {
        if ($course->delete()) {
            Alert::info('You have successfully deleted');
            return redirect()->route('platform.course.list');
        }

        Alert::warning('An error has occurred');

        return redirect()->route('platform.course.edit', $course);
    }
}
