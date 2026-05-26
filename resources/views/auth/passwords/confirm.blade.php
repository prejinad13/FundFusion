@extends('auth.master')

@section('content')
<div class="auth-form-light text-left p-5">
    <p class="login-box-msg">{{ __('Please confirm your password before continuing.') }}</p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="{{ __('Password') }}" required
                autocomplete="current-password">
            @error('password')
                <small class="text-danger"> {{ $message }}</small>
            @enderror
        </div>

        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">{{ __('Confirm Password') }}</button>
            </div>
        </div>
    </form>
    @if (Route::has('password.request'))
    <p class="mb-1">
        <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
    </p>
    @endif
</div>
@endsection
