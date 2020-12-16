<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wishlist extends Model
{
    public $timestamps = false;
    protected $fillable = ['product_id','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function isFavorite(Int $user_id, Int $product_id)
    {
        return (boolean) $this->where('user_id', $user_id)->where('product_id', $product_id)->first();
    }

    public function storeFavorite(Int $user_id, Int $product_id)
    {
        $this->user_id = $user_id;
        $this->product_id = $product_id;
        $this->save();

        return;
    }

    public function getWishlist(Int $wishlist_id)
    {
        return $this->with('user')->where('id', $wishlist_id)->first();
    }

    public function destroyFavorite(Int $favorite_id)
    {
        return $this->where('id', $favorite_id)->delete();
    }
}
