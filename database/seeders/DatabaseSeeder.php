<?php

namespace Database\Seeders;

use App\Enums\AttendancesStatuses;
use App\Enums\EnumsDrawAssignmentsStatuses;
use App\Enums\RolesEnum;
use App\Models\Donator;
use App\Models\Draw;
use App\Models\Event;
use App\Models\Fund;
use App\Models\Project;
use App\Models\Stock;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Traits\HandlesPermissions;

class DatabaseSeeder extends Seeder
{
    use HandlesPermissions;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->generateAndAssignPermissions();

        Fund::factory()
            ->hasTransactions(12)
            ->create([
                'title' => 'Général',
                'description' => 'Le fonds général est utilisé pour les dépenses courantes de l\'association.',
                'type' => 'principal',
            ]);

        Event::factory(20)->create();

        User::factory(6)
            ->hasAttached(
                Todo::factory()
                    ->count(6),
                fn() => [
                    'assigned_by' => User::inRandomOrder()->first()->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            )
            ->create()
            ->each(function ($user) {
                $user->assignRole(\App\Enums\RolesEnum::MEMBER->value);
            });

        Stock::factory(6)->create();

        Fund::factory(6)
            ->hasTransactions(12)
            ->create();

        Project::factory(6)->create();

        $donatorsPool = Donator::factory(20)->create();
        $drawCount = 6;
        $activeParticipants = collect();

        for ($i = 1; $i <= $drawCount; $i++) {
            $activeParticipants = $activeParticipants->map(function ($participant) {
                $participant['remaining_turns']--;
                return $participant;
            })->filter(fn ($p) => $p['remaining_turns'] > 0)->values();

            $currentIds = $activeParticipants->pluck('donator_id')->toArray();

            $needed = 9 - count($currentIds);
            $newDonators = $donatorsPool->whereNotIn('id', $currentIds)->random($needed);

            foreach ($newDonators as $new) {
                $activeParticipants->push([
                    'donator_id' => $new->id,
                    'remaining_turns' => 3,
                ]);
            }

            $draw = Draw::factory()->create();

            $donatorIds = $activeParticipants->pluck('donator_id')->toArray();
            $draw->donators()->attach($donatorIds, [
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $projects = Project::factory(6)->create();

            $pivotData = [];

            foreach ($projects as $project) {
                $status = EnumsDrawAssignmentsStatuses::pending->value;

                $pivotData[$project->id] = [
                    'status' => $status,
                    'amount' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            $draw->projects()->attach($pivotData);
        }

        User::factory()->create([
            'name' => 'Tom Debatty',
            'email' => 'tom.debatty@hotmail.be',
            'password' => 'Azertyui1@',
        ])
            ->assignRole(RolesEnum::ADMIN->value);

        User::factory()->create([
            'name' => 'Dominique Vilain',
            'email' => 'dominique.vilain@hepl.be',
            'password' => 'zukrap-6zEzny-jesboq',
        ])
            ->assignRole(RolesEnum::ACCOUNTANT->value);

        User::factory()->create([
            'name' => 'Michael Lecerf',
            'email' => 'michael@lecerf.be',
            'password' => 'cuwfi5-fokfij-copdaT',
        ])
            ->assignRole(RolesEnum::USERMANAGER->value);
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => 'admin',
        ])
            ->assignRole(RolesEnum::ADMIN->value);
    }
}
