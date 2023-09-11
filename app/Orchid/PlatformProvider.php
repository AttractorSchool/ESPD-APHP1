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
            Menu::make(__('Курсы'))
                ->icon('easel')
                ->route('platform.course.list')
                ->title(__('Course')),

            Menu::make(__('Видео курсов'))
                ->icon('camera')
                ->route('platform.video.list')
                ->title(__('Video')),

            Menu::make(__('Тесты для видео'))
                ->icon('chat-text')
                ->route('platform.question.list')
                ->title(__('Question')),

            Menu::make(__('События'))
                ->icon('geo-alt')
                ->route('platform.event.list')
                ->title(__('Event')),

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
                ->title(__('Аналитика'))
                ->divider(),

            Menu::make('Календарь')
                ->icon('calendar-plus')
                ->route('platform.calendar.list')
                ->title('Календарь')
            ->divider(),

            Menu::make('Отзывы')
                ->icon('card-text')
                ->route('platform.review.list')
                ->title('Отзывы')
            ->divider(),
            Menu::make('Уведомление')
                ->icon('bell')
                ->route('platform.notification.create')
                ->title('Уведомление')
                ->divider()
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
