<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NutritionController extends Controller
{
    public function index()
    {
        return view('nutrition.index');
    }

    public function analyze(Request $request)
    {
        $request->validate([
            'meal' => 'required|string|max:255',
        ]);

        $meal = $request->meal;
        
        // Mock data based on user's screenshot requirement
        // In a real scenario, we would call Gemini or another AI API here
        $nutritionData = [
            'name' => ucfirst($meal),
            'calories' => 70,
            'protein' => 6,
            'carbs' => 0,
            'fats' => 5,
            'protein_pct' => 55,
            'carbs_pct' => 0,
            'fats_pct' => 45,
            'insights' => [
                "A large " . strtolower($meal) . " contains approximately 70 calories.",
                "It is a good source of protein and relatively low in carbs and fats."
            ]
        ];

        // Let's add a bit of variety if they search something else
        if (stripos($meal, 'apple') !== false) {
            $nutritionData = [
                'name' => ucfirst($meal),
                'calories' => 95,
                'protein' => 0,
                'carbs' => 25,
                'fats' => 0,
                'protein_pct' => 0,
                'carbs_pct' => 100,
                'fats_pct' => 0,
                'insights' => [
                    "A medium " . strtolower($meal) . " contains about 95 calories.",
                    "It is high in carbs (mostly healthy sugars and fiber) and contains almost no fat or protein."
                ]
            ];
        }

        return view('nutrition.index', compact('nutritionData', 'meal'));
    }
}
