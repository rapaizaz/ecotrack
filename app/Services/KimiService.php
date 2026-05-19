<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class KimiService
{
    public $apiKey;
    public $model;
    public $lastError = null;
    public $lastErrorStatus = null;
    protected $baseUrl = 'https://api.moonshot.cn/v1/chat/completions';

    public function __construct()
    {
        $this->apiKey = config('services.kimi.key');
        $this->model = config('services.kimi.model', 'moonshot-v1-8k');
    }

    public function setCredentials($apiKey, $model)
    {
        $this->apiKey = $apiKey;
        $this->model = $model ?: 'moonshot-v1-8k';
    }

    public function generate($prompt)
    {
        if (empty($this->apiKey)) {
            $this->lastError = 'Kimi API Key is empty.';
            Log::warning($this->lastError);
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
                $text = $result['choices'][0]['message']['content'] ?? null;
                if ($text) {
                    $this->lastErrorStatus = null;
                    return $text;
                }
            }

            $this->handleError($response);
            return null;
        } catch (\Exception $e) {
            $this->lastErrorStatus = 500;
            $this->lastError = 'Kimi Service Exception: ' . $e->getMessage();
            Log::error($this->lastError);
            return null;
        }
    }

    protected function handleError($response)
    {
        $this->lastErrorStatus = $response->status();
        $body = $response->body();
        $this->lastError = "Kimi API Error (status {$this->lastErrorStatus}): {$body}";

        switch ($this->lastErrorStatus) {
            case 401:
                Log::error('Kimi API 401: Invalid API Key.');
                break;
            case 429:
                Log::error('Kimi API 429: Quota Exceeded.');
                break;
            default:
                Log::error("Kimi API Error {$this->lastErrorStatus}: {$body}");
        }
    }
}
