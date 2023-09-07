<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use Illuminate\Support\Facades\Auth;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class UserListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'users';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('picture')
                ->render(function (User $user) {
                    if ($user->avatar !== null){
                        if (strpos($user->avatar, 'storage') !== false){
                            return "<img src='" . asset($user->avatar) . "' width='100' height='100'>";
                        }
                        return "<img src='" . asset('storage/' . $user->avatar) . "' width='100' height='100'>";
                    }
                    return "<img src='https://cdn4.iconfinder.com/data/icons/people-of-medical-education-and-science/512/People_Medical_Education_Science_lab_scientist_woman-1024.png' width='100' height='100'>";
                }),

            TD::make('name', __('Name'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(fn (User $user) => new Persona($user->presenter())),

            TD::make('email', __('Email'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(fn (User $user) => ModalToggle::make($user->email)
                    ->modal('asyncEditUserModal')
                    ->modalTitle($user->presenter()->title())
                    ->method('saveUser')
                    ->asyncParameters([
                        'user' => $user->id,
                    ])),
            TD::make('country', ('Country'))
                ->sort()
                ->cantHide()
                ->filter(Input::make('country'))
                ->render(fn(User $user) => Link::make($user->country)->route('platform.systems.users.edit', $user)),

            TD::make('city', 'City')
                ->render(fn(User $user) => $user->city),

            TD::make('phone', ('Phone'))
                ->sort()
                ->cantHide()
                ->filter(Input::make('phone'))
                ->render(fn(User $user) => Link::make($user->phone)->route('platform.systems.users.edit', $user)),

            TD::make('created_at', __('Created'))
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->defaultHidden()
                ->sort(),

            TD::make('updated_at', __('Last edit'))
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->sort(),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (User $user) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.systems.users.edit', $user->id)
                            ->icon('bs.pencil'),

                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                            ->method('remove', [
                                'id' => $user->id,
                            ]),
                    ])),
        ];
    }
}
