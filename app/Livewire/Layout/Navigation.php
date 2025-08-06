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
                'label' => __('Dashboard'),
                'icon' => 'icons.dashboard',
                'href' => 'dashboard.index',
            ],
            'team' => [
                'label' => __('Team'),
                'icon' => 'icons.team',
                'href' => 'team.index',
            ],
            'draw' => [
                'label' => __('Les 9'),
                'icon' => 'icons.nine',
                'href' => 'draw.index',
            ],
            'calendar' => [
                'label' => __('Calendrier'),
                'icon' => 'icons.calendar',
                'href' => 'calendar.index',
            ],
            'stock' => [
                'label' => __('Stockage'),
                'icon' => 'icons.stock',
                'href' => 'stock.index',
            ],
            'accounting' => [
                'label' => __('Comptabilité'),
                'icon' => 'icons.accounting',
                'href' => 'accounting.index',
            ],
            'mailing' => [
                'label' => __('Mailing'),
                'icon' => 'icons.mailing',
                'href' => 'mailing.index',
            ],
            'todo' => [
                'label' => __('To Do'),
                'icon' => 'icons.todo',
                'href' => 'todo.index',
            ],
            'projects' => [
                'label' => __('Projets'),
                'icon' => 'icons.project',
                'href' => 'projects.index',
            ],
            'settings' => [
                'label' => __('Profile'),
                'icon' => 'icons.settings',
                'href' => 'profile.index',
            ],
            'logout' => [
                'label' => __('Déconnexion'),
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
