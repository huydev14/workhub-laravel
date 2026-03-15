<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Position::insert([
            ['name' => 'Giám Đốc', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Trưởng Phòng', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Nhân Viên', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
