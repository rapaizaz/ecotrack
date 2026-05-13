<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->withCount(['electricityUsages', 'waterUsages', 'wasteRecords'])->get();
        return view('admin.users', compact('users'));
    }

    public function destroy($id)
    {
        User::destroy($id);
        return back()->with('success', 'User berhasil dihapus.');
    }
}
