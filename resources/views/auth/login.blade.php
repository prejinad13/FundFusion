@extends('auth.master')

@section('title') Login | {{env('APP_NAME')}} @endsection

@section('content')
 <div class="card">
    <div class="card-body">
        <div class="app-brand justify-content-center">
            <a href="{{route('index')}}" class="app-brand-link gap-2">
                <img src="{{asset('new-dashboard/img/logos/fundfusion_small_black.png')}}" width="120px">
            </a>
        </div>
        <h4 class="mb-2 text-center">Welcome to FundFusion! 👋</h4>
        <p class="mb-2 pb-3 border-bottom text-center">Please sign-in to your account.</p>

        <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span> </label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter your email" autofocus />
                 @error('email') <span class="invalid-message mt-1"> {{ $message }} </span> @enderror
            </div>
            <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                    <a href="{{route('password.request')}}">
                        <small>Forgot Password?</small>
                    </a>
                </div>
                <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="············" aria-describedby="password" autocomplete/>
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
                @error('password') <span class="invalid-message mt-2"> {{ $message }} </span> @enderror
            </div>
            <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
            </div>
        </form>

        <p class="text-center">
            <span>New on our platform?</span>
            <a href="{{route('register')}}">
                <span>Create an account</span>
            </a>
        </p>
    </div>
</div>

@endsection
