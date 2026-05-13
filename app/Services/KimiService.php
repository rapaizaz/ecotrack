<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class KimiService
{
    protected $apiKey;
    protected $model;
    protected $baseUrl = 'https://api.moonshot.cn/v1/chat/completions';

    public function __construct()
    {
        $this->apiKey = config('services.kimi.key');
        $this->model = config('services.kimi.model');
    }

    public function generate($prompt)
    {
        if (empty($this->apiKey)) {
            Log::warning('Kimi API Key is empty.');
            return null;
        }

        try {
            $response = Http::timeout(30)->withToken($this->apiKey)->post($this->baseUrl, [
                'model' => $this->model,
                'messages' => [
                    ['role' => 'system', 'content' => 'Anda adalah asisten EcoTrack yang membantu pengguna dalam gaya hidup berkelanjutan.'],
                    ['role' => 'user', 'content' => $prompt]
                ],
                'temperature' => 0.7
            ]);

            if ($response->successful()) {
                $result = $response->json();
                return $result['choices'][0]['message']['content'] ?? null;
            }

            $this->handleError($response);
            return null;
        } catch (\Exception $e) {
            Log::error('Kimi Service Exception: ' . $e->getMessage());
            return null;
        }
    }

    protected function handleError($response)
    {
        $status = $response->status();
        $body = $response->body();

        switch ($status) {
            case 401:
                Log::error('Kimi API 401: Invalid API Key.');
                break;
            case 429:
                Log::error('Kimi API 429: Quota Exceeded.');
                break;
            default:
                Log::error("Kimi API Error {$status}: {$body}");
        }
    }
}
