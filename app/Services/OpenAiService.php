<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenAiService
{
    protected $apiKey;
    protected $model;
    protected $baseUrl = 'https://api.openai.com/v1/chat/completions';

    public function __construct()
    {
        $this->apiKey = config('services.openai.key');
        $this->model = config('services.openai.model');
    }

    public function generate($prompt)
    {
        if (empty($this->apiKey)) {
            Log::warning('OpenAI API Key is empty.');
            return null;
        }

        try {
            $response = Http::timeout(30)->withToken($this->apiKey)->post($this->baseUrl, [
                'model' => $this->model,
                'messages' => [
                    ['role' => 'system', 'content' => 'Anda adalah pakar lingkungan EcoTrack.'],
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
            Log::error('OpenAI Service Exception: ' . $e->getMessage());
            return null;
        }
    }

    protected function handleError($response)
    {
        $status = $response->status();
        $body = $response->body();

        switch ($status) {
            case 401:
                Log::error('OpenAI API 401: Invalid API Key.');
                break;
            case 429:
                Log::error('OpenAI API 429: Quota Exceeded.');
                break;
            default:
                Log::error("OpenAI API Error {$status}: {$body}");
        }
    }
}
