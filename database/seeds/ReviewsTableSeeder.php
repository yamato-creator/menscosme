<?php

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Review::create([
                'user_id'    => $i,
                'product_id' => $i,
                'comment'    => 'これはテスト投稿' .$i,
                'star'       => rand(1,5),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
