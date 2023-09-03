<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
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

            Input::make('user.email')
                ->type('email')
                ->required()
                ->title(__('Email'))
                ->placeholder(__('Email')),

            Input::make('user.country')
                ->type('country')
                ->required()
                ->title(__('Country'))
                ->placeholder(__('Country')),

            Input::make('user.city')
                ->type('city')
                ->required()
                ->title(__('City'))
                ->placeholder(__('City')),

            Input::make('user.phone')
                ->type('phone')
                ->required()
                ->title(__('Phone'))
                ->placeholder(__('Phone')),

        ];
    }
}
