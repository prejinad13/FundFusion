@extends('new-dashboard.master')
@section('title') KYC Error @endsection

@section('content')

<div class="card bg-label-danger">
    <div class="card-body d-flex justify-content-between flex-wrap-reverse">
        <div class="w-100 app-academy-sm-40 d-flex justify-content-center justify-content-sm-end mb-3 mb-sm-0">
            <div class="mb-0 w-100 app-academy-sm-60 d-flex justify-content-between align-items-center text-center text-sm-start">
                <div class="card-title">
                    <h4 class="text-danger">KYC Unverified!</h4>
                    <p class="text-body app-academy-sm-60 app-academy-xl-100">
                        Oops! You can't perform this action.
                    </p>
                    <a class="btn btn-danger" href="{{route('dashboard.users.myProfile')}}">Verify KYC</a>
                </div>
            </div>
            <img class="img-fluid scaleX-n1-rtl" src="{{asset('new-dashboard/img/kyc_err.png')}}" alt="girl illustration">
        </div>
    </div>
</div>


@endsection
