<?php

namespace App\Http\Controllers;

use App\Services\GeminiService;
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
    protected $aiProvider;

    public function __construct(\App\Services\AiProviderService $aiProvider)
    {
        $this->aiProvider = $aiProvider;
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

        // 1. Try Multi-Provider AI (Gemini -> OpenAI -> Kimi)
        $answer = $this->aiProvider->askEcoAssistant($user, $question);

        // 2. Fallback Rule-based if ALL AI fail
        if (!$answer) {
            $answer = $this->getRuleBasedAssistantFallback($question);
        }

        // 3. Save to database
        AIConversation::create([
            'user_id' => $user->id,
            'question' => $question,
            'answer' => $answer
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

        // 1. Check if data exists
        $hasData = $this->checkUserMonthlyData($user, $month, $year);
        if (!$hasData) {
            return back()->with('error', 'Silakan input data listrik, air, dan sampah terlebih dahulu sebelum generate insight.');
        }

        // 2. Try Multi-Provider AI (Gemini -> OpenAI -> Kimi)
        $answer = $this->aiProvider->generateEcoInsight($user, $month, $year);

        // 3. Fallback Rule-based if ALL AI fail
        if (!$answer) {
            $answer = $this->getRuleBasedInsightFallback($user, $month, $year);
        }

        // 4. Update or create record
        AIInsight::updateOrCreate(
            ['user_id' => $user->id, 'month' => $month, 'year' => $year],
            ['insight' => $answer]
        );

        return back()->with('success', 'Insight berhasil diperbarui!');
    }

    public function generateAISummary(Request $request)
    {
        $user = Auth::user();
        $month = $request->month ?? now()->month;
        $year = $request->year ?? now()->year;

        $summary = $this->aiProvider->generateMonthlyReportSummary($user, $month, $year);
        
        if (!$summary) {
            $summary = "Laporan bulan ini menunjukkan performa yang stabil. Teruslah mencatat aktivitas harianmu untuk mendapatkan skor yang lebih baik.";
        }

        return response()->json(['summary' => $summary]);
    }

    // --- Private Helpers ---

    private function checkUserMonthlyData($user, $month, $year)
    {
        $e = ElectricityUsage::where('user_id', $user->id)->where('month', $month)->where('year', $year)->exists();
        $w = WaterUsage::where('user_id', $user->id)->where('month', $month)->where('year', $year)->exists();
        $wa = WasteRecord::where('user_id', $user->id)->whereMonth('date', $month)->whereYear('date', $year)->exists();
        
        return $e && $w && $wa;
    }

    private function getRuleBasedAssistantFallback($question)
    {
        $q = strtolower($question);
        $header = "*(AI Offline - Menampilkan Tips Otomatis)*\n\n";

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

        $insight = "### Insight Otomatis (Offline)\n\n";
        $insight .= "Berdasarkan data bulan ini, penggunaan listrik Anda sebesar {$electricity} kWh dan air {$water} m³. ";
        
        if ($score >= 80) {
            $insight .= "Skor Eco Anda sangat bagus ({$score})! Terus pertahankan gaya hidup hijau ini.";
        } else {
            $insight .= "Skor Eco Anda ({$score}) masih bisa ditingkatkan. Cobalah kurangi pemakaian listrik di jam puncak.";
        }

        return $insight;
    }
}
