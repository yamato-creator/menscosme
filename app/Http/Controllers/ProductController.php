<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Review;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product, Review $review, Request $request)
    {
        $user = auth()->user();
        $query = Product::query();

        $search = $request->input('search');

        if($search !== null){
            //全角スペースを半角に
            $search_split = mb_convert_kana($search,'s');

            //空白で区切る
            $search_split2 = preg_split('/[\s]+/', $search_split,-1,PREG_SPLIT_NO_EMPTY);

            //単語をループで回す
            foreach($search_split2 as $value)
            {
            $query->where('product_name','like','%'.$value.'%')->orwhere('item_category','like','%'.$value.'%')->orwhere('product_description','like','%'.$value.'%');
            }
        };

        $products = $query->orderBy('created_at', 'desc')->paginate(10);

        // $product_ids = Product::select('id')->get();

        // $reviews_stars = Review::select('star')->get();
        // $reviews_product_ids = Review::select('product_id')->get();

        // foreach($reviews_stars as $reviews_star){
        //     $reviews_star->star;
        // }

        return view('products_to_user.index', [
            'user'     => $user,
            'products' => $products,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Product $product, Review $review)
    {
        $user = auth()->user();
        $user_id = $user->id;
        $product = $product->getProduct($id);
        $product_id = $product->id;
        $reviews = $review->getReviews($product_id);
        $user_reviews = $review->getUserReviews($user_id,$product_id);

        $average_star = $review->where('product_id', $product_id)->select('star')->avg('star');
        $average_star = ceil($average_star);

        return view('products_to_user.show', [
            'user'         => $user,
            'product'      => $product,
            'reviews'      => $reviews,
            'user_reviews' => $user_reviews,
            'average_star' => $average_star
        ]);
    }

}