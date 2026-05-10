<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DummyContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // 1. Insert Dummy Blogs
        DB::table('blogs')->insert([
            [
                'title' => '10 Secrets to Building Muscle at Home',
                'slug' => '10-secrets-to-building-muscle-at-home',
                'user_id' => 1,
                'category_id' => null,
                'excerpt' => 'Building muscle doesn\'t always require heavy weights.',
                'content' => "Building muscle doesn't always require heavy weights. Bodyweight exercises, resistance bands, and consistency are key.\n\n\"The only bad workout is the one that didn't happen.\" Keep pushing yourself daily!",
                'status' => 'published',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title' => 'Mastering Mental Clarity',
                'slug' => 'mastering-mental-clarity',
                'user_id' => 1,
                'category_id' => null,
                'excerpt' => 'Taking 10 minutes a day to meditate can significantly lower your cortisol levels.',
                'content' => "In today's fast-paced world, taking 10 minutes a day to meditate can significantly lower your cortisol levels and improve focus.\n\n\"Your mind will answer most questions if you learn to relax and wait for the answer.\" Take a deep breath.",
                'status' => 'published',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title' => 'The Power of Hydration',
                'slug' => 'the-power-of-hydration',
                'user_id' => 1,
                'category_id' => null,
                'excerpt' => 'Mild dehydration can cause significant drops in energy levels.',
                'content' => "Did you know that mild dehydration can cause significant drops in energy levels and brain function? Drink at least 3 liters of water a day.\n\n\"Water is the driving force of all nature.\" Stay hydrated!",
                'status' => 'published',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);

        // 2. Insert Dummy Recipes
        DB::table('recipes')->insert([
            [
                'user_id' => 1,
                'title' => 'High-Protein Oatmeal',
                'description' => "High-Protein Oatmeal\n\nIngredients:\n- 1 cup Oats\n- 1 scoop Whey Protein\n- 1/2 cup Almond Milk\n- Handful of Berries\n\nInstructions:\n1. Mix oats and milk. Microwave for 2 mins.\n2. Stir in protein powder.\n3. Top with fresh berries and enjoy!",
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'title' => 'Grilled Lemon Herb Salmon',
                'description' => "Grilled Lemon Herb Salmon\n\nIngredients:\n- 1 Salmon Fillet\n- 2 tbsp Lemon Juice\n- 1 tbsp Olive Oil\n- Fresh Dill\n- Salt & Pepper\n\nInstructions:\n1. Marinate the salmon in lemon juice, olive oil, and herbs for 15 mins.\n2. Grill on medium heat for 6-8 mins per side.\n3. Serve with a side of steamed veggies.",
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'title' => 'Green Power Smoothie',
                'description' => "Green Power Smoothie\n\nIngredients:\n- 1 cup Spinach\n- 1/2 Banana\n- 1/2 cup Greek Yogurt\n- 1 tbsp Chia Seeds\n- 1 cup Water\n\nInstructions:\n1. Add all ingredients to a blender.\n2. Blend on high until smooth.\n3. Drink immediately for maximum nutrient absorption.",
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
