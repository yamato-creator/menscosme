@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="card-haeder p-3 w-100">
                    <div>
                        @if(!is_null($product->product_image))
                        <img src="{{ asset('/storage/images/' .$product->product_image) }}">
                        @else
                        <img src="{{ asset('default_product_image/default.png') }}">
                        @endif
                    </div>
                    <div class="d-flex flex-column">
                        <p class="mb-0">口コミ平均評価 : @if($average_star == 1)
                                    ⭐️
                                @elseif($average_star == 2)
                                    ⭐️⭐️
                                @elseif($average_star == 3)
                                    ⭐️⭐️⭐️
                                @elseif($average_star == 4)
                                    ⭐️⭐️⭐️⭐️
                                @elseif($average_star == 5)
                                    ⭐️⭐️⭐️⭐️⭐️
                                @endif</p>
                        <p class="mb-1">商品名: {{ $product->product_name }}</p>
                        <p class="mb-1">ブランド名: {{ $product->bland_name }}</p>
                        <p class="mb-1">アイテムカテゴリ: {{ $product->item_category }}</p>
                        <p class="mb-1">商品説明: {{ $product->product_description }}</p>
                        <p class="mb-1">相場価格: {{ $product->price }}</p>
                        <p class="mb-1">容量: {{ $product->capacity }}</p>
                        <p class="mb-1">URL: {{ $product->url }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
        <h2>口コミ一覧</h2>
            <ul class="list-group">
            @if(!isset($user_reviews->comment))
                <li class="list-group-item">
                    <div class="py-3">
                        <form method="POST" action="{{ route('reviews.store') }}">
                            @csrf

                            <div class="form-group row mb-0">
                                <div class="col-md-12 p-3 w-100 d-flex">
                                @if (!isset($user->profile_image))
                                    <img src="{{ asset('default_profile_image/twittericon13.jpg') }}" class="rounded-circle" width="50" height="50">
                                @else
                                    <img src="{{ asset('storage/profile_image/' .$user->profile_image) }}" class="rounded-circle" width="50" height="50">
                                @endif
                                    <div class="ml-2 d-flex flex-column">
                                        <p class="mb-0">{{ $user->name }}</p>
                                        <a href="{{ url('users/' .$user->id) }}" class="text-secondary">{{ $user->screen_name }}</a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                <p>評価<br>
                                    <select name="star">
                                        <option value="1">⭐️</option>
                                        <option value="2">⭐️⭐️</option>
                                        <option value="3" selected>⭐️⭐️⭐️</option>
                                        <option value="4">⭐️⭐️⭐️⭐️</option>
                                        <option value="5">⭐️⭐️⭐️⭐️⭐️</option>
                                    </select></p>
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <textarea class="form-control @error('comment') is-invalid @enderror" name="comment" required autocomplete="comment" rows="4">{{ old('comment') }}</textarea>

                                    @error('comment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12 text-right">
                                    <p class="mb-4 text-danger">140文字以内</p>
                                    <button type="submit" class="btn btn-primary">
                                        レビューを投稿する
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
            @endif
            @forelse ($reviews as $review)
                    <li class="list-group-item">
                        <div class="py-3 w-100 d-flex">
                            @if (!isset($review->user->profile_image))
                                <img src="{{ asset('default_profile_image/twittericon13.jpg') }}" class="rounded-circle" width="50" height="50">
                            @else
                                <img src="{{ asset('storage/profile_image/' .$review->user->profile_image) }}" class="rounded-circle" width="50" height="50">
                            @endif
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0">{{ $review->user->name }}</p>
                                <a href="{{ url('users/' .$review->user->id) }}" class="text-secondary">{{ $review->user->screen_name }}</a>
                            </div>
                            <div class="d-flex justify-content-end flex-grow-1">
                                <p class="mb-0 text-secondary">{{ $review->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                        <p>評価 :@if($review->star === 1)
                                    ⭐️
                                @elseif($review->star === 2)
                                    ⭐️⭐️
                                @elseif($review->star === 3)
                                    ⭐️⭐️⭐️
                                @elseif($review->star === 4)
                                    ⭐️⭐️⭐️⭐️
                                @elseif($review->star === 5)
                                    ⭐️⭐️⭐️⭐️⭐️
                                @endif</p>
                        <div class="py-3">
                            {!! nl2br(e($review->comment)) !!}
                        </div>
                    </li>
            @empty
                    <li class="list-group-item">
                        <p class="mb-0 text-secondary">レビューはまだありません。</p>
                    </li>
            @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
