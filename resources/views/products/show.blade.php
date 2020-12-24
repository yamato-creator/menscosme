@extends('layouts.app_admin')

@section('content')
商品詳細
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="card-haeder p-3 w-100 d-flex">
                    <div class="ml-2 d-flex flex-column">
                        @if(!is_null($product->product_image))
                        <img src="{{ asset('images/' .$product->product_image) }}">
                        @else
                        <img src="{{ asset('default_product_image/default.jpeg') }}">
                        @endif
                        <p class="mb-0">{{ $product->product_name }}</p>
                        <p class="mb-0">{{ $product->bland_name }}</p>
                        <p class="mb-0">{{ $product->item_category }}</p>
                        <p class="mb-0">{{ $product->product_description }}</p>
                        <p class="mb-0">{{ $product->price }}</p>
                        <p class="mb-0">{{ $product->capacity }}</p>
                        <p class="mb-0">{{ $product->url }}</p>
                    </div>
                </div>
                @if(Auth::check())
                <div class="card-footer py-1 d-flex justify-content-end bg-white">
                        <div class="dropdown mr-3 d-flex align-items-center">
                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-fw"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <form method="POST" action="{{ route('products.destroy', ['id' => $product->id ]) }}"  class="mb-0">
                                    @csrf
                                    <a href="{{ url('admin/products/edit/'.$product->id ) }}" class="dropdown-item">編集</a>
                                    <button  class="dropdown-item del-btn">削除</button>
                                </form>
                            </div>
                        </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection