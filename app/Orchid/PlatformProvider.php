<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Dashboard $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [
            Menu::make(__('Users'))
                ->icon('bs.person-circle')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')

                ->title(__('Все пользователи'))
                ->divider(),

            Menu::make(__('Roles'))
                ->icon('bs.award')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles')
                ->title('Роли')
                ->divider(),

            Menu::make('Аналитика')
                ->icon('bs.person')
                ->route('platform.analytic')
                ->title(__('Аналитика')),
        ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }
}
