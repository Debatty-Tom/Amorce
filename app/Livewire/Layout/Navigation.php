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
                'label' => 'Dashboard',
                'icon' => 'icons.dashboard',
                'href' => 'dashboard.index',
            ],
            'team' => [
                'label' => 'Team',
                'icon' => 'icons.team',
                'href' => 'team.index',
            ],
            'draw' => [
                'label' => 'Les 9',
                'icon' => 'icons.nine',
                'href' => 'draw.index',
            ],
            'calendar' => [
                'label' => 'Calendrier',
                'icon' => 'icons.calendar',
                'href' => 'calendar.index',
            ],
            'stock' => [
                'label' => 'Stockage',
                'icon' => 'icons.stock',
                'href' => 'stock.index',
            ],
            'accounting' => [
                'label' => 'Comptabilité',
                'icon' => 'icons.accounting',
                'href' => 'accounting.index',
            ],
            'mailing' => [
                'label' => 'Mailing',
                'icon' => 'icons.mailing',
                'href' => 'mailing.index',
            ],
            'todo' => [
                'label' => 'To Do',
                'icon' => 'icons.todo',
                'href' => 'todo.index',
            ],
            'projects' => [
                'label' => 'Projets',
                'icon' => 'icons.project',
                'href' => 'projects.index',
            ],
            'settings' => [
                'label' => 'Paramètres',
                'icon' => 'icons.settings',
                'href' => 'dashboard.index',
            ],
            'logout' => [
                'label' => 'Déconnexion',
                'icon' => 'icons.logout',
                'href' => 'dashboard.index',
            ]

        ];

    }

    public function render()
    {
        return view('livewire.layout.navigation');
    }
}
