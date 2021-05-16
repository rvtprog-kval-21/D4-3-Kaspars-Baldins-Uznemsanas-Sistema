<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@rvt.lv',
            'password' => Hash::make('password')
        ]);
        \App\Models\User::create([
            'name' => 'Admin1',
            'email' => 'admin1@rvt.lv',
            'password' => Hash::make('password')
        ]);

        Branch::create([
           'name' => 'Rīga'
        ]);

        Branch::create([
            'name' => 'Krāslava'
        ]);

        Branch::create([
            'name' => 'Limbaži'
        ]);

//         \App\Models\User::factory(10)->create();
    }
}
