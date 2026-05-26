@extends('auth.master')

@section('title') Verify | {{env('APP_NAME')}} @endsection

@section('content')
 <div class="card">
    <div class="card-body">
        <div class="app-brand justify-content-center">
            <a href="{{route('index')}}" class="app-brand-link gap-2">
                <img src="{{asset('new-dashboard/img/logos/fundfusion_small_black.png')}}" width="120px">
            </a>
        </div>
        <h4 class="mb-2 text-center">Verify your email ✉️</h4>
        <p class="mb-2 pb-3 border-bottom text-center">Account activation link sent to your email address.<br> Please follow the link inside to continue.</p>

        <p class="text-center">
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-primary d-grid w-100">Didn't get the mail? {{ __('Resend') }}</button>
            </form>
          </p>
          <div class="text-center">
            <a href="{{route('login')}}">
              <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
              Back to login
            </a>
          </div>
    </div>
</div>

@endsection

