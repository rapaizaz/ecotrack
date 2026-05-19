<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ElectricityUsage;
use App\Models\WaterUsage;
use App\Models\WasteRecord;
use App\Models\EcoScore;
use App\Models\Challenge;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalElectricity = ElectricityUsage::count();
        $totalWater = WaterUsage::count();
        $totalWaste = WasteRecord::count();
        $avgEcoScore = EcoScore::avg('total_score') ?? 0;

        $topUser = User::where('role', 'user')
            ->with(['ecoScores' => function($query) {
                $query->orderBy('total_score', 'desc');
            }])
            ->get()
            ->sortByDesc(fn($u) => $u->ecoScores->first()->total_score ?? 0)
            ->first();

        $popularChallenge = Challenge::withCount('users')
            ->orderBy('users_count', 'desc')
            ->first();

        
        $monthlyStats = EcoScore::select(
            DB::raw('month'),
            DB::raw('year'),
            DB::raw('AVG(total_score) as avg_score')
        )
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->take(6)
        ->get()
        ->reverse()
        ->map(function($s) {
            $s->label = date('M Y', mktime(0, 0, 0, $s->month, 1, $s->year));
            return $s;
        });

        return view('admin.dashboard', compact(
            'totalUsers', 'totalElectricity', 'totalWater', 
            'totalWaste', 'avgEcoScore', 'topUser', 
            'popularChallenge', 'monthlyStats'
        ));
    }
}
