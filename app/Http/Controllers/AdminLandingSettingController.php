<?php

namespace App\Http\Controllers;

use App\Models\LandingSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminLandingSettingController extends Controller
{
    public function index()
    {
        $setting = LandingSetting::first();
        $problems = \App\Models\LandingProblem::all();
        return view('admin.landing-settings.index', compact('setting', 'problems'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $setting = LandingSetting::first() ?? new LandingSetting();

        if ($request->hasFile('hero_image')) {
            if ($setting->hero_image_path) {
                Storage::disk('public')->delete($setting->hero_image_path);
            }
            $path = $request->file('hero_image')->store('landing', 'public');
            $setting->hero_image_path = $path;
        }

        $setting->save();

        return redirect()->back()->with('success', 'Hero image updated successfully!');
    }

    public function updateProblem(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $problem = \App\Models\LandingProblem::findOrFail($id);
        
        if ($request->filled('title')) {
            $problem->title = $request->title;
        }
        
        if ($request->filled('description')) {
            $problem->description = $request->description;
        }

        if ($request->hasFile('image')) {
            if ($problem->image_path) {
                Storage::disk('public')->delete($problem->image_path);
            }
            $path = $request->file('image')->store('problems', 'public');
            $problem->image_path = $path;
        }

        $problem->save();

        return redirect()->back()->with('success', 'Problem card "' . $problem->title . '" updated successfully!');
    }
}
