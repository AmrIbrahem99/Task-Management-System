<?php

namespace Database\Seeders;

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
        //call the RoleSeeder
        $this->call(RoleSeeder::class);
        //call the AdminSeeder
        $this->call(UserSeeder::class);
    }
}
