@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="card-haeder p-3 w-100">
                    <div>
                        @if(!is_null($product->product_image))
                        <img src="https://menscosme-image-ap-northeast-250991450901.s3-ap-northeast-1.amazonaws.com/product_image/{{ $product->product_image }}">
                        @else
                        <img src="{{ asset('default_product_image/default.png') }}">
                        @endif
                    </div>
                    <div class="d-flex flex-column">
                        <p class="mb-1">商品名: {{ $product->product_name }}</p>
                        <p class="mb-1">ブランド名: {{ $product->bland_name }}</p>
                        <p class="mb-1">アイテムカテゴリ: {{ $product->item_category }}</p>
                        <p class="mb-1">商品説明: {{ $product->product_description }}</p>
                        <p class="mb-1">相場価格: {{ $product->price }}</p>
                        <p class="mb-1">容量: {{ $product->capacity }}</p>
                        <a href="{{ $product->url }}" target="_blank" class="btn btn-md btn-primary">Amazonで詳しく見る</a>
                    </div>
                </div>
                @if(Auth::check())
                <div class="card-footer py-1 d-flex justify-content-end bg-white">
                        <div class="dropdown mr-3 d-flex align-items-center">
                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-fw"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <form method="POST" action="{{ route('admin.destroy', ['id' => $product->id ]) }}"  class="mb-0">
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