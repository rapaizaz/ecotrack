<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use App\Services\AIService;
use App\Models\ElectricityUsage;
use App\Models\WaterUsage;
use App\Models\WasteRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MonthlyReportController extends Controller
{
    protected $reportService;
    protected $aiService;

    public function __construct(ReportService $reportService, AIService $aiService)
    {
        $this->reportService = $reportService;
        $this->aiService = $aiService;
    }

    public function index(Request $request)
    {
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);
        $user = Auth::user();

        $report = $this->reportService->generateMonthlyReport($user, $month, $year);

        if (!$report) {
            return view('monthly-report', ['no_data' => true, 'month' => $month, 'year' => $year]);
        }

        $electricity = ElectricityUsage::where('user_id', $user->id)->where('month', $month)->where('year', $year)->first();
        $water = WaterUsage::where('user_id', $user->id)->where('month', $month)->where('year', $year)->first();
        $wasteRecords = WasteRecord::where('user_id', $user->id)->whereYear('date', $year)->whereMonth('date', $month)->get();
        $totalWaste = $wasteRecords->sum(function($record) {
            return $record->organic_kg + $record->plastic_kg + $record->paper_kg + $record->metal_kg + $record->other_kg;
        });

        return view('monthly-report', array_merge($report, [
            'electricity' => $electricity,
            'water' => $water,
            'totalWaste' => $totalWaste,
            'month' => $month,
            'year' => $year,
            'no_data' => false
        ]));
    }
}
