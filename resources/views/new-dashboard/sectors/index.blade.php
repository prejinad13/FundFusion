@extends('new-dashboard.master')

@section('title'){{$_panel}}@endsection

@section('content')

<div class="d-flex justify-content-between  py-3 mb-4">
    <h4 class="text-right">
        {{$_panel}}
    </h4>
    <a href="{{route($_base_route.'.create')}}" class="dt-button add-new btn btn-primary"><i class="bx bx-plus"></i> Add {{$_panel}}</a>
</div>


<div class="card">
    <div class="card-body">
        <div class="card-datatable">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                <table class="datatables-basic table border-top dataTable no-footer dtr-column collapsed" id="datatable"
                    aria-describedby="DataTables_Table_0_info" style="width: 100%;">
                    <thead>
                        <tr>
                            <th width="5%">S.N.</th>
                            <th data-orderable="false">Sector Name</th>
                            <th data-orderable="false" class="text-center" width="20%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['data'] as $key=>$datum)
                        <tr>
                            <td>{{++$key}}</td>
                            <td> <i class='{{$datum->icon ?? "fa-solid fa-lightbulb"}}'></i>  {{$datum->name}}</td>
                            <td class="text-center">
                                <a href="{{route($_base_route.'.edit',$datum->id)}}" class="btn btn-icon btn-warning mx-2"> <span class="bx bxs-edit"></span></a>
                                <form id="delete-form-{{ $datum->id }}" action="{{ route($_base_route . '.destroy', $datum->id) }}" method="POST" class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-icon btn-danger delete_confirmation">
                                        <span class="bx bxs-trash-alt"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection

@section('js')
    @include('new-dashboard.common.swal')
@endsection
