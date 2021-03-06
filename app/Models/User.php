<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'screen_name',
        'name',
        'profile_image',
        'email',
        'password'
    ];

    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }

    public function favorites()
    {
        return $this->belongsToMany('App\Models\Product');
    }

    public function followers()
    {
        return $this->belongsToMany(self::class, 'followers', 'followed_id', 'following_id');
    }

    public function follows()
    {
        return $this->belongsToMany(self::class, 'followers', 'following_id', 'followed_id');
    }

    public function getAllUsers(Int $user_id)
    {
        return $this->Where('id', '<>', $user_id)->paginate(10);
    }

     public function follow(Int $user_id)
     {
         return $this->follows()->attach($user_id);
     }

     public function unfollow(Int $user_id)
     {
         return $this->follows()->detach($user_id);
     }

     // フォローしているか
     public function isFollowing(Int $user_id)
     {
         return (boolean) $this->follows()->where('followed_id', $user_id)->first(['id']);
     }

     // フォローされているか
     public function isFollowed(Int $user_id)
     {
         return (boolean) $this->followers()->where('following_id', $user_id)->first(['id']);
     }

     public function updateProfile(Array $params)
     {
         if (isset($params['profile_image'])) {
             $file_name = $params['profile_image'];
             $image = Storage::disk('s3')->putFile('profile_image', $file_name, 'public');
             $image_path = Storage::disk('s3')->url($image);

             $this::where('id', $this->id)
                 ->update([
                     'screen_name'   => $params['screen_name'],
                     'name'          => $params['name'],
                     'profile_image' => $file_name,
                     'email'         => $params['email'],
                 ]);
         } else {
             $this::where('id', $this->id)
                 ->update([
                     'screen_name'   => $params['screen_name'],
                     'name'          => $params['name'],
                     'email'         => $params['email'],
                 ]);
         }

         return;
     }
}