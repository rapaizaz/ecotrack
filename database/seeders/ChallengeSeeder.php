<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Challenge;
use Carbon\Carbon;

class ChallengeSeeder extends Seeder
{
    public function run(): void
    {
        $challenges = [
            [
                'title' => 'Hemat listrik 10% bulan ini',
                'description' => 'Targetkan penurunan penggunaan listrik minimal 10% dibanding bulan lalu.',
                'category' => 'Listrik',
                'target_value' => 10,
                'points' => 100,
                'start_date' => Carbon::now()->startOfMonth(),
                'end_date' => Carbon::now()->endOfMonth(),
            ],
            [
                'title' => 'Kurangi sampah plastik selama 7 hari',
                'description' => 'Usahakan tidak menghasilkan sampah plastik sekali pakai selama seminggu.',
                'category' => 'Sampah',
                'target_value' => 7,
                'points' => 50,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(7),
            ],
            [
                'title' => 'Zero Plastic Day',
                'description' => 'Satu hari tanpa plastik sama sekali.',
                'category' => 'Sampah',
                'target_value' => 1,
                'points' => 20,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDay(),
            ],
        ];

        foreach ($challenges as $challenge) {
            Challenge::create($challenge);
        }
    }
}
