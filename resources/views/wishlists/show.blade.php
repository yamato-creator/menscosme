@extends('layouts.app')

@section('content')
<h1 class="text-center font-family-Tahoma">{{$user->name}}さんの欲しいものリスト</h1>
@foreach($products as $product)
    @if ((in_array($user->id, array_column($product->wishlists->toArray(), 'user_id'), TRUE)))
        <div class="container">
            <div class="row justify-content-center">
                <div class="product">
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading text-center">
                                <a href="{{ url('products/show/' .$product->id) }}">
                                    @if(!is_null($product->product_image))
                                    <img src="https://menscosme-image-ap-northeast-250991450901.s3-ap-northeast-1.amazonaws.com/product_image/{{ $product->product_image }}">
                                    @else
                                    <img src="{{ asset('default_product_image/default.png') }}">
                                    @endif
                                </a>
                            </div>
                            <div class="panel-body">
                                <p class="product-brand">{{$product->bland_name}}</p>
                                <p class="product-title"><a href="{{ url('products/show/' .$product->id) }}">{{$product->product_name}}</a></p>
                                <p class="mb-0 text-secondary">（口コミ{{ count($product->reviews) }}件）</p>
                                    <form method="POST" action="{{ url('wishlists/' .array_column($product->wishlists->toArray(), 'id', 'user_id')[$user->id]) }}" class="mb-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn p-0 border-0 text-danger">欲しいものリスト<i class="fas fa-heart fa-fw"></i></button>
                                    </form>
        @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endforeach
@endsection