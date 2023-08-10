<?php

namespace App\Orchid\Screens\Event;

use App\Http\Requests\AdminCourseRequest;
use App\Models\Course;
use App\Models\Event;
use App\Models\Interest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\DateRange;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class EventEditScreen extends Screen
{
    /** @var ?string $name */
    public ?string $name = 'Event Create';
    /** @var ?string $description */
    public ?string $description = 'Event form';
    /** @var bool $exists */
    protected bool $exists = false;

//    /** @var bool $confirm */
//    protected bool $confirm = false;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Event $event): iterable
    {
        $this->exists = $event->exists;

        if ($this->exists) {
            $this->name = 'Event Edit';
        }

        return compact('event');
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Создать событие')
                ->icon('pencil')
                ->method('save')
                ->canSee(!$this->exists),
            Button::make('Обновить событие')
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
                Input::make('event.title')
                    ->title('Названия событии')
                    ->type('text')
                    ->required(),
                Input::make('event.location')
                    ->title('Локация событии')
                    ->type('text')
                    ->required(),
                Input::make('event.price')
                    ->title('Цена событии')
                    ->type('text')
                    ->required(),
                Input::make('event.quantity')
                    ->title('Количество мест событии')
                    ->type('text')
                    ->required(),
                Input::make('event.picture')
                    ->title('Количество мест событии')
                    ->type('file')
                    ->required(),
                Select::make('event.format')
                    ->title('Формат событии')
                    ->options(['online', 'offline'])
                    ->required(),
                Input::make('event.date')
                    ->title('Дата событии')
                    ->type('date')
                    ->required(),
                Relation::make('event.author_id')
                    ->title('Автор событии')
                    ->fromModel(User::class, 'name', 'id')->required(),
//                Relation::make('event.interest_id')
//                    ->title('Область интереса курса')
//                    ->fromModel(Interest::class, 'name', 'id')->required(),
//                Quill::make('event.mini_description')
//                    ->title('Краткое описание курса')
//                    ->placeholder('Event mini description')->required(),
                Quill::make('event.description')
                    ->title('Описание событии')
                    ->placeholder('Event description')->required(),
            ])
        ];
    }

    /**
     * @param Course $course
     * @param AdminCourseRequest $request
     * @return RedirectResponse
     */
    public function save(Event $event, AdminCourseRequest $request): RedirectResponse
    {
        $event->fill($request->get('event'))->save();

        Alert::info(
            sprintf(
                'You are successfully %s an event',
                $this->exists ? 'updated' : 'created'
            )
        );

        return redirect()->route('platform.event.list');
    }


    /**
     * @param Course $course
     * @return RedirectResponse
     */
    public function remove(Event $event): RedirectResponse
    {
        if ($event->delete()) {
            Alert::info('You have successfully deleted');
            return redirect()->route('platform.event.list');
        }

        Alert::warning('An error has occurred');

        return redirect()->route('platform.event.edit', $event);
    }
}
