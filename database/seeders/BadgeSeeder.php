<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Badge;

class BadgeSeeder extends Seeder
{
    public function run(): void
    {
        $badges = [
            ['name' => 'Eco Starter', 'description' => 'Mulai perjalanan ramah lingkunganmu.', 'icon' => 'seedling', 'requirement_type' => 'first_input', 'requirement_value' => 1],
            ['name' => 'Hemat Listrik', 'description' => 'Mencapai skor listrik >= 80.', 'icon' => 'bolt', 'requirement_type' => 'electricity', 'requirement_value' => 80],
            ['name' => 'Hemat Air', 'description' => 'Mencapai skor air >= 80.', 'icon' => 'tint', 'requirement_type' => 'water', 'requirement_value' => 80],
            ['name' => 'Zero Plastic', 'description' => 'Mencapai skor sampah >= 80.', 'icon' => 'recycle', 'requirement_type' => 'waste', 'requirement_value' => 80],
            ['name' => 'Eco Warrior', 'description' => 'Mencapai skor total >= 85.', 'icon' => 'shield-alt', 'requirement_type' => 'total', 'requirement_value' => 85],
        ];

        foreach ($badges as $badge) {
            Badge::create($badge);
        }
    }
}
