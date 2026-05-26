@extends('new-dashboard.master')

@section('title'){{$_panel}}@endsection

@section('content')

<div class="d-flex justify-content-between  py-3 mb-4">
    <h4 class="text-right">
        {{$_panel}}
    </h4>
</div>


@endsection
