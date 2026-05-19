<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ElectricityUsage;
use App\Models\WaterUsage;
use App\Models\WasteRecord;
use App\Models\EcoScore;
use App\Services\EcoScoreService;
use Carbon\Carbon;

class UsageSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'user@ecotrack.test')->first();
        if (!$user) return;

        $service = new EcoScoreService();

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            
            $kwh = rand(80, 250);
            ElectricityUsage::create([
                'user_id' => $user->id,
                'month' => $date->month,
                'year' => $date->year,
                'kwh' => $kwh,
                'cost' => $kwh * 1500,
            ]);

            $m3 = rand(8, 25);
            WaterUsage::create([
                'user_id' => $user->id,
                'month' => $date->month,
                'year' => $date->year,
                'cubic_meter' => $m3,
                'cost' => $m3 * 5000,
            ]);

            
            for ($j = 1; $j <= 4; $j++) {
                WasteRecord::create([
                    'user_id' => $user->id,
                    'date' => $date->copy()->startOfMonth()->addDays($j * 7),
                    'organic_kg' => rand(1, 5),
                    'plastic_kg' => rand(0, 3),
                    'paper_kg' => rand(0, 2),
                    'metal_kg' => rand(0, 1),
                    'other_kg' => rand(0, 1),
                ]);
            }

            $service->updateMonthlyEcoScore($user, $date->month, $date->year);
        }
    }
}
