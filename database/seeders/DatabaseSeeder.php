<?php

namespace Database\Seeders;

<<<<<<< Updated upstream
=======
use App\Enums\AttendancesStatuses;
use App\Enums\EnumsDrawAssignmentsStatuses;
use App\Models\Donator;
>>>>>>> Stashed changes
use App\Models\Draw;
use App\Models\Fund;
use App\Models\Project;
use App\Models\Stock;
use App\Models\Transaction;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory(6)
            ->hasTodos(6)
            ->create();
        Stock::factory(6)->create();
        Fund::factory(6)
            ->hasTransactions(12)
            ->create();
<<<<<<< Updated upstream
        Project::factory(6)->create();
        Draw::factory(6)->create();
=======
        Draw::factory(6)
            ->hasAttached(
                Donator::factory()
                    ->count(6),
                fn() => [
                    'status' => random_int(0, 1) ?
                    AttendancesStatuses::Validated->value :
                    AttendancesStatuses::Pending->value,
                    'contact' => bin2hex(random_bytes(16)),
                ]
            )
            ->hasAttached(
                Project::factory()
                    ->count(6),
                fn() => [
                    'status' => ($status = random_int(0, 1)
                        ? EnumsDrawAssignmentsStatuses::funded->value
                        : EnumsDrawAssignmentsStatuses::refused->value),
                    'amount' => $status === EnumsDrawAssignmentsStatuses::refused->value
                        ? 0
                        : random_int(0, 1000),
                ]
            )
            ->create();
>>>>>>> Stashed changes

        User::factory()->create([
            'name' => 'admin',
            'email' => 'tom.debatty@hotmail.be',
            'password' => 'Azertyui1@',
        ]);

    }
}
