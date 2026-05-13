<?php

namespace App\Http\Controllers;

use App\Models\EcoScore;
use App\Services\RecommendationService;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EcoScoreController extends Controller
{
    protected $recommendationService;

    public function __construct(RecommendationService $recommendationService)
    {
        $this->recommendationService = $recommendationService;
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

        $recommendations = $this->recommendationService->getRecommendations($ecoScore);
        
        $history = EcoScore::where('user_id', $user->id)
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view('eco-score', compact('ecoScore', 'recommendations', 'history'));
    }
}
