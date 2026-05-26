@extends('auth.master')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="app-brand justify-content-center">
            <a href="{{route('index')}}" class="app-brand-link gap-2">
                <img src="{{asset('new-dashboard/img/logos/fundfusion_small_black.png')}}" width="120px">
            </a>
        </div>
        <h4 class="mb-2 text-center">Reset Password 🔒</h4>
        <p class="mb-2 pb-3 border-bottom text-center">for {{request()->email}}</p>
        <form id="formAuthentication" class="mb-3" action="{{ route('password.update') }}" method="post">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ request()->email }}">
            {{-- <div class="mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span> </label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter your email" autofocus />
                 @error('email') <span class="invalid-message mt-1"> {{ $message }} </span> @enderror
            </div> --}}
            <div class="mb-3 form-password-toggle">
                <label for="password" class="form-label">Password <span class="text-danger">*</span> </label>
                <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="············" aria-describedby="password" autocomplete/>
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
                @error('password') <span class="invalid-message mt-2"> {{ $message }} </span> @enderror
            </div>
            <div class="mb-3 form-password-toggle">
                <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span> </label>
                <div class="input-group input-group-merge">
                    <input type="password" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="············" aria-describedby="password" autocomplete/>
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
                @error('password_confirmation') <span class="invalid-message mt-2"> {{ $message }} </span> @enderror
            </div>
            <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Set new Password</button>
            </div>
        </form>

        <div class="text-center">
            <a href="{{route('login')}}">
              <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
              Back to login
            </a>
          </div>
    </div>
</div>

@endsection
