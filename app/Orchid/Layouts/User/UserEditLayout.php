<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Facades\Layout;

class UserEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('user.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name')),

            Input::make('user.lastname')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Lastname'))
                ->placeholder(__('Lastname')),


            Input::make('user.email')
                ->type('email')
                ->required()
                ->title(__('Email'))
                ->placeholder(__('Email')),

            Input::make('user.country')
                ->type('text')
                ->required()
                ->title(__('Country'))
                ->placeholder(__('Country')),

            Input::make('user.city')
                ->type('text')
                ->required()
                ->title(__('City'))
                ->placeholder(__('City')),

            Input::make('user.phone')
                ->type('text')
                ->required()
                ->title(__('Phone'))
                ->placeholder(__('Phone')),

            Picture::make('user.avatar')
                ->title('Фото пользователя')
                ->storage('public')
                ->targetRelativeUrl(),
        ];
    }
}
