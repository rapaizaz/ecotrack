<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenAiService
{
    public $apiKey;
    public $model;
    public $lastError = null;
    public $lastErrorStatus = null;
    protected $baseUrl = 'https://api.openai.com/v1/chat/completions';

    public function __construct()
    {
        $this->apiKey = config('services.openai.key');
        $this->model = config('services.openai.model', 'gpt-4o-mini');
    }

    public function setCredentials($apiKey, $model)
    {
        $this->apiKey = $apiKey;
        $this->model = $model ?: 'gpt-4o-mini';
    }

    public function generate($prompt)
    {
        if (empty($this->apiKey)) {
            $this->lastError = 'OpenAI API Key is empty.';
            Log::warning($this->lastError);
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
                $text = $result['choices'][0]['message']['content'] ?? null;
                if ($text) {
                    $this->lastErrorStatus = null;
                    return $text;
                }
            }

            $this->handleError($response);
        } catch (\Exception $e) {
            $this->lastErrorStatus = 500;
            $this->lastError = 'OpenAI Service Exception: ' . $e->getMessage();
            Log::error($this->lastError);
        }

        return null;
    }

    protected function handleError($response)
    {
        $this->lastErrorStatus = $response->status();
        $body = $response->body();
        $this->lastError = "OpenAI API Error (status {$this->lastErrorStatus}): {$body}";

        switch ($this->lastErrorStatus) {
            case 401:
                Log::error('OpenAI API 401: Invalid API Key.');
                break;
            case 429:
                Log::error('OpenAI API 429: Quota Exceeded.');
                break;
            default:
                Log::error("OpenAI API Error {$this->lastErrorStatus}: {$body}");
        }
    }
}
