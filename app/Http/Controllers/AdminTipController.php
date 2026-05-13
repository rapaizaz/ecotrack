<?php

namespace App\Http\Controllers;

use App\Models\Tip;
use Illuminate\Http\Request;

class AdminTipController extends Controller
{
    public function index()
    {
        $tips = Tip::all();
        return view('admin.tips.index', compact('tips'));
    }

    public function create()
    {
        return view('admin.tips.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'content' => 'required|string',
        ]);

        Tip::create($request->all());
        return redirect()->route('admin.tips.index')->with('success', 'Tips berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $tip = Tip::findOrFail($id);
        return view('admin.tips.edit', compact('tip'));
    }

    public function update(Request $request, $id)
    {
        $tip = Tip::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'content' => 'required|string',
        ]);

        $tip->update($request->all());
        return redirect()->route('admin.tips.index')->with('success', 'Tips berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Tip::destroy($id);
        return back()->with('success', 'Tips berhasil dihapus.');
    }

    public function toggle($id)
    {
        $tip = Tip::findOrFail($id);
        $tip->is_active = !$tip->is_active;
        $tip->save();
        return back()->with('success', 'Status tips berhasil diubah.');
    }
}
