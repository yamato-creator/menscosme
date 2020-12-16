<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Tweet;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * user画面表示
     * @test
     */
    public function DisplayUsers()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user);

        $response->get('/users')
         ->assertSuccessful();
    }

    /**
     * user情報更新
     * @test
     */
    public function testUpdateUser()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user);
        $user_id = $user->id;
        #アップロードしたプロフィールデータがDBにあるかテスト
        $data = [
            'screen_name' => $user->screen_name,
            'name' => $user->name,
            'email' => $user->email,
            'profile_image' => $user->profile_image,
        ];
        $response->post('/users/'.$user_id,$data);
        $response->assertDatabaseHas('users', $data);

//平仮名カタカナ英文字記号なども？
        #不正な形式のプロフィールが登録されないかテスト
        $Bad_testUserName = "testUserバッドテスト@";
        $Bad_data = [
            'screen_name' => $Bad_testUserName,
            'name' => $user->name,
            'email' => $user->email,
            'profile_image' => $user->profile_image,
        ];
        $response->put('/users/'.$user_id,$data);
        $response->assertDatabaseMissing('users', [
            'screen_name' => $Bad_testUserName,
        ]);
    }


}
