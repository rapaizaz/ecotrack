<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ElectricityUsageController;
use App\Http\Controllers\WaterUsageController;
use App\Http\Controllers\WasteRecordController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\EcoScoreController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\MonthlyReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminTipController;
use App\Http\Controllers\AdminChallengeController;
use App\Http\Controllers\AdminBadgeController;


Route::get('/', function () {
    $totalUsers = \App\Models\User::where('role', 'user')->count();
    $latestUsers = \App\Models\User::where('role', 'user')->latest()->take(3)->get();
    $landingSetting = \App\Models\LandingSetting::first();
    $problems = \App\Models\LandingProblem::all();
    return view('welcome', compact('totalUsers', 'latestUsers', 'landingSetting', 'problems'));
})->name('home');


Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/electricity', [ElectricityUsageController::class, 'index'])->name('electricity.index');
    Route::post('/electricity', [ElectricityUsageController::class, 'store'])->name('electricity.store');
    
    Route::get('/water', [WaterUsageController::class, 'index'])->name('water.index');
    Route::post('/water', [WaterUsageController::class, 'store'])->name('water.store');
    
    Route::get('/waste', [WasteRecordController::class, 'index'])->name('waste.index');
    Route::post('/waste', [WasteRecordController::class, 'store'])->name('waste.store');
    
    Route::get('/history', [HistoryController::class, 'index'])->name('history');
    Route::get('/eco-score', [EcoScoreController::class, 'index'])->name('eco-score');
    
    Route::get('/challenges', [ChallengeController::class, 'index'])->name('challenges.index');
    Route::post('/challenges/{id}/join', [ChallengeController::class, 'join'])->name('challenges.join');
    Route::post('/challenges/{id}/progress', [ChallengeController::class, 'updateProgress'])->name('challenges.progress');
    
    Route::get('/badges', [BadgeController::class, 'index'])->name('badges');
    Route::get('/monthly-report', [MonthlyReportController::class, 'index'])->name('monthly-report');
    
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    
    Route::get('/ai-assistant', [\App\Http\Controllers\AIController::class, 'assistant'])->name('ai.assistant');
    Route::post('/ai-assistant/ask', [\App\Http\Controllers\AIController::class, 'askAssistant'])->name('ai.assistant.ask');
    Route::get('/ai-insight', [\App\Http\Controllers\AIController::class, 'insight'])->name('ai.insight');
    Route::post('/ai-insight/generate', [\App\Http\Controllers\AIController::class, 'generateInsight'])->name('ai.insight.generate');
    Route::post('/monthly-report/generate-ai-summary', [\App\Http\Controllers\AIController::class, 'generateAISummary'])->name('monthly-report.ai-summary');
});


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('users.destroy');
    
    Route::resource('tips', AdminTipController::class);
    Route::post('tips/{id}/toggle', [AdminTipController::class, 'toggle'])->name('tips.toggle');
    
    Route::resource('challenges', AdminChallengeController::class);
    Route::resource('badges', AdminBadgeController::class);
    
    Route::get('/statistics', [AdminDashboardController::class, 'index'])->name('statistics'); 

    
    Route::get('/landing-settings', [\App\Http\Controllers\AdminLandingSettingController::class, 'index'])->name('landing-settings.index');
    Route::post('/landing-settings', [\App\Http\Controllers\AdminLandingSettingController::class, 'update'])->name('landing-settings.update');
    Route::post('/landing-settings/problem/{id}', [\App\Http\Controllers\AdminLandingSettingController::class, 'updateProblem'])->name('landing-settings.update-problem');
});
