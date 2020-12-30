<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
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
        $product = new Product;

        if(!is_null($request->product_image)){

            $imageFile = $request->product_image;
            $list = FileUploadServices::fileUpload($imageFile);
            list($extension, $fileNameToStore, $fileData) = $list;
            $data_url = CheckExtensionServices::checkExtension($fileData, $extension);
            $image = Image::make($data_url);
            $image->resize(150,150)->save(storage_path() . '/app/public/images/' . $fileNameToStore );

            $product->product_image = $fileNameToStore;
        }

        $product->admin_id = 1;
        $product->product_name = $request->input('product_name');
        $product->bland_name = $request->input('bland_name');
        $product->item_category = $request->input('item_category');
        $product->product_description = $request->input('product_description');
        $product->price = $request->input('price');
        $product->capacity = $request->input('capacity');
        $product->url = $request->input('url');

        $product->save();


        return redirect('admin/products');
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
        $product = product::find($id);

        $id = $product->id;

        if(!is_null($request->product_image)){
            $imageFile = $request->product_image;

            $list = FileUploadServices::fileUpload($imageFile);
            list($extension, $fileNameToStore, $fileData) = $list;
            $data_url = CheckExtensionServices::checkExtension($fileData, $extension);
            $image = Image::make($data_url);
            $image->resize(400,400)->save(storage_path() . '/app/public/images/' . $fileNameToStore );

            $product->product_image = $fileNameToStore;
        }

        $product->admin_id = 1;
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

        return redirect('admin/products');
    }
}
