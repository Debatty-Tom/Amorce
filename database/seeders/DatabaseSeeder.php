<?php

namespace Database\Seeders;

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
        Project::factory(6)->create();
        Draw::factory(6)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'tom.debatty@hotmail.be',
            'password' => 'Azertyui1@',
        ]);

    }
}
