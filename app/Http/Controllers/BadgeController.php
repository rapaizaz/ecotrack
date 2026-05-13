<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use Illuminate\Support\Facades\Auth;

class BadgeController extends Controller
{
    public function index()
    {
        $allBadges = Badge::all();
        $userBadges = Auth::user()->badges->pluck('id')->toArray();

        return view('badges', compact('allBadges', 'userBadges'));
    }
}
