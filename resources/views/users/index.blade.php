@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach ($all_users as $all_user)
                    <div class="card">
                        <div class="card-haeder p-3 w-100 d-flex">
                            @if (isset($all_user->profile_image))
                            <img src="https://menscosme-image-ap-northeast-250991450901.s3-ap-northeast-1.amazonaws.com/profile_image/{{ $all_user->profile_image }}" class="rounded-circle" width="50" height="50">
                            @else
                            <img src="{{ asset('/default_profile_image/twittericon13.jpg') }}" class="rounded-circle" width="50" height="50">
                            @endif
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0">{{ $all_user->name }}</p>
                                <a href="{{ url('users/' .$all_user->id) }}" class="text-secondary">{{ $all_user->screen_name }}</a>
                            </div>
                            @if (auth()->user()->isFollowed($all_user->id))
                                <div class="px-2">
                                    <span class="px-1 bg-secondary text-light">フォローされています</span>
                                </div>
                            @endif
                            <div class="d-flex justify-content-end flex-grow-1">
                                @if (auth()->user()->isFollowing($all_user->id))
                                    <form action="{{ route('unfollow', ['user' => $all_user->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger">フォロー解除</button>
                                    </form>
                                @else
                                    <form action="{{ route('follow', ['user' => $all_user->id]) }}" method="POST">
                                        {{ csrf_field() }}

                                        <button type="submit" class="btn btn-primary">フォローする</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="my-4 d-flex justify-content-center">
            {{ $all_users->links() }}
        </div>
    </div>
@endsection