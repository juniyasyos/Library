<?php

namespace App\Http\Controllers\Chatbot;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Chatbot extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'history' => 'sometimes|array',
        ]);

        $message = $request->input('message');
        $history = $request->input('history', []);

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('GEMINI_API_KEY'),
            ])->post('https://api.google.com/generativeai/v1beta/models/gemini-1.5-flash:generateText', [
                        'prompt' => [
                            'text' => $this->buildPrompt($message, $history),
                        ],
                    ]);

            if ($response->successful()) {
                $data = $response->json();
                $responseText = $this->extractResponseText($data);
                return response($responseText, 200)
                    ->header('Content-Type', 'text/plain');
            } else {
                return response('Gemini API Error: ' . $response->body(), 500);
            }
        } catch (\Exception $e) {
            return response('Error communicating with Gemini: ' . $e->getMessage(), 500);
        }
    }

    private function buildPrompt($message, $history)
    {
        $prompt = "";
        foreach ($history as $turn) {
            $prompt .= $turn['role'] . ": " . $turn['parts'][0]['text'] . "\n";
        }
        $prompt .= "user: " . $message . "\n";
        $prompt .= "gemini:"; // Prompt Gemini untuk memberikan respons
        return $prompt;
    }

    private function extractResponseText($responseData)
    {
        if (isset($responseData['candidates'][0]['output']['text'])) {
            return $responseData['candidates'][0]['output']['text'];
        } else {
            // Handle jika struktur respons berbeda atau terjadi kesalahan
            return 'Error extracting response from Gemini.';
        }
    }
}

