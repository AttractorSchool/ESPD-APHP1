<?php

namespace App\Orchid\Screens\Calendar;

use App\Models\Calendar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class CalendarEditScreen extends Screen
{
    /**
     * @var Calendar
     */
    public $calendar;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Calendar $calendar): iterable
    {
        $calendar->load('attachment');
        return [
            'calendar' => $calendar
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->calendar->exists ? 'Поменять календарь' : 'Создать новый календарь';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Создать календарь')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->calendar->exists),

            Button::make('Обновить календарь')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->calendar->exists),

            Button::make('Убрать календарь')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->calendar->exists),
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
                Upload::make('calendar.attachment')
                    ->title('Файл календаря')
                    ->placeholder('Загрузите файл')
                ->storage('public')
//                    ->help('The name of the task to be created.')
                    ,
                Input::make('calendar.created_at')
                    ->type('hidden')
                    ->value(Carbon::now()),

                Input::make('calendar.updated_at')
                    ->type('hidden')
                    ->value(Carbon::now())
            ])
        ];
    }
    public function createOrUpdate(Calendar $calendar, Request $request)
    {
        $calendar->fill($request->get('calendar'))->save();

        $calendar->attachment()->syncWithoutDetaching(
            $request->input('calendar.attachment', [])
        );
        Alert::info('Успешно создался календарь');

        return redirect()->route('platform.calendar.list');
    }
    public function remove(Calendar $calendar)
    {
        if ($calendar->attachment()->exists()){
            $calendar->attachment()->delete();
        }
        $calendar->delete();
        Alert::info('Успешно удалился календарь');
        return redirect()->route('platform.calendar.list');
    }
}
