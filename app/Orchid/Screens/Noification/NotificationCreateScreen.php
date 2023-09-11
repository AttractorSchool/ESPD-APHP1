<?php

namespace App\Orchid\Screens\Noification;

use App\Models\CustomNotification;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class NotificationCreateScreen extends Screen
{
    /** @var ?string $description */
    public ?string $description = 'Создайте уведомления для пользователя';
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            ''
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Создать уведомление';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
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

                Relation::make('notification.user_id')
                    ->title('Введите кому хотите отправить уведомление')
                    ->fromModel(User::class, 'name')->required(),

                Input::make('notification.title')
                    ->title('Напишите заголовок уведомления')->required(),

                TextArea::make('notification.body')
                    ->title('Напишите основную часть уведомления')->required(),

                Button::make('Создать календарь')
                    ->icon('pencil')
                    ->method('createOrUpdate'),
            ])
        ];
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function createOrUpdate(Request $request):RedirectResponse{
        $request->validate([
            'notification.title' => 'required|min:5|max:128',
            'notification.body'  => "required|min:10|max:256"
        ]);
        $notification = new CustomNotification();
        $notification->type= 2;
        $notification->fill($request->get('notification'))->save();
        Alert::info('Вы создали успешно уведомление!');
        return redirect()->back();
    }
}
