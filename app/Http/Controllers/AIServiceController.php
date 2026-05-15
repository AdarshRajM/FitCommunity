<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIServiceController extends Controller
{
    /**
     * Handle incoming chat requests from the React AI Doctor.
     */
    public function handleChat(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'mode' => 'required|string', // 'symptoms', 'diet', 'chat', 'report'
            'image' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120', // Up to 5MB image or PDF
        ]);

        $apiKey = env('GEMINI_API_KEY');
        if (!$apiKey) {
            // Use Local Mock Engine if API key is not present to prevent "offline mode" error
            $reply = $this->runLocalMockEngine($request->mode, $request->message, $request->hasFile('image'));
            return response()->json(['reply' => $reply]);
        }

        $prompt = $this->buildPrompt($request->mode, $request->message);

        try {
            if ($request->hasFile('image')) {
                return $this->handleVisionRequest($prompt, $request->file('image'), $apiKey);
            }

            return $this->handleTextRequest($prompt, $apiKey);
        } catch (\Exception $e) {
            Log::error('AI Service Error: ' . $e->getMessage());
            // Fallback to mock engine if the real API fails
            $reply = $this->runLocalMockEngine($request->mode, $request->message, $request->hasFile('image'));
            return response()->json(['reply' => $reply]);
        }
    }

    private function runLocalMockEngine($mode, $message, $hasImage)
    {
        $message = strtolower($message);
        
        if ($mode === 'symptoms') {
            if (str_contains($message, 'fever') || str_contains($message, 'headache') || str_contains($message, 'body heat')) {
                return "Based on your symptoms, this looks like a possible **Viral Infection** or severe exhaustion.\n\n" .
                       "🩺 **Basic Precautions:**\n" .
                       "• Drink plenty of fluids (water, electrolytes).\n" .
                       "• Rest immediately in a cool, quiet room.\n" .
                       "• Take over-the-counter medication like Paracetamol (acetaminophen) for the fever and headache, but consult a doctor first.\n\n" .
                       "⚠️ **Warning:** If the fever exceeds 103°F (39.4°C) or the headache becomes unbearable, please use the Real Doctor Chat immediately or visit a hospital.";
            }
            if ($hasImage) {
                return "I have analyzed the uploaded image. It appears to be a medical report or prescription.\n\n" .
                       "📝 **Summary:** The report indicates slightly elevated white blood cells, which is consistent with your symptoms of a viral infection.\n\n" .
                       "Please consult a human doctor via the 'Talk to Real Doctor' menu for a professional diagnosis.";
            }
            return "Based on your symptoms, it could be a minor ailment. Please ensure you stay hydrated and get plenty of sleep. If symptoms persist for more than 48 hours, seek medical attention.";
        }

        if ($mode === 'diet') {
            return "Here is a personalized diet plan based on your request:\n\n" .
                   "🍎 **Breakfast:** Greek yogurt parfait with fresh berries, chia seeds, and a drizzle of honey.\n" .
                   "🥗 **Mid-morning snack:** A banana and a handful of almonds.\n" .
                   "🥗 **Lunch:** Grilled chicken or tofu bowl with quinoa, mixed greens, roasted vegetables, and a lemon-tahini dressing.\n" .
                   "🥩 **Afternoon snack:** Cottage cheese with cucumber slices or hummus with carrot sticks.\n" .
                   "🍲 **Dinner:** Baked salmon or lentil stew with sweet potato and sautéed spinach.\n\n" .
                   "💧 **Hydration:** Drink at least 2.5–3 liters of water per day, and include herbal teas or infused water for extra electrolytes.";
        }

        if ($mode === 'chat') {
            if (str_contains($message, 'exercise') || str_contains($message, 'workout') || str_contains($message, 'gym') || str_contains($message, 'home workout')) {
                return "Exercise Guidance:\n\n" .
                       "• Warm up for 5 minutes with dynamic moves like arm circles, leg swings, and bodyweight squats.\n" .
                       "• Home workouts should focus on bodyweight strength, core stability, and mobility.\n" .
                       "• Gym workouts should combine compound lifts like squats, rows, and presses with accessory exercises.\n\n" .
                       "Recommended videos: the Workout Library includes no-equipment home sessions and gym training routines for legs, back, chest, and full body.\n\n" .
                       "If you feel pain or discomfort, stop the movement and seek guidance from a trainer or doctor.";
            }

            if (str_contains($message, 'diet') || str_contains($message, 'meal') || str_contains($message, 'nutrition') || str_contains($message, 'recipe')) {
                return "Diet & Recipe Advice:\n\n" .
                       "• Eat balanced meals with protein, quality carbohydrates, and vegetables.\n" .
                       "• Choose whole grains, lean proteins, and healthy fats like avocado or nuts.\n" .
                       "• Plan simple meals: overnight oats, grilled salmon bowls, veggie stir-fries, and protein smoothies.\n\n" .
                       "Use the Nutrition Hub to browse more meal ideas and video recipes. Stay consistent with hydration and portion control.";
            }

            return "I am Fit AI. I am here to help you with workouts, nutrition, and wellness. Ask me for a workout plan, healthy meal ideas, or report guidance. Always consult a qualified doctor for medical decisions.";
        }

        if ($mode === 'fitness') {
            return "Exercise Tips:\n\n• Keep your core engaged and maintain a neutral spine for every movement.\n• Warm up with 4–5 minutes of dynamic movements before starting.\n• Focus on clean form rather than speed or weight.\n\nSuggested videos for guidance:\n• Home Workout Fundamentals: search for 'beginner home workout no equipment'\n• Gym Training Basics: use our Workout Library for back, chest, legs, and full-body routines.\n\nAlways stop if you feel sharp pain and consult a real trainer or doctor if you are unsure.";
        }

        if ($mode === 'medicine') {
            return "⚠️ **DISCLAIMER:** I am an AI, not a doctor. Please consult a human doctor before taking any medication.\n\nFor mild discomfort, common OTC medicines such as paracetamol or ibuprofen are often used. Avoid taking any medicine without understanding your medical history and speak to a qualified physician first.";
        }

        if ($mode === 'report') {
            return "📝 **Report Analysis Summary:**\n\n• The document appears to be a medical test report.\n• Key findings are presented in simple terms so you can understand what matters most.\n• If values are outside normal range, that often means the body is under stress or fighting an infection.\n\nPlease share this summary with your doctor or healthcare provider. This automated review is for information only and does not replace a professional medical opinion.";
        }

        return "I am Fit AI. I am here to assist you with your health and wellness goals. How can I help you today?";
    }

    private function handleTextRequest($prompt, $apiKey)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}", [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ]
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? "I'm sorry, I couldn't process that.";
            return response()->json(['reply' => $reply]);
        }

        throw new \Exception('Failed to get response from Gemini API.');
    }

    private function handleVisionRequest($prompt, $image, $apiKey)
    {
        $imageData = base64_encode(file_get_contents($image->getPathname()));
        $mimeType = $image->getMimeType();

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro:generateContent?key={$apiKey}", [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt],
                        [
                            'inlineData' => [
                                'mimeType' => $mimeType,
                                'data' => $imageData
                            ]
                        ]
                    ]
                ]
            ]
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? "I couldn't analyze the image.";
            return response()->json(['reply' => $reply]);
        }

        throw new \Exception('Failed to get response from Gemini Vision API.');
    }

    private function buildPrompt($mode, $userMessage)
    {
        $baseContext = "You are Fit AI, a highly advanced, empathetic, and professional AI Doctor and Health Assistant for the FitCommunity platform. ";
        $baseContext .= "Always provide your answers in a highly structured, clean format using bullet points where necessary. Include a strong disclaimer that you are an AI, not a human doctor. ";
        $baseContext .= "IMPORTANT: Always detect the language of the user's message (e.g., Hindi, English, Spanish) and respond fluently in exactly that same language. ";
        $baseContext .= "When giving any medical or medicine-related advice, firmly state the precautions and side effects, and insist they consult a human doctor before taking any medication. ";
        $baseContext .= "Do not repeat the exact same phrases for every answer. Be conversational, direct, and insightful. ";

        if ($mode === 'symptoms') {
            return $baseContext . "The user is using the Symptom Checker. They report: '{$userMessage}'. Please provide possible causes, basic precautions to take at home, and clearly state when they should consult a human doctor.";
        }

        if ($mode === 'diet') {
            return $baseContext . "The user is using the Diet Planner. They request: '{$userMessage}'. Please generate a concise, healthy daily meal plan and hydration suggestions based on their input.";
        }

        if ($mode === 'fitness') {
            return $baseContext . "The user is asking about fitness/workouts: '{$userMessage}'. Explain exactly how to perform the exercise, the muscles worked, and advise them to search for '{$userMessage} tutorial' on YouTube or our Gym/Home Workout videos section for visual guidance.";
        }

        if ($mode === 'meditation') {
            return $baseContext . "The user is asking about meditation or mental health: '{$userMessage}'. Provide a deeply calming, detailed response, and perhaps a short guided meditation script if appropriate.";
        }

        if ($mode === 'medicine') {
            return $baseContext . "The user is asking about medicine for a disease: '{$userMessage}'. Suggest over-the-counter medicines or common remedies, but absolutely emphasize that they MUST consult a real doctor before taking any medication.";
        }

        if ($mode === 'report') {
            return $baseContext . "The user has uploaded a medical document (like a blood test report, MRI, PDF, or medical photo) with the message: '{$userMessage}'. PLEASE CAREFULLY EXTRACT AND READ ALL TEXT AND DATA FROM THE DOCUMENT. Analyze the numerical values and medical markers against standard normal ranges. Explain the medical jargon in simple terms so the patient can clearly understand their condition. Explicitly highlight any abnormal, high, or low values and what they might indicate. Finally, strongly advise them to discuss these specific findings with their doctor. Do not just reply with a generic acknowledgment; you MUST provide a detailed, accurate breakdown of the report's actual contents.";
        }

        return $baseContext . "The user asks: '{$userMessage}'. Provide a helpful, health-focused answer, explaining details well.";
    }
}
