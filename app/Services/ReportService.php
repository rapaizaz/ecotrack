<?php

namespace App\Services;

use App\Models\EcoScore;
use App\Models\ElectricityUsage;
use App\Models\WaterUsage;
use App\Models\WasteRecord;

class ReportService
{
    public function generateMonthlyReport($user, $month, $year)
    {
        $currentScore = EcoScore::where('user_id', $user->id)
            ->where('month', $month)
            ->where('year', $year)
            ->first();

        if (!$currentScore) return null;

        $prevMonth = $month == 1 ? 12 : $month - 1;
        $prevYear = $month == 1 ? $year - 1 : $year;

        $prevScore = EcoScore::where('user_id', $user->id)
            ->where('month', $prevMonth)
            ->where('year', $prevYear)
            ->first();

        $conclusion = "";
        if ($prevScore) {
            if ($currentScore->total_score > $prevScore->total_score) {
                $conclusion = "Progress kamu meningkat dibanding bulan sebelumnya. Pertahankan kebiasaan baik ini.";
            } elseif ($currentScore->total_score < $prevScore->total_score) {
                $conclusion = "Eco Score kamu menurun. Coba ikuti rekomendasi hemat agar lebih baik bulan depan.";
            } else {
                $conclusion = "Eco Score kamu stabil. Teruslah berusaha untuk lebih ramah lingkungan!";
            }
        } else {
            $conclusion = "Ini adalah laporan pertama kamu. Terus catat aktivitasmu untuk melihat perkembangan!";
        }

        return [
            'score' => $currentScore,
            'prev_score' => $prevScore,
            'conclusion' => $conclusion,
        ];
    }
}
