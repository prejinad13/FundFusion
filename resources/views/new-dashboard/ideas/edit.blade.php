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

@section('js')
<script src="https://cdn.tiny.cloud/1/b27jwm79sle74rxfd04n2vw26h81hxtt3b1awbqev61e4ww6/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
      selector: 'textarea#long_description',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
  </script>

<script>
    $(document).ready(function() {
    $('.select2').select2({
        placeholder:'Select Investment Sectors',
        allowClear:true
    });
});
</script>
@endsection
