@extends('layouts.app_admin')

@section('content')

<div class="container">
    <div class="row justify-content-center mb-2">
        <a href="{{ url('admin/products/create') }}" class="btn btn-md btn-primary">商品を登録する</a>
    </div>
    <div class="row justify-content-center">
        @foreach($products as $product)
        <div class="product">
            <div class="col-md-3 col-sm-4 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <a href="{{ url('admin/products/show/' .$product->id) }}">
                            @if(!is_null($product->product_image))
                            <img src="https://menscosme-image-ap-northeast-250991450901.s3-ap-northeast-1.amazonaws.com/product_image/{{ $product->product_image }}">
                            @else
                            <img src="{{ asset('default_product_image/default.png') }}">
                            @endif
                        </a>
                    </div>
                    <div class="panel-body admin_product">
                        <p class="product-brand">{{$product->bland_name}}</p>
                        <p class="product-title"><a href="{{ url('admin/products/show/' .$product->id) }}">{{$product->product_name}}</a></p>
                    </div>
                    <div class="d-flex justify-content-end flex-grow-1">
                        <p class="mb-0 text-secondary">{{ $product->created_at->format('Y-m-d H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="my-4 d-flex justify-content-center">
        {{ $products->links() }}
    </div>
</div>
@endsection