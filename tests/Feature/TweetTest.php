<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Tweet;

class TweetTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function Index()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get(route('tweets.index'));

        $response->assertStatus(200)
            ->assertViewIs('tweets.index');
    }

    /**
     * @test
     */
    public function Create()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get(route('tweets.create'));

        $response->assertStatus(200)
            ->assertViewIs('tweets.create');
    }

    /**
     *アップロードした投稿データがDBにあるか
     * @test
     */
    public function CreateTweet()
    {
        $user = factory(User::class)->create();
        $user_id = $user->id;

        $tweet = factory(Tweet::class)->create([
            "user_id" => $user_id,
        ]);

        $response = $this->actingAs($user);
        $data = [
            'text' => $tweet->text,
        ];
        $response->post('/tweets',$data);
        $response->assertDatabaseHas('tweets', $data);
    }

    /**
     *投稿一覧に投稿データがあるか
     * @test
     */
    public function IndexTweet()
    {
        $user = factory(User::class)->create();
        $user_id = $user->id;

        $tweet = factory(Tweet::class)->create([
            "user_id" => $user_id,
        ]);

        $response = $this->actingAs($user);
        $data = [
            'text' => $tweet->text,
        ];
        $response->post('/tweets',$data);
        $response = $response->get('tweets');
        $response->assertSeeText($tweet->text);
    }


    /**
     *投稿詳細に投稿データがあるか
     * @test
     */
    public function ShowTweet()
    {
        $user = factory(User::class)->create();
        $user_id = $user->id;

        $tweet = factory(Tweet::class)->create([
            "user_id" => $user_id,
        ]);

        $response = $this->actingAs($user);
        $data = [
            'text' => $tweet->text,
        ];
        $response->post('/tweets',$data);
        $response = $response->get('/users/'.$user_id);

        $response->assertSeeText($tweet->text);
    }

    /**
     *ログインユーザーが投稿データを変更
     * @test
     */
    public function UpdateTweet()
    {
        $user = factory(User::class)->create();
        $user_id = $user->id;

        $tweet = factory(Tweet::class)->create([
            "user_id" => $user_id,
        ]);

        $response = $this->actingAs($user);
        $data = [
            'text' => $tweet->text,
        ];
        $response->post('/tweets/'.$tweet->id,$data);
        $response->assertDatabaseHas('tweets', $data);
    }

    /**
     * 投稿一覧画面で投稿が確認できるか
     * @test
     */
    public function CheckIsTweetByOutsider(){
        $creater_user = factory(User::class)->create();
        $outsider_user = factory(User::class)->create();

        $tweet = factory(Tweet::class)->create([
            "user_id" => $creater_user->id,
        ]);
        $response = $this->actingAs($outsider_user);
        $response = $this->get('tweets');
        $response->assertSee($tweet->text);
    }

    /**
     * 投稿詳細画面で投稿が確認できるか
     * @test
     */
    public function CheckIsShowTweetByOutsider(){
        $creater_user = factory(User::class)->create();
        $outsider_user = factory(User::class)->create();

        $tweet = factory(Tweet::class)->create([
            "user_id" => $creater_user->id,
        ]);
        $response = $this->actingAs($outsider_user);
        $response = $this->get('users/'.$tweet->user_id);
        $response->assertSee($tweet->text);
    }

    /**
     * 投稿が認証ユーザーのものなら削除更新ボタンが出る
     * @test
     */
    public function IsTweetUserEditByLoginUser() {
        $user_a = factory(User::class)->create();
        $user_b = factory(User::class)->create();

        $user_ids = [$user_a->id,$user_b->id];

        foreach($user_ids as $user_id) {
            $tweet = factory(Tweet::class)->create([
                "user_id" => $user_id,
            ]);
        }
        $this->actingAs($user_a)
             ->get("/users/{$user_a->id}")
             ->assertSee("編集")
             ->assertSee("削除")
             ->assertSee("fa-ellipsis-v");

        $this->actingAs($user_a)
             ->get("/users/{$user_b->id}")
             ->assertDontSee("削除")
             ->assertDontSee("fa-ellipsis-v");
    }

    /**
     * ログインしていないと投稿削除更新ボタンが出ない
     * @test
     */
    public function IsTweetUserEditByNoLoginUser() {
        $user = factory(User::class)->create();
        $this->get("/users/{$user->id}")
             ->assertDontSee("削除")
             ->assertDontSee("fa-ellipsis-v");
    }


}
