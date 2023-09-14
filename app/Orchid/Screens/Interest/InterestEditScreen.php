<?php

namespace App\Orchid\Screens\Interest;

use App\Models\Interest;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class InterestEditScreen extends Screen
{
    public $interest;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Interest $interest): iterable
    {
        return [
            'interest' => $interest
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->interest->exists ? 'Изменить интерес' : 'Создать новый интерес';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Создать интерес')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->interest->exists),

            Button::make('Обновить интерес')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->interest->exists),

            Button::make('Убрать интерес')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->interest->exists),
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
                Input::make('interest.name')
                ->title('Название интереса')
                    ->placeholder('Введите название интереса')
                ->required(),

                Picture::make('interest.picture')
                    ->title('Фото для интереса')
                    ->storage('public')
                    ->targetRelativeUrl(),
            ])
        ];
    }
    public function createOrUpdate(Interest $interest, Request $request)
    {
        $request->validate([
                'interest.name'    => 'required|min:3|max:64',
                'interest.picture' => 'required'
            ]
        );
        $interest->fill($request->get('interest'))->save();

        Alert::info('Успешно создался календарь');

        return redirect()->route('platform.interest.list');
    }
    public function remove(Interest $interest)
    {
        $interest->delete();
        Alert::info('Успешно удалился календарь');
        return redirect()->route('platform.interest.list');
    }
}
