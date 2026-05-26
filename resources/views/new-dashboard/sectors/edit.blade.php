@extends('new-dashboard.master')

@section('title')Edit {{$_panel}}@endsection

@section('content')

    <h4 class="text-right py-3 mb-4">
        <span class="text-muted fw-light"> {{$data['data']->name}} /</span> Edit / {{$_panel}}
    </h4>

    {!! Form::model($data['data'],['url' => route($_base_route.'.update',$data['data']), 'enctype' => 'multipart/form-data','id'=>'my-form']) !!}
        @method('PUT')
        @include($_view_path.'.common.form')
    {!! Form::close() !!}

@endsection
