@extends('layouts.app_admin')

@section('content')

<div class="container">
    <a href="{{ url('admin/products/create') }}" class="btn btn-md btn-primary">登録する</a>
    <div class="row justify-content-center">
        @foreach($products as $product)
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="card-haeder p-3 w-100 d-flex">
                        <div class="ml-2 d-flex flex-column">
                        @if(!is_null($product->product_image))
                        <img src="/storage/images/{{$product->product_image}}">
                        @endif
                            <p class="mb-0"><a href="{{ url('admin/products/show/' .$product->id) }}">{{$product->product_name}}</a></p>
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