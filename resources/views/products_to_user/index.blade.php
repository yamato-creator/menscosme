@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 mb-3">
            <form method="GET" action="{{ url('products/index')}}">
            @csrf
            <div class="form-group">
                <label>商品を検索</label>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="例）ブランド、美白、毛穴" name="search">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                        </button>
                    </span>
                </div>
            </div>
            </form>
        </div>
        @foreach($products as $product)
        <div class="product">
            <div class="col-md-3 col-sm-4 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <a href="{{ url('products/show/' .$product->id) }}">
                            @if(!is_null($product->product_image))
                            <img src="{{ asset('/storage/images/' .$product->product_image) }}">
                            @else
                            <img src="{{ asset('default_product_image/default.png') }}">
                            @endif
                        </a>
                    </div>
                    <div class="panel-body">
                        <p class="product-brand">{{$product->bland_name}}</p>
                        <p class="product-title"><a href="{{ url('products/show/' .$product->id) }}">{{$product->product_name}}</a></p>
                        <p class="mb-0 text-secondary">（口コミ{{ count($product->reviews) }}件）</p>
                        @if ((!in_array($user->id, array_column($product->wishlists->toArray(), 'user_id'), TRUE)))
                            <form method="POST" action="{{ url('wishlists/') }}" class="mb-0">
                                @csrf

                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn p-0 border-0 text-primary">欲しいものリストに追加<i class="far fa-heart fa-fw"></i></button>
                            </form>
                        @else
                            <form method="POST" action="{{ url('wishlists/' .array_column($product->wishlists->toArray(), 'id', 'user_id')[$user->id]) }}" class="mb-0">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn p-0 border-0 text-danger"><i class="fas fa-heart fa-fw"></i></button>
                            </form>
                        @endif
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
