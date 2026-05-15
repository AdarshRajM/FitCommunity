<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function message(Request $request)
    {
        $message = $request->input('message') ?? '';
        $media = $request->file('media');
        $mediaType = $request->input('mediaType'); // 'image' or 'audio'

        $apiKey = env('GEMINI_API_KEY');

        // If no API key is provided, fallback to a mocked response for demonstration
        if (!$apiKey) {
            $mockReply = "I received your message! ";
            if ($media && $mediaType == 'image') $mockReply .= "What a great photo! ";
            if ($media && $mediaType == 'audio') $mockReply .= "I heard your voice note clearly! ";
            if (!$media) $mockReply .= "How can I help you with FitCommunity today?";
            
            return response()->json(['reply' => $mockReply]);
        }

        $parts = [];
        
        // Dynamic system instruction prefix to train it for FitCommunity
        $prompt = "You are 'Fit AI', an advanced, highly intelligent, and conversational AI assistant for 'FitCommunity' (a premium fitness, mental health, and medical tracking platform). 
        Rules:
        1. Never start your response with 'I am an AI...'. Speak naturally like an expert human coach/doctor.
        2. Read the user's message carefully. Do not repeat the same generic answer. Respond dynamically based on context.
        3. If asked for a diet/recipe plan, provide a structured, practical, macro-friendly plan.
        4. If the user sends an image or audio, acknowledge its specific contents (e.g. 'I see your workout photo' or 'I hear your question about...').
        5. For medical queries, give helpful advice but include a brief disclaimer to consult a doctor.
        6. Use the same language the user uses.
        
        User Message: " . $message;
        
        $parts[] = ['text' => $prompt];

        if ($media) {
            $mimeType = $media->getMimeType();
            $base64Data = base64_encode(file_get_contents($media->getRealPath()));

            $parts[] = [
                'inlineData' => [
                    'mimeType' => $mimeType,
                    'data' => $base64Data
                ]
            ];
        }

        $payload = [
            'contents' => [
                [
                    'parts' => $parts
                ]
            ]
        ];

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . $apiKey, $payload);

            if ($response->successful()) {
                $data = $response->json();
                $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Sorry, I could not generate a response.';
                return response()->json(['reply' => $reply]);
            } else {
                Log::error('Gemini API Error: ' . $response->body());
                return response()->json(['reply' => 'Sorry, there was an error communicating with the AI server.'], 500);
            }
        } catch (\Exception $e) {
            Log::error('Gemini API Exception: ' . $e->getMessage());
            return response()->json(['reply' => 'An unexpected error occurred. Please try again later.'], 500);
        }
    }
}
