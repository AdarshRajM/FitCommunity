<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('posts')->insert([
            [
                'user_id' => 1,
                'category_id' => null,
                'title' => 'My first meditation session!',
                'content' => "I just tried the 10-minute guided breathing session in the Meditation Hub. I feel so much more relaxed and centered. Anyone else incorporating meditation into their daily routine?",
                'hashtags' => json_encode(['#meditation', '#mentalhealth', '#wellness']),
                'is_published' => true,
                'is_approved' => true,
                'views' => 120,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 1,
                'category_id' => null,
                'title' => 'Hydration Challenge Update',
                'content' => "Hit my 3-liter goal today! The new water tracker is super helpful. Remember guys, staying hydrated is just as important as the workout itself. Keep it up!",
                'hashtags' => json_encode(['#hydration', '#health', '#fitness']),
                'is_published' => true,
                'is_approved' => true,
                'views' => 85,
                'created_at' => $now->subHours(2),
                'updated_at' => $now->subHours(2)
            ],
            [
                'user_id' => 1,
                'category_id' => null,
                'title' => 'Looking for high-protein vegan recipes',
                'content' => "Hey FitCommunity! I am trying to transition to a plant-based diet but struggling to hit my protein macros. Any recommendations for good high-protein vegan meals?",
                'hashtags' => json_encode(['#vegan', '#nutrition', '#protein']),
                'is_published' => true,
                'is_approved' => true,
                'views' => 45,
                'created_at' => $now->subDays(1),
                'updated_at' => $now->subDays(1)
            ],
            [
                'user_id' => 1,
                'category_id' => null,
                'title' => 'Yoga for Beginners session was amazing',
                'content' => "Just finished the live group session for Yoga. The instructor was incredible. Can't wait for the next one!",
                'hashtags' => json_encode(['#yoga', '#flexibility', '#groupclass']),
                'is_published' => true,
                'is_approved' => true,
                'views' => 210,
                'created_at' => $now->subDays(2),
                'updated_at' => $now->subDays(2)
            ]
        ]);
    }
}
