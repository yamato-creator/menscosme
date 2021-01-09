<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admins;
use App\Models\Product;
use Intervention\Image\Facades\Image;
use App\Services\CheckExtensionServices;
use App\Services\FileUploadServices;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(9);

        return view('products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $user_id = $user->id;
        $product = new Product;

        // バリデーション
        Validator::make($request->all(), [
            'product_image' => 'file|image|max:2048|nullable'
        ])->validate();

        if ($request['product_image']) {
            $file = $request->file('product_image');
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file("product_image")->getClientOriginalExtension();
            $filenameToStore = $filename."_".time().".".$extension;

            // 画像を横幅150px・縦幅アスペクト比維持の自動サイズへリサイズ
            $image = Image::make($file)->resize(150,150);

            // S3に画像をアップロード
            Storage::disk('s3')->put('product_image/'.$filenameToStore, (string) $image->encode(),'public');
            $product->product_image = $filenameToStore;
        }

        $product->admin_id = $user_id;
        $product->product_name = $request->input('product_name');
        $product->bland_name = $request->input('bland_name');
        $product->item_category = $request->input('item_category');
        $product->product_description = $request->input('product_description');
        $product->price = $request->input('price');
        $product->capacity = $request->input('capacity');
        $product->url = $request->input('url');

        $product->save();


        return redirect('admin/products/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = product::find($id);

        return view('products.show', [
            'product'     => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = product::find($id);

        return view('products.edit', [
            'product'     => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $user_id = $user->id;
        $product = product::find($id);
        $id = $product->id;

         // バリデーション
         Validator::make($request->all(), [
            'product_image' => 'file|image|max:2048|nullable'
        ])->validate();

        if ($request['product_image']) {
            $file = $request->file('product_image');
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file("product_image")->getClientOriginalExtension();
            $filenameToStore = $filename."_".time().".".$extension;

            // 画像を横幅150px・縦幅アスペクト比維持の自動サイズへリサイズ
            $image = Image::make($file)->resize(150,150);

            // S3に画像をアップロード
            Storage::disk('s3')->put('product_image/'.$filenameToStore, (string) $image->encode(),'public');
            $product->product_image = $filenameToStore;
        }

        $product->admin_id = $user_id;
        $product->product_name = $request->input('product_name');
        $product->bland_name = $request->input('bland_name');
        $product->item_category = $request->input('item_category');
        $product->product_description = $request->input('product_description');
        $product->price = $request->input('price');
        $product->capacity = $request->input('capacity');
        $product->url = $request->input('url');

        $product->save();

        return redirect(action('Admin\ProductController@show', [
            'id' => $id
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = product::find($id);
        $product->delete();

        return redirect('admin/products/index');
    }
}
