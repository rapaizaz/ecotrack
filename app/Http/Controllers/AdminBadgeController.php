<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use Illuminate\Http\Request;

class AdminBadgeController extends Controller
{
    public function index()
    {
        $badges = Badge::all();
        return view('admin.badges.index', compact('badges'));
    }

    public function create()
    {
        return view('admin.badges.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'icon' => 'required',
            'requirement_type' => 'required',
            'requirement_value' => 'required|integer',
        ]);

        Badge::create($request->all());
        return redirect()->route('admin.badges.index')->with('success', 'Badge berhasil dibuat.');
    }

    public function edit($id)
    {
        $badge = Badge::findOrFail($id);
        return view('admin.badges.edit', compact('badge'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'icon' => 'required',
            'requirement_type' => 'required',
            'requirement_value' => 'required|integer',
        ]);

        $badge = Badge::findOrFail($id);
        $badge->update($request->all());

        return redirect()->route('admin.badges.index')->with('success', 'Badge berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Badge::destroy($id);
        return back()->with('success', 'Badge berhasil dihapus.');
    }
}
