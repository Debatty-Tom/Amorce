<?php

namespace Database\Seeders;

use App\Enums\AttendancesStatuses;
use App\Enums\EnumsDrawAssignmentsStatuses;
use App\Enums\RolesEnum;
use App\Models\Assignment;
use App\Models\Donator;
use App\Models\Draw;
use App\Models\Fund;
use App\Models\Project;
use App\Models\Stock;
use App\Models\Todo;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Traits\HandlesPermissions;

class DatabaseSeeder extends Seeder
{
    use handlesPermissions;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->generateAndAssignPermissions();

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

        Draw::factory(6)
            ->hasAttached(
                Donator::factory()
                    ->count(6),
                ['created_at' => now(), 'updated_at' => now()]
            )
            ->hasAttached(
                Project::factory()
                    ->count(6),
                fn() => [
                    'status' => ($status = collect([
                        EnumsDrawAssignmentsStatuses::funded->value,
                        EnumsDrawAssignmentsStatuses::refused->value,
                        EnumsDrawAssignmentsStatuses::pending->value,
                    ])->random()),
                    'amount' => $status != EnumsDrawAssignmentsStatuses::funded->value
                        ? 0
                        : random_int(0, 1000),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            )
            ->create();

        User::factory()->create([
            'name' => 'admin',
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
    }
}
