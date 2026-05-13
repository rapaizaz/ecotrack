<?php

namespace App\Http\Controllers;

use App\Models\ElectricityUsage;
use App\Models\WaterUsage;
use App\Models\WasteRecord;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $electricity = ElectricityUsage::where('user_id', $user->id)->orderBy('year', 'desc')->orderBy('month', 'desc')->get();
        $water = WaterUsage::where('user_id', $user->id)->orderBy('year', 'desc')->orderBy('month', 'desc')->get();
        $waste = WasteRecord::where('user_id', $user->id)->orderBy('date', 'desc')->get();

        return view('history', compact('electricity', 'water', 'waste'));
    }
}
