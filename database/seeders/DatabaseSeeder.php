<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Onboard;
use Database\Seeders\ColorSeed;
use Illuminate\Database\Seeder;
use Database\Seeders\SettingTableSeeder;
use Database\Seeders\StudentTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $this->call(RoleTableSeeder::class);
        $this->call(SettingTableSeeder::class);
        $this->call(ConnectivityToolSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(StudentTableSeeder::class);
        $this->call(CourcesTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(CategoryCourseSeeder::class);

    }
}
