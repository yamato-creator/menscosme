<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;

class WishlistsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Wishlist $wishlist)
    {
        $user = auth()->user();
        $product_id = $request->product_id;
        $is_favorite = $wishlist->isFavorite($user->id, $product_id);

        if(!$is_favorite) {
            $wishlist->storeFavorite($user->id, $product_id);
            return back();
        }
        return back();

    }

    public function show(Product $product ,Wishlist $wishlist)
    {
        //ユーザー情報
        //ユーザが登録した商品だけ

        $user = auth()->user();
        $wishlist_id = $wishlist->id;
        $products = Product::orderBy('created_at', 'desc')->get();


        return view('wishlists.show', [
            'user'     => $user,
            'products' => $products,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wishlist $wishlist)
    {
        $user_id = $wishlist->user_id;
        $product_id = $wishlist->product_id;
        $favorite_id = $wishlist->id;
        $is_favorite = $wishlist->isFavorite($user_id, $product_id);

        if($is_favorite) {
            $wishlist->destroyFavorite($favorite_id);
            return back();
        }
        return back();
    }
}
