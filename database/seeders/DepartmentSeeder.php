<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::insert([
            ['name' => 'Ban Giám Đốc', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Phòng IT', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Phòng HR', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
