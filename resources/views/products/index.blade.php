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
                        <img src="{{ asset('images/' .$product->product_image) }}">
                        @else
                        <img src="{{ asset('default_product_image/default.jpeg') }}">
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
<div class='container'>
    <h2>お気に入りアイテムランキング</h2>
    <div class='row'>
        <div class='product'>
            <div class='col-md-3 col-sm-4 col-xs-12'>
                <div class='panel panel-default'>
                    <div class='panel-heading text-center'>
                        <a href="/products/2">
                        @if(!is_null($product->product_image))
                        <img src="{{ asset('images/' .$product->product_image) }}">
                        @else
                        <img src="{{ asset('default_product_image/default.jpeg') }}">
                        @endif
                        </a>
                    </div>
                    <div class='panel-body'>
                        <p class='product-brand'>SAVAS(ザバス)</p>
                        <p class='product-title'><a href="/products/2">明治 ザバス ウェイトダウン ヨーグルト風味【50食分】 1,050g</a></p>
                        <!-- 星評価 -->
                        <div class='star'>
                            <span id='star-rate-2' style='float-left'></span>
                            <script>
                            $('#star-rate-2').raty({
                                size: 36,
                                starOff:  '/assets/star-off-90377df9480bb45c07a917cae8f9ad2fd60264c7c727c2ad4891cc08c293ab6a.png',
                                starOn : '/assets/star-on-7d565687c6956753f78b946458a497319480f19d4245217b70828415cac1885f.png',
                                starHalf: '/assets/star-half-fef4aaaf257fbb04487fe35b66b8040160a67ecdf7d591f411dc511d8010db58.png',
                                half: true,
                                readOnly: true,
                                score: 3.6,
                            });
                            </script>

                        （口コミ 6 件）
                        </div>
                        <div class='buttons text-center'>
                        </div>
                    </div>
                    <div class='panel-footer'>
                        <p class='text-center'>
                        15
                        <span class='glyphicon glyphicon-heart'></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection