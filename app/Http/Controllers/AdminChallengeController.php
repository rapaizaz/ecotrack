<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use Illuminate\Http\Request;

class AdminChallengeController extends Controller
{
    public function index()
    {
        $challenges = Challenge::all();
        return view('admin.challenges.index', compact('challenges'));
    }

    public function create()
    {
        return view('admin.challenges.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'target_value' => 'required|integer',
            'points' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        Challenge::create($request->all());
        return redirect()->route('admin.challenges.index')->with('success', 'Challenge berhasil dibuat.');
    }

    public function edit($id)
    {
        $challenge = Challenge::findOrFail($id);
        return view('admin.challenges.edit', compact('challenge'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'target_value' => 'required|numeric',
            'points' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $challenge = Challenge::findOrFail($id);
        $challenge->update($request->all());

        return redirect()->route('admin.challenges.index')->with('success', 'Challenge berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Challenge::destroy($id);
        return back()->with('success', 'Challenge berhasil dihapus.');
    }
}
