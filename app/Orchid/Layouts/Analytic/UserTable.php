<?php

namespace App\Orchid\Layouts\Analytic;

use App\Models\City;
use Orchid\Platform\Models\User;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class UserTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'users';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('name', 'Имя')->sort(),
            TD::make('last_login_at', 'Последний вход'),
        ];
    }
}
