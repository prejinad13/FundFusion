@extends('auth.master')

@section('title') Register | {{env('APP_NAME')}} @endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="app-brand justify-content-center">
            <a href="{{route('index')}}" class="app-brand-link gap-2">
                <img src="{{asset('new-dashboard/img/logos/fundfusion_small_black.png')}}" width="120px">
            </a>
        </div>
        <h4 class="mb-2 text-center">Join FundFusion! 🚀</h4>
        <p class="mb-2 pb-3 border-bottom text-center">Please create account to continue.</p>

        <form id="formAuthentication" class="mb-3" action="{{ route('register') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{old('name')}}" name="name" placeholder="Enter your name" autofocus />
                 @error('name') <span class="invalid-message mt-1"> {{ $message }} </span> @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{old('email')}}" name="email" placeholder="Enter your email" autofocus />
                 @error('email') <span class="invalid-message mt-1"> {{ $message }} </span> @enderror
            </div>
            <div class="mb-3 row">
                <label for="account_type" class="form-label">Register As <span class="text-danger">*</span></label>
                <div class="col-md mb-md-0 mb-2" title="Select if you are individual user">
                  <div class="form-check custom-option custom-option-basic">
                    <label class="form-check-label custom-option-content" for="individual">
                      <input name="account_type" class="form-check-input" type="radio" value="individual" id="individual" @if(old('account_type')=="individual") checked @endif>
                      <span class="custom-option-header">
                        <span class="h6 mb-0">Individual</span>
                        <span><i class="bx bx-user"></i></span>
                      </span>
                    </label>
                  </div>
                </div>
                <div class="col-md" title="Select if you have company">
                  <div class="form-check custom-option custom-option-basic">
                    <label class="form-check-label custom-option-content" for="company">
                      <input name="account_type" class="form-check-input" type="radio" value="company" id="company" @if(old('account_type')=="company") checked @endif>
                      <span class="custom-option-header">
                        <span class="h6 mb-0">Company</span>
                        <span><i class="bx bx-buildings"></i></span>
                      </span>
                    </label>
                  </div>
                </div>
                @error('account_type') <span class="invalid-message mt-1"> {{ $message }} </span> @enderror
            </div>
            <div class="mb-3 row">
                <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                <div class="col-md mb-md-0 mb-2" title="Select if you want investment">
                  <div class="form-check custom-option custom-option-basic">
                    <label class="form-check-label custom-option-content" for="investee">
                      <input name="role" class="form-check-input" type="radio" value="investee" id="investee" @if(old('role')=="investee") checked @endif>
                      <span class="custom-option-header">
                        <span class="h6 mb-0">Investee</span>
                        <span><i class="bx bx-rocket"></i></span>
                      </span>
                    </label>
                  </div>
                </div>
                <div class="col-md" title="Select if you want to invest">
                  <div class="form-check custom-option custom-option-basic">
                    <label class="form-check-label custom-option-content" for="investor">
                      <input name="role" class="form-check-input" type="radio" value="investor" id="investor" @if(old('role')=="investor") checked @endif>
                      <span class="custom-option-header">
                        <span class="h6 mb-0">Investor</span>
                        <span><i class="bx bx-briefcase"></i></span>
                      </span>
                    </label>
                  </div>
                </div>
                @error('role') <span class="invalid-message mt-1"> {{ $message }} </span> @enderror
            </div>
            <div class="mb-3 form-password-toggle fv-plugins-icon-container">
                <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="············" aria-describedby="password">
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
                @error('password') <span class="invalid-message mt-2"> {{ $message }} </span> @enderror
            </div>
            <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Sign up</button>
            </div>
        </form>

        <p class="text-center">
            <span>Already have an account?</span>
            <a href="{{route('login')}}">
                <span>Sign in Instead</span>
            </a>
        </p>
    </div>
</div>
@endsection

