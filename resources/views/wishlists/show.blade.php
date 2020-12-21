@extends('layouts.app')

@section('content')
<h1 class="text-center font-family-Tahoma">{{$user->name}}さんの欲しいものリスト</h1>
@foreach($products as $product)
    @if ((in_array($user->id, array_column($product->wishlists->toArray(), 'user_id'), TRUE)))
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 mb-3">
                    <div class="card">
                        <div class="card-haeder p-3 w-100 d-flex">
                            <div class="ml-2 d-flex flex-column">
                            @if(!is_null($product->product_image))
                            <img src="/storage/images/{{ $product->product_image }}">
                            @endif
                                <p class="mb-0"><a href="{{ url('products/show/' .$product->id) }}">{{$product->product_name}}</a></p>
                            </div>
                        </div>
                        <div class="card-footer py-1 d-flex justify-content-end bg-white">
                            <div class="d-flex align-items-center">
                            <p class="mb-0 text-secondary">（口コミ{{ count($product->reviews) }}件）</p>
                                <form method="POST" action="{{ url('wishlists/' .array_column($product->wishlists->toArray(), 'id', 'user_id')[$user->id]) }}" class="mb-0">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn p-0 border-0 text-danger">欲しいものリスト<i class="fas fa-heart fa-fw"></i></button>
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
        </div>
@endsection