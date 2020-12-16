<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Tweet;
use App\Models\Comment;

class CommentTest extends TestCase
{
    use DatabaseTransactions;

    /**
     *アップロードしたコメントデータがDBにあるか
     * @test
     */
    // public function CreateComment()
    // {
    //     $comment = factory(Comment::class)->create();
    //     $user = User::find($comment->user_id);
    //     $tweet = Tweet::find($comment->tweet_id);

    //     $response = $this->actingAs($user);
    //     $response = $this->$tweet;
    //     $data = [
    //         'text' => $comment->text,
    //     ];

    //     $response->post('/comments',$data);
    //     $response->assertDatabaseHas('comments',$data);
    // }
}
