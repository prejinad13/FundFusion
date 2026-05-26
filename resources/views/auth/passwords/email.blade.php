@extends('auth.master')

@section('title') Password Reset | {{env('APP_NAME')}} @endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="app-brand justify-content-center">
            <a href="{{route('index')}}" class="app-brand-link gap-2">
                <img src="{{asset('new-dashboard/img/logos/fundfusion_small_black.png')}}" width="120px">
            </a>
        </div>
        <h4 class="mb-2 text-center">Sometime Happens! 😞</h4>
        <p class="mb-2 pb-3 border-bottom text-center">Please enter your registered email.</p>

        <form id="formAuthentication" class="mb-3" action="{{ route('password.email') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span> </label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter your email" autofocus />
                 @error('email') <span class="invalid-message mt-1"> {{ $message }} </span> @enderror
            </div>
            <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Send Password Reset Link</button>
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

@if (session('status'))
    @section('css')
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    @endsection

    @section('js')
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
            <script>
                Toastify({
                    text: ' {{ session('status') }}',
                    duration: 5000,
                    newWindow: true,
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "right", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                },
                }).showToast();
            </script>
    @endsection
@endif


@section('js')
@error('email')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        Toastify({
            text: '{{$message}}',
            duration: 3000,
            newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
            background: "linear-gradient(to right, #b00006, #e42121)",
        },
        }).showToast();
    </script>
    @enderror
@endsection
