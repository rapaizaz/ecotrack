<?php

namespace App\Http\Controllers;

use App\Models\ElectricityUsage;
use App\Services\EcoScoreService;
use App\Services\BadgeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ElectricityUsageController extends Controller
{
    protected $ecoScoreService;
    protected $badgeService;

    public function __construct(EcoScoreService $ecoScoreService, BadgeService $badgeService)
    {
        $this->ecoScoreService = $ecoScoreService;
        $this->badgeService = $badgeService;
    }

    public function index()
    {
        return view('usage.electricity');
    }

    public function store(Request $request)
    {
        $request->validate([
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2000',
            'kwh' => 'required|numeric|min:0',
            'cost' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        ElectricityUsage::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'month' => $request->month,
                'year' => $request->year,
            ],
            [
                'kwh' => $request->kwh,
                'cost' => $request->cost,
                'notes' => $request->notes,
            ]
        );

        $this->ecoScoreService->updateMonthlyEcoScore(Auth::user(), $request->month, $request->year);
        $this->badgeService->checkAndAwardBadges(Auth::user(), $request->month, $request->year);

        return redirect()->route('dashboard')->with('success', 'Data listrik berhasil disimpan.');
    }
}
