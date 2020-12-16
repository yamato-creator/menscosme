<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Models\User;


class LoginTest extends TestCase
{
    use DatabaseTransactions;

    // protected $user;

    // public function setUp(): void
    // {
    //     parent::setUp();

    //     // テストユーザ作成
    //     $this->user = factory(User::class)->create();
    // }

    /**
     * login画面表示
     * @test
     */
    public function user_can_view_login()
    {
        $this->get('login')
            ->assertStatus(200);
    }

    /**
     * login
     * @test
     */
    // public function Login(): void
    // {
    //     $user = factory(User::class)->create();
    //     $response = $this->json('POST', route('login'), [
    //         'email' => $this->user->email,
    //         'password' => 'test0000',
    //     ]);

    //     $this->assertAuthenticatedAs($this->user);
    // }
    /**
     * logout
     * @test
     */
    // public function Logout(): void
    // {
    //     $user = factory(User::class)->create();
    //     // actingAsヘルパで現在認証済みのユーザーを指定する
    //     $response = $this->actingAs($this->user);

    //     // ログアウトページへリクエストを送信
    //     $response = $this->json('GET', route('logout'));

    //     // ログアウト後のレスポンスで、HTTPステータスコードが正常であることを確認
    //     $response->assertStatus(302);

    //     // ユーザーが認証されていないことを確認
    //     $this->assertGuest();
    // }

}
