<?php

namespace App\Http\Controllers;

use App\Models\EcoScore;
use App\Models\ElectricityUsage;
use App\Models\WaterUsage;
use App\Models\WasteRecord;
use App\Models\MonthlyTarget;
use App\Services\RecommendationService;
use App\Services\AIService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $recommendationService;
    protected $aiService;

    public function __construct(RecommendationService $recommendationService, AIService $aiService)
    {
        $this->recommendationService = $recommendationService;
        $this->aiService = $aiService;
    }

    public function index()
    {
        $user = Auth::user();
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;

        $ecoScore = EcoScore::where('user_id', $user->id)
            ->where('month', $month)
            ->where('year', $year)
            ->first();

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

        $target = MonthlyTarget::where('user_id', $user->id)
            ->where('month', $month)
            ->where('year', $year)
            ->first();

        // Standardized dynamic call via AIService
        $dataSummary = [
            'user_name' => $user->name,
            'electricity' => $electricity ? $electricity->kwh : 0,
            'water' => $water ? $water->cubic_meter : 0,
            'waste' => $totalWaste,
            'eco_score' => $ecoScore ? $ecoScore->total_score : 0,
        ];

        $prompt = "Berikan 3-5 rekomendasi personal praktis untuk {$user->name} agar lebih ramah lingkungan berdasarkan data berikut:
- Listrik: {$dataSummary['electricity']} kWh
- Air: {$dataSummary['water']} m³
- Sampah: {$dataSummary['waste']} kg
- Eco Score: {$dataSummary['eco_score']}/100

Format respon harus berupa daftar poin-poin singkat dalam Bahasa Indonesia. Jangan gunakan template offline.";

        $aiResult = $this->aiService->generateResponse($prompt);
        $aiRec = $aiResult['content'];

        if ($aiRec) {
            $recommendations = array_filter(explode("\n", $aiRec));
        } else {
            $recommendations = $this->recommendationService->getRecommendations($ecoScore);
        }

        $activeChallenges = $user->challenges()->where('status', 'ongoing')->get();
        $recentBadges = $user->badges()->orderBy('earned_at', 'desc')->take(4)->get();
        
        $history = collect();
        $history = $history->concat(ElectricityUsage::where('user_id', $user->id)->orderBy('created_at', 'desc')->take(5)->get()->map(fn($item) => ['type' => 'Listrik', 'value' => $item->kwh . ' kWh', 'date' => $item->created_at, 'color' => 'blue']));
        $history = $history->concat(WaterUsage::where('user_id', $user->id)->orderBy('created_at', 'desc')->take(5)->get()->map(fn($item) => ['type' => 'Air', 'value' => $item->cubic_meter . ' m³', 'date' => $item->created_at, 'color' => 'cyan']));
        $history = $history->concat(WasteRecord::where('user_id', $user->id)->orderBy('created_at', 'desc')->take(5)->get()->map(fn($item) => ['type' => 'Sampah', 'value' => ($item->organic_kg + $item->plastic_kg + $item->paper_kg + $item->metal_kg + $item->other_kg) . ' kg', 'date' => $item->created_at, 'color' => 'green']));
        
        $history = $history->sortByDesc('date')->take(5);

        $chartData = $this->getChartData($user);

        return view('dashboard', compact(
            'ecoScore', 'electricity', 'water', 'totalWaste', 
            'target', 'recommendations', 'activeChallenges', 
            'recentBadges', 'history', 'chartData'
        ));
    }

    private function getChartData($user)
    {
        $labels = [];
        $electricityData = [];
        $waterData = [];
        $wasteData = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $labels[] = $date->format('M Y');
            
            $e = ElectricityUsage::where('user_id', $user->id)
                ->where('month', $date->month)
                ->where('year', $date->year)
                ->first();
            $electricityData[] = $e ? $e->kwh : 0;

            $w = WaterUsage::where('user_id', $user->id)
                ->where('month', $date->month)
                ->where('year', $date->year)
                ->first();
            $waterData[] = $w ? $w->cubic_meter : 0;

            $wa = WasteRecord::where('user_id', $user->id)
                ->whereYear('date', $date->year)
                ->whereMonth('date', $date->month)
                ->get();
            $wasteData[] = $wa->sum(function($record) {
                return $record->organic_kg + $record->plastic_kg + $record->paper_kg + $record->metal_kg + $record->other_kg;
            });
        }

        return [
            'labels' => $labels,
            'electricity' => $electricityData,
            'water' => $waterData,
            'waste' => $wasteData,
        ];
    }
}
