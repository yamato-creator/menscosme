<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_name','bland_name','item_category','product_image','product_description','price','capacity','url'
    ];


    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function wishlists()
    {
      return $this->hasMany(Wishlist::class, 'product_id');
    }

    public function getProduct(Int $product_id)
    {
        return $this->where('id', $product_id)->first();
    }

}
