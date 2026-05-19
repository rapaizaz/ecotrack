<?php

namespace App\Http\Controllers;

use App\Services\AIService;
use App\Models\AIConversation;
use App\Models\AIInsight;
use App\Models\ElectricityUsage;
use App\Models\WaterUsage;
use App\Models\WasteRecord;
use App\Models\EcoScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AIController extends Controller
{
    protected $aiService;

    public function __construct(AIService $aiService)
    {
        $this->aiService = $aiService;
    }

    public function testAI()
    {
        Log::info("=== TEST AI DIPANGGIL ===");
        $prompt = "Jawab singkat dalam Bahasa Indonesia: AI berhasil terhubung.";
        
        $aiResult = $this->aiService->generateResponse($prompt);
        
        if (!empty($aiResult['content'])) {
            return response()->json([
                'success' => true,
                'provider' => $aiResult['provider'],
                'model' => $aiResult['model'],
                'response' => $aiResult['content']
            ]);
        } else {
            return response()->json([
                'success' => false,
                'provider' => 'Offline',
                'error' => 'Semua provider gagal'
            ]);
        }
    }

    public function assistant()
    {
        $conversations = AIConversation::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();
        
        return view('ai.assistant', compact('conversations'));
    }

    public function askAssistant(Request $request)
    {
        $request->validate(['question' => 'required|string|max:500']);
        $user = Auth::user();
        $question = $request->question;

        // Custom prompt for Eco Assistant
        $prompt = "Halo, Anda adalah Eco Assistant untuk aplikasi EcoTrack. Nama pengguna adalah {$user->name}.
Tugas Anda:
- Jawab pertanyaan seputar gaya hidup hemat (listrik, air) dan ramah lingkungan (sampah).
- Jawab dalam bahasa Indonesia yang ramah, singkat, dan solutif.
- Jika pertanyaan di luar topik lingkungan, jawab dengan sopan bahwa Anda hanya ahli dalam bidang keberlanjutan.

Pertanyaan: {$question}";

        // Call the centralized AIService
        $aiResult = $this->aiService->generateResponse($prompt);

        $answer = $aiResult['content'];
        $provider = $aiResult['provider'];
        $model = $aiResult['model'];

        if (!$answer) {
            $answer = $this->getRuleBasedAssistantFallback($question);
            $provider = 'Offline';
            $model = null;
        }

        AIConversation::create([
            'user_id' => $user->id,
            'question' => $question,
            'answer' => $answer,
            'provider' => $provider,
            'model' => $model
        ]);

        return back();
    }

    public function insight()
    {
        $user = Auth::user();
        $month = now()->month;
        $year = now()->year;

        $insight = AIInsight::where('user_id', $user->id)
            ->where('month', $month)
            ->where('year', $year)
            ->first();

        return view('ai.insight', compact('insight'));
    }

    public function generateInsight(Request $request)
    {
        $user = Auth::user();
        $month = now()->month;
        $year = now()->year;

        $hasData = $this->checkUserMonthlyData($user, $month, $year);
        if (!$hasData) {
            return back()->with('error', 'Silakan input data listrik, air, dan sampah terlebih dahulu sebelum generate insight.');
        }

        $dataSummary = $this->getUserDataSummary($user, $month, $year);
        $dataSummary['user_name'] = $user->name;

        // Call the centralized AIService
        $aiResult = $this->aiService->generateMonthlyInsight($dataSummary);

        $answer = $aiResult['content'];
        $provider = $aiResult['provider'];
        $model = $aiResult['model'];

        if (!$answer) {
            $answer = $this->getRuleBasedInsightFallback($user, $month, $year);
            $provider = 'Offline';
            $model = null;
        }

        AIInsight::updateOrCreate(
            ['user_id' => $user->id, 'month' => $month, 'year' => $year],
            [
                'insight' => $answer,
                'provider' => $provider,
                'model' => $model
            ]
        );

        return back()->with('success', 'Insight berhasil diperbarui!');
    }

    public function generateAISummary(Request $request)
    {
        $user = Auth::user();
        $month = $request->month ?? now()->month;
        $year = $request->year ?? now()->year;

        $dataSummary = $this->getUserDataSummary($user, $month, $year);
        
        $prompt = "Buat ringkasan laporan bulanan lingkungan singkat untuk {$user->name}. Data: Listrik {$dataSummary['electricity']} kWh, Air {$dataSummary['water']} m³, Sampah {$dataSummary['waste']} kg, Skor {$dataSummary['eco_score']}. Bahasa Indonesia, satu paragraf. Jangan gunakan template offline.";

        $aiResult = $this->aiService->generateResponse($prompt);
        $summary = $aiResult['content'];
        
        if (!$summary) {
            $summary = "Laporan bulan ini menunjukkan performa yang stabil. Teruslah mencatat aktivitas harianmu untuk mendapatkan skor yang lebih baik.";
        }

        return response()->json(['summary' => $summary]);
    }

    private function checkUserMonthlyData($user, $month, $year)
    {
        $e = ElectricityUsage::where('user_id', $user->id)->where('month', $month)->where('year', $year)->exists();
        $w = WaterUsage::where('user_id', $user->id)->where('month', $month)->where('year', $year)->exists();
        $wa = WasteRecord::where('user_id', $user->id)->whereMonth('date', $month)->whereYear('date', $year)->exists();
        
        return $e && $w && $wa;
    }

    private function getUserDataSummary($user, $month, $year)
    {
        $electricity = ElectricityUsage::where('user_id', $user->id)->where('month', $month)->where('year', $year)->sum('kwh');
        $water = WaterUsage::where('user_id', $user->id)->where('month', $month)->where('year', $year)->sum('cubic_meter');
        
        $wasteRecords = WasteRecord::where('user_id', $user->id)->whereMonth('date', $month)->whereYear('date', $year)->get();
        $waste = $wasteRecords->sum(fn($r) => $r->organic_kg + $r->plastic_kg + $r->paper_kg + $r->metal_kg + $r->other_kg);
        
        $eco_score = EcoScore::where('user_id', $user->id)->where('month', $month)->where('year', $year)->first()?->total_score ?? 0;

        return compact('electricity', 'water', 'waste', 'eco_score');
    }

    private function getRuleBasedAssistantFallback($question)
    {
        $q = strtolower($question);
        $header = "*(Eco Assistant Tips)*\n\n";

        if (str_contains($q, 'air')) {
            return $header . "Tips Hemat Air: Gunakan gayung secukupnya, matikan kran saat menyabun, dan segera perbaiki kebocoran pipa.";
        }
        if (str_contains($q, 'listrik') || str_contains($q, 'energi')) {
            return $header . "Tips Hemat Listrik: Matikan lampu saat siang hari, cabut charger jika tidak dipakai, dan gunakan AC pada suhu 24-25 derajat.";
        }
        if (str_contains($q, 'sampah') || str_contains($q, 'limbah')) {
            return $header . "Tips Sampah: Pisahkan sampah organik dan anorganik. Sampah organik bisa dijadikan kompos, anorganik bisa didaur ulang.";
        }
        
        return $header . "Eco Living Tips: Kurangi penggunaan plastik sekali pakai, bawa kantong belanja sendiri, dan mulailah menanam pohon di sekitar rumah.";
    }

    private function getRuleBasedInsightFallback($user, $month, $year)
    {
        $electricity = ElectricityUsage::where('user_id', $user->id)->where('month', $month)->where('year', $year)->sum('kwh');
        $water = WaterUsage::where('user_id', $user->id)->where('month', $month)->where('year', $year)->sum('cubic_meter');
        $score = EcoScore::where('user_id', $user->id)->where('month', $month)->where('year', $year)->first()->total_score ?? 0;

        $insight = "### Insight Otomatis Bulanan\n\n";
        $insight .= "Berdasarkan data bulan ini, penggunaan listrik Anda sebesar {$electricity} kWh dan air {$water} m³. ";
        
        if ($score >= 80) {
            $insight .= "Skor Eco Anda sangat bagus ({$score})! Terus pertahankan gaya hidup hijau ini.";
        } else {
            $insight .= "Skor Eco Anda ({$score}) masih bisa ditingkatkan. Cobalah kurangi pemakaian listrik di jam puncak.";
        }

        return $insight;
    }
}
