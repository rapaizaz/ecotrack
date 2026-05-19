<?php

namespace App\Services;

class AiProviderService
{
    protected $gemini;
    protected $openai;
    protected $kimi;

    public function __construct(GeminiService $gemini, OpenAiService $openai, KimiService $kimi)
    {
        $this->gemini = $gemini;
        $this->openai = $openai;
        $this->kimi = $kimi;
    }

    public function generateEcoInsight($user, $month, $year)
    {
        $data = $this->getUserData($user, $month, $year);
        $prompt = "Sebagai pakar keberlanjutan lingkungan, berikan insight bulanan untuk pengguna bernama {$user->name} berdasarkan data berikut:
        - Listrik: {$data['electricity']} kWh, Air: {$data['water']} m³, Sampah: {$data['waste']} kg, Skor: {$data['eco_score']}.
        Berikan analisis pemakaian, perbandingan, dan rekomendasi strategis dalam bahasa Indonesia.";

        return $this->tryProviders($prompt);
    }

    public function generateRecommendations($user, $month, $year)
    {
        $data = $this->getUserData($user, $month, $year);
        $prompt = "Berikan 3-5 rekomendasi personal praktis untuk {$user->name} agar lebih ramah lingkungan berdasarkan: Listrik {$data['electricity']} kWh, Air {$data['water']} m³, Sampah {$data['waste']} kg. Singkat dan poin-poin.";

        return $this->tryProviders($prompt);
    }

    public function generateMonthlyReportSummary($user, $month, $year)
    {
        $data = $this->getUserData($user, $month, $year);
        $prompt = "Buat ringkasan laporan bulanan lingkungan singkat untuk {$user->name}. Data: Listrik {$data['electricity']}, Air {$data['water']}, Sampah {$data['waste']}, Skor {$data['eco_score']}. Bahasa Indonesia, satu paragraf.";

        return $this->tryProviders($prompt);
    }

    public function askEcoAssistant($user, $question)
    {
        $prompt = "Tugas: Jawab pertanyaan seputar gaya hidup hemat dan ramah lingkungan. Jika di luar topik, tolak dengan sopan. Pertanyaan: {$question}";

        return $this->tryProviders($prompt);
    }

    protected function tryProviders($prompt)
    {
        
        $response = $this->gemini->generate($prompt);
        if ($response) return $response;

        
        $response = $this->openai->generate($prompt);
        if ($response) return $response;

        
        $response = $this->kimi->generate($prompt);
        if ($response) return $response;

        return null;
    }

    protected function getUserData($user, $month, $year)
    {
        $electricity = \App\Models\ElectricityUsage::where('user_id', $user->id)->where('month', $month)->where('year', $year)->sum('kwh');
        $water = \App\Models\WaterUsage::where('user_id', $user->id)->where('month', $month)->where('year', $year)->sum('cubic_meter');
        $wasteRecords = \App\Models\WasteRecord::where('user_id', $user->id)->whereMonth('date', $month)->whereYear('date', $year)->get();
        $waste = $wasteRecords->sum(fn($r) => $r->organic_kg + $r->plastic_kg + $r->paper_kg + $r->metal_kg + $r->other_kg);
        $eco_score = \App\Models\EcoScore::where('user_id', $user->id)->where('month', $month)->where('year', $year)->first()?->total_score ?? 0;

        return compact('electricity', 'water', 'waste', 'eco_score');
    }
}
