@extends('new-dashboard.master')

@section('title'){{$_panel}}@endsection

@section('content')

<h4 class="text-right py-3 mb-4">
    {{$_panel}}
</h4>

<div class="card">
    <div class="card-body">
        <div class="card-datatable">

        </div>
    </div>

</div>

@endsection
