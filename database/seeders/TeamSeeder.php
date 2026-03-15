<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::insert([
            ['name' => 'Team Vận hành', 'department_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Team Frontend', 'department_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Team Backend', 'department_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Team Tuyển Dụng', 'department_id' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
