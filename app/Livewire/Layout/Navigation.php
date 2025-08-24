<?php

namespace App\Livewire\Layout;

use Livewire\Component;

class Navigation extends Component
{
    public array $links;

    public function __construct()
    {
        $this->links = [
            'dashboard' => [
                'label' => __('amorce.page-dashboard'),
                'icon' => 'icons.dashboard',
                'href' => 'dashboard.index',
            ],
            'team' => [
                'label' => __('amorce.team'),
                'icon' => 'icons.team',
                'href' => 'team.index',
            ],
            'draw' => [
                'label' => __('amorce.navigation-draws'),
                'icon' => 'icons.nine',
                'href' => 'draw.index',
            ],
            'calendar' => [
                'label' => __('amorce.navigation-calendar'),
                'icon' => 'icons.calendar',
                'href' => 'calendar.index',
            ],
            'stock' => [
                'label' => __('amorce.misc-stock'),
                'icon' => 'icons.stock',
                'href' => 'stock.index',
            ],
            'accounting' => [
                'label' => __('amorce.navigation-accounting'),
                'icon' => 'icons.accounting',
                'href' => 'accounting.index',
            ],
            'mailing' => [
                'label' => __('amorce.navigation-mailing'),
                'icon' => 'icons.mailing',
                'href' => 'mailing.index',
            ],
            'todo' => [
                'label' => __('amorce.navigation-todo'),
                'icon' => 'icons.todo',
                'href' => 'todo.index',
            ],
            'projects' => [
                'label' => __('amorce.navigation-projects'),
                'icon' => 'icons.project',
                'href' => 'projects.index',
            ],
            'settings' => [
                'label' => __('amorce.navigation-profile'),
                'icon' => 'icons.settings',
                'href' => 'profile.index',
            ],
            'logout' => [
                'label' => __('amorce.navigation-logout'),
                'icon' => 'icons.logout',
                'href' => 'logout',
            ]

        ];
    }


    public function render()
    {
        return view('livewire.layout.navigation');
    }
}
