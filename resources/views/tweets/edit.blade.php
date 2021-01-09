@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tweets.update', [$tweets -> id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row mb-0">
                            <div class="col-md-12 p-3 w-100 d-flex">
                            @if (!isset($user->profile_image))
                                <img src="{{ asset('default_profile_image/twittericon13.jpg') }}" class="rounded-circle" width="50" height="50">
                            @else
                                <img src="https://menscosme-image-ap-northeast-250991450901.s3-ap-northeast-1.amazonaws.com/profile_image/{{ $user->profile_image }}"  class="rounded-circle" width="50" height="50">
                            @endif
                                <div class="ml-2 d-flex flex-column">
                                    <p class="mb-0">{{ $user->name }}</p>
                                    <a href="{{ url('users/' .$user->id) }}" class="text-secondary">{{ $user->screen_name }}</a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <textarea class="form-control @error('text') is-invalid @enderror" name="text" required autocomplete="text" rows="4">{{ old('text') ? : $tweets->text }}</textarea>

                                @error('text')
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
                                    ツイートする
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