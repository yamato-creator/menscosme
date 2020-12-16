<?php

use Illuminate\Database\Seeder;
use App\Models\Wishlist;

class WishlistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Wishlist::create([
                'user_id'    => $i,
                'product_id' => $i,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
