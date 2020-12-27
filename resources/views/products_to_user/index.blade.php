@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
            <p class="mb-0"><a href="{{ url('wishlists/show') }}">欲しいものリスト</a></p>
            <form method="GET" action="{{ url('products')}}">
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
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="card-haeder p-3 w-100 d-flex">
                    <div class="ml-2 d-flex flex-column">
                        @if(!is_null($product->product_image))
                        <img src="{{ asset('images/' .$product->product_image) }}">
                        @else
                        <img src="{{ asset('default_product_image/default.jpeg') }}">
                        @endif
                        <p class="mb-0"><a href="{{ url('products/show/' .$product->id) }}">{{$product->product_name}}</a></p>
                    </div>
                </div>
                <div class="card-footer py-1 d-flex justify-content-end bg-white">
                    <div class="d-flex align-items-center">
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
                    <div class="d-flex align-items-center">
                    <p class="mb-0"><a href="{{ url('products/show/' .$product->id) }}"></a></p>
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