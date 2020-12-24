<?php

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('products')->insert([
                'admin_id'            => '1',
                'product_name'        => 'これはテスト投稿、商品名' .$i,
                'bland_name'          => 'これはテスト投稿、ブランド名' .$i,
                'item_category'       => 'これはテスト投稿、アイテムカテゴリー' .$i,
                'product_image'       => null,
                'product_description' => 'これはテスト投稿、商品説明' .$i,
                'price'               => 'これはテスト投稿、価格' .$i,
                'capacity'            => 'これはテスト投稿、容量' .$i,
                'url'                 => 'これはテスト投稿、url' .$i,
                'created_at'          => now(),
                'updated_at'          => now()
            ]);
        }
    }
}
