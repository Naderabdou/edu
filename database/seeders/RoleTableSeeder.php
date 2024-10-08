<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_admin = Role::create(['name' => 'admin']);
        $role_user = Role::create(['name' => 'user']);
        $role_student = Role::create(['name' => 'student']);
        $role_teacher = Role::create(['name' => 'teacher']);
        $role_instructor = Role::create(['name' => 'instructor']);

    }
}
