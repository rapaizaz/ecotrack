<?php

namespace App\Services;

use App\Models\ElectricityUsage;
use App\Models\WaterUsage;
use App\Models\WasteRecord;
use App\Models\EcoScore;
use Carbon\Carbon;

class EcoScoreService
{
    public function calculateElectricityScore($kwh)
    {
        if ($kwh <= 100) return 100;
        if ($kwh <= 150) return 80;
        if ($kwh <= 220) return 60;
        if ($kwh <= 300) return 40;
        return 20;
    }

    public function calculateWaterScore($cubic_meter)
    {
        if ($cubic_meter <= 10) return 100;
        if ($cubic_meter <= 15) return 80;
        if ($cubic_meter <= 20) return 60;
        if ($cubic_meter <= 30) return 40;
        return 20;
    }

    public function calculateWasteScore($total_kg)
    {
        if ($total_kg <= 10) return 100;
        if ($total_kg <= 20) return 80;
        if ($total_kg <= 35) return 60;
        if ($total_kg <= 50) return 40;
        return 20;
    }

    public function getStatus($totalScore)
    {
        if ($totalScore >= 85) return 'Sangat Ramah Lingkungan';
        if ($totalScore >= 70) return 'Baik';
        if ($totalScore >= 55) return 'Cukup';
        if ($totalScore >= 40) return 'Perlu Ditingkatkan';
        return 'Boros dan Perlu Perubahan';
    }

    public function updateMonthlyEcoScore($user, $month, $year)
    {
        $electricity = ElectricityUsage::where('user_id', $user->id)
            ->where('month', $month)
            ->where('year', $year)
            ->first();

        $water = WaterUsage::where('user_id', $user->id)
            ->where('month', $month)
            ->where('year', $year)
            ->first();

        $wasteRecords = WasteRecord::where('user_id', $user->id)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get();

        $totalWaste = $wasteRecords->sum(function($record) {
            return $record->organic_kg + $record->plastic_kg + $record->paper_kg + $record->metal_kg + $record->other_kg;
        });

        $eScore = $electricity ? $this->calculateElectricityScore($electricity->kwh) : 0;
        $wScore = $water ? $this->calculateWaterScore($water->cubic_meter) : 0;
        $waScore = $totalWaste > 0 ? $this->calculateWasteScore($totalWaste) : 0;

        
        
        $totalScore = round(($eScore + $wScore + $waScore) / 3);

        $ecoScore = EcoScore::updateOrCreate(
            ['user_id' => $user->id, 'month' => $month, 'year' => $year],
            [
                'electricity_score' => $eScore,
                'water_score' => $wScore,
                'waste_score' => $waScore,
                'total_score' => $totalScore,
                'status' => $this->getStatus($totalScore),
            ]
        );

        return $ecoScore;
    }
}
