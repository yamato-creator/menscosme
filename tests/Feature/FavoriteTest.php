<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Tweet;
use App\Models\Favorite;

class FavoriteTest extends TestCase
{
    use DatabaseTransactions;


    /**
     * @test
     */
    public function Like()
    {
        $favorite = new Favorite();

        #いいねできているかチェック
        $user = factory(User::class)->create();
        $user_id = $user->id;

        $tweet = factory(Tweet::class)->create([
            'user_id' => $user_id,
        ]);
        $tweet_id = $tweet->id;
        $response = $this->actingAs($user);

        $data = [
            'user_id' => $user_id,
            'tweet_id' => $tweet_id
        ];

        $favorite = $favorite->storeFavorite($user_id, $tweet_id);
        // $response->post('favorites', $data);
        $response->assertDatabaseHas('favorites', $data);

        // #いいねを外せているかチェック
        // $favorite = Favorite::where('user_id',$user_id)->where('tweet_id',$tweet_id)->first();
        // $this->assertNotNull($favorite); // データが取得できたかテスト
        // $favorite_id =$favorite->id;

        // $response->delete('/favorites/'.$favorite_id);
        // $response->assertDatabaseMissing('favorites', [
        //     'user_id' => $user_id,
        //     'tweet_id' => $tweet_id
        // ]);
    }
}
