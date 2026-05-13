<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ChallengeController extends Controller
{
    public function index()
    {
        $allChallenges = Challenge::where('is_active', true)
            ->where('end_date', '>=', Carbon::now())
            ->get();
        
        $userChallenges = Auth::user()->challenges;

        return view('challenges', compact('allChallenges', 'userChallenges'));
    }

    public function join($id)
    {
        $user = Auth::user();
        if (!$user->challenges()->where('challenge_id', $id)->exists()) {
            $user->challenges()->attach($id, ['status' => 'ongoing', 'progress' => 0]);
        }
        return back()->with('success', 'Berhasil mengikuti challenge!');
    }

    public function updateProgress(Request $request, $id)
    {
        $request->validate(['progress' => 'required|integer|min:0']);
        $user = Auth::user();
        $challenge = Challenge::find($id);
        
        $newProgress = $request->progress;
        $status = $newProgress >= $challenge->target_value ? 'completed' : 'ongoing';
        $completedAt = $status === 'completed' ? Carbon::now() : null;

        $user->challenges()->updateExistingPivot($id, [
            'progress' => $newProgress,
            'status' => $status,
            'completed_at' => $completedAt
        ]);

        return back()->with('success', 'Progress berhasil diupdate!');
    }
}
