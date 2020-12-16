<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function reviewStore(Int $user_id, Array $data)
    {
        $this->user_id = $user_id;
        $this->product_id = $data['product_id'];
        $this->comment = $data['comment'];
        $this->star = $data['star'];
        $this->save();

        return;
    }

    public function getReviews(Int $product_id)
    {
        return $this->with('user')->where('product_id', $product_id)->orderby('created_at', 'desc')->get();
    }

    public function getUserReviews(Int $user_id, Int $product_id)
    {
        $user_reviews = $this->where('user_id',$user_id)->where('product_id', $product_id)->first();
        return $user_reviews;
    }

}
