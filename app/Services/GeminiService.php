<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    public $apiKey;
    public $model;
    public $lastError = null;
    public $lastErrorStatus = null;
    protected $baseUrl = 'https://generativelanguage.googleapis.com/v1beta/models/';

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key');
        $this->model = config('services.gemini.model', 'gemini-2.0-flash');
    }

    public function setCredentials($apiKey, $model)
    {
        $this->apiKey = $apiKey;
        $this->model = $model ?: 'gemini-2.0-flash';
    }

    public function generate($prompt)
    {
        if (empty($this->apiKey)) {
            $this->lastError = 'Gemini API Key is missing in configuration.';
            Log::error($this->lastError);
            return null;
        }

        try {
            $url = "{$this->baseUrl}{$this->model}:generateContent?key={$this->apiKey}";
            
            $response = Http::timeout(30)->post($url, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ]);

            if ($response->successful()) {
                $result = $response->json();
                $text = $result['candidates'][0]['content']['parts'][0]['text'] ?? null;
                if ($text) {
                    $this->lastErrorStatus = null;
                    return $text;
                }
            }

            $this->lastErrorStatus = $response->status();
            $body = $response->body();
            $this->lastError = "Gemini API Error (status {$response->status()}): {$body}";
            
            Log::error('Gemini API Error', [
                'status' => $response->status(),
                'body' => $body,
                'model' => $this->model
            ]);

        } catch (\Exception $e) {
            $this->lastErrorStatus = 500;
            $this->lastError = 'Gemini Service Exception: ' . $e->getMessage();
            Log::error($this->lastError);
        }

        return null;
    }

    public function askEcoAssistant($question, $user = null)
    {
        $userName = $user ? $user->name : 'Pengguna';
        $prompt = "Halo, Anda adalah Eco Assistant untuk aplikasi EcoTrack. Nama pengguna adalah {$userName}.
        Tugas Anda:
        - Jawab pertanyaan seputar gaya hidup hemat (listrik, air) dan ramah lingkungan (sampah).
        - Jawab dalam bahasa Indonesia yang ramah, singkat, dan solutif.
        - Jika pertanyaan di luar topik lingkungan, jawab dengan sopan bahwa Anda hanya ahli dalam bidang keberlanjutan.
        
        Pertanyaan: {$question}";

        return $this->generate($prompt);
    }

    public function generateMonthlyInsight($user, $month, $year)
    {
        $data = $this->getUserDataSummary($user, $month, $year);
        
        $prompt = "Sebagai pakar lingkungan EcoTrack, berikan insight bulanan untuk {$user->name} berdasarkan data:
        - Listrik: {$data['electricity']} kWh
        - Air: {$data['water']} m³
        - Sampah: {$data['waste']} kg
        - Eco Score: {$data['eco_score']}/100
        
        Berikan analisis singkat per kategori (listrik, air, sampah) dan satu saran utama untuk bulan depan. Bahasa Indonesia, format poin-poin yang cantik.";

        return $this->generate($prompt);
    }

    protected function getUserDataSummary($user, $month, $year)
    {
        $electricity = \App\Models\ElectricityUsage::where('user_id', $user->id)->where('month', $month)->where('year', $year)->sum('kwh');
        $water = \App\Models\WaterUsage::where('user_id', $user->id)->where('month', $month)->where('year', $year)->sum('cubic_meter');
        
        $wasteRecords = \App\Models\WasteRecord::where('user_id', $user->id)->whereMonth('date', $month)->whereYear('date', $year)->get();
        $waste = $wasteRecords->sum(fn($r) => $r->organic_kg + $r->plastic_kg + $r->paper_kg + $r->metal_kg + $r->other_kg);
        
        $eco_score = \App\Models\EcoScore::where('user_id', $user->id)->where('month', $month)->where('year', $year)->first()?->total_score ?? 0;

        return compact('electricity', 'water', 'waste', 'eco_score');
    }
}
