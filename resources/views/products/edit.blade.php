@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('products.update', ['id' => $product->id ]) }}" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group row mb-0">
                            <p>商品名</p>
                                <div class="col-md-12">
                                    <textarea class="form-control @error('product_name') is-invalid @enderror" name="product_name" required autocomplete="product_name" rows="4">{{ $product->product_name  }}</textarea>
                                    @error('product_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                            <p>商品画像</p>
                                <label for="file_photo" class="rounded-circle userProfileImg">
                                <div class="userProfileImg_description">画像をアップロード</div>
                                <i class="fas fa-camera fa-3x"></i>
                                @error('product_image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                                <input type="file" id="file_photo" name="product_image">
                                </label>
                                <div class="userImgPreview" id="userImgPreview">
                                    <img id="thumbnail" class="userImgPreview_content" accept="image/*" src="">
                                    <p class="userImgPreview_text">画像をアップロード済み</p>
                                </div>
                            </div>

                            @if(!is_null($product->product_image))
                            <img src="{{ asset('images/' .$product->product_image) }}">
                            @else
                            <img src="{{ asset('default_product_image/default.jpeg') }}">
                            @endif

                            <div class="form-group row mb-0">
                            <p>ブランド名</p>
                                <div class="col-md-12">
                                    <textarea class="form-control @error('bland_name') is-invalid @enderror" name="bland_name" required autocomplete="bland_name" rows="4">{{ $product->bland_name }}</textarea>
                                    @error('bland_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                            <p>アイテムカテゴリ</p>
                                <div class="col-md-12">
                                    <textarea class="form-control @error('item_category') is-invalid @enderror" name="item_category" required autocomplete="item_category" rows="4">{{ $product->item_category }}</textarea>
                                    @error('item_category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                            <p>商品説明</p>
                                <div class="col-md-12">
                                    <textarea class="form-control @error('product_description') is-invalid @enderror" name="product_description" required autocomplete="product_description" rows="4">{{ $product->product_description }}</textarea>
                                    @error('product_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                            <p>相場価格</p>
                                <div class="col-md-12">
                                    <textarea class="form-control @error('price') is-invalid @enderror" name="price" required autocomplete="price" rows="4">{{ $product->price }}</textarea>
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                            <p>容量</p>
                                <div class="col-md-12">
                                    <textarea class="form-control @error('capacity') is-invalid @enderror" name="capacity" required autocomplete="capacity" rows="4">{{ $product->capacity }}</textarea>
                                    @error('capacity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                            <p>公式ページ</p>
                                <div class="col-md-12">
                                    <textarea class="form-control @error('url') is-invalid @enderror" name="url" required autocomplete="url" rows="4">{{ $product->url }}</textarea>
                                    @error('url')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary">
                                    更新する
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
