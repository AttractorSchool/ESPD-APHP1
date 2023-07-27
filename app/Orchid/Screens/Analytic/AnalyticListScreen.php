<?php

namespace App\Orchid\Screens\Analytic;

use App\Models\User;
use App\Orchid\Layouts\Analytic\UserTable;
use Carbon\Carbon;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class AnalyticListScreen extends Screen
{
    public $name ='Аналитика';
    public $description = 'Аналитика входов';
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $user = User::first();
        return [
            'users'              => User::whereNotNull('last_login_at')->filters()->defaultSort('name')->paginate(),

            'analytic_seven_day' => $user->sevenDayAnalytic(),
            'analytic_month'     => $user->monthAnalytic(),
            'analytic_year'      => $user->yearAnalytic(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Аналитика сайта';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::view('screens.batman'),
            UserTable::class
        ];
    }
}
