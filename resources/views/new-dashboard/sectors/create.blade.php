@extends('new-dashboard.master')

@section('title')Create {{$_panel}}@endsection

@section('content')

    <h4 class="text-right py-3 mb-4">
        <span class="text-muted fw-light"> Create /</span> {{$_panel}}
    </h4>

    <form action="{{ route($_base_route . '.store') }}" method="POST" enctype="multipart/form-data" id="my-form">
        @csrf
        @include($_view_path . '.common.form')
    </form>

@endsection
