@extends('new-dashboard.master')

@section('title'){{$_panel}}@endsection

@section('content')

<h4 class="text-right py-3 mb-4">
    <span class="text-muted fw-light">{{$data['data']->name}} Details /</span> Users
</h4>

@livewire('user.kyc-show', ['data'=>$data['data']])

@endsection
