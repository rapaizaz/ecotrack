<?php

namespace App\Http\Controllers;

use App\Models\WasteRecord;
use App\Services\EcoScoreService;
use App\Services\BadgeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WasteRecordController extends Controller
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
        return view('usage.waste');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'organic_kg' => 'required|numeric|min:0',
            'plastic_kg' => 'required|numeric|min:0',
            'paper_kg' => 'required|numeric|min:0',
            'metal_kg' => 'required|numeric|min:0',
            'other_kg' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        WasteRecord::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
            'organic_kg' => $request->organic_kg,
            'plastic_kg' => $request->plastic_kg,
            'paper_kg' => $request->paper_kg,
            'metal_kg' => $request->metal_kg,
            'other_kg' => $request->other_kg,
            'notes' => $request->notes,
        ]);

        $date = Carbon::parse($request->date);
        $this->ecoScoreService->updateMonthlyEcoScore(Auth::user(), $date->month, $date->year);
        $this->badgeService->checkAndAwardBadges(Auth::user(), $date->month, $date->year);

        return redirect()->route('dashboard')->with('success', 'Data sampah berhasil disimpan.');
    }
}
