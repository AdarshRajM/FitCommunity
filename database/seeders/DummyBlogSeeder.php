<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DummyBlogSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('blogs')->insert([
            [
                'title' => 'Sleep: The Ultimate Performance Enhancer',
                'slug' => 'sleep-the-ultimate-performance-enhancer',
                'user_id' => 1,
                'category_id' => null,
                'excerpt' => 'Why 8 hours of sleep is better than any supplement.',
                'content' => "Sleep is the body's natural way of repairing muscle, consolidating memories, and balancing hormones. Skipping sleep reduces testosterone and increases cortisol.\n\n\"A good laugh and a long sleep are the best cures in the doctor's book.\" - Irish Proverb",
                'status' => 'published',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title' => 'How to Overcome Gym Anxiety',
                'slug' => 'how-to-overcome-gym-anxiety',
                'user_id' => 1,
                'category_id' => null,
                'excerpt' => 'Everyone starts somewhere. Here is how to step into the gym with confidence.',
                'content' => "Walking into a gym for the first time can be intimidating. Remember that every single person there was once a beginner. Focus on your own journey, wear clothes you feel comfortable in, and follow a simple plan.\n\n\"The hardest lift of all is lifting your butt off the couch.\" - Unknown",
                'status' => 'published',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'title' => 'Nutrition 101: Macros Explained',
                'slug' => 'nutrition-101-macros-explained',
                'user_id' => 1,
                'category_id' => null,
                'excerpt' => 'A simple guide to proteins, fats, and carbohydrates.',
                'content' => "Macronutrients are the building blocks of your diet. Proteins repair muscle, carbohydrates provide energy, and fats regulate hormones. Balancing them is the key to a sustainable diet.\n\n\"Let food be thy medicine and medicine be thy food.\" - Hippocrates",
                'status' => 'published',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
