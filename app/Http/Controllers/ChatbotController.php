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
        
        // System instruction prefix to train it for FitCommunity
        $prompt = "You are a friendly, expert AI assistant and Diet/Recipe Planner for 'FitCommunity', a fitness and health tracking platform. Keep your answers concise, helpful, and directly related to the user's query. If the user asks for a diet planner, meal plan, or recipes, provide a structured, realistic, and healthy meal plan tailored to their request (e.g., keto, vegan, weight loss). If the user sent an image or audio note, acknowledge it and respond appropriately.\n\nUser Message: " . $message;
        
        $parts[] = ['text' => $prompt];

        if ($media) {
            $mimeType = $media->getMimeType();
            $base64Data = base64_encode(file_get_contents($media->getRealPath()));

            $parts[] = [
                'inline_data' => [
                    'mime_type' => $mimeType,
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
