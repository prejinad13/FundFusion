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
                            <th data-orderable="false">Idea Name</th>
                            <th data-orderable="false">Investors</th>
                            <th data-orderable="false">Status</th>
                            <th data-orderable="false" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['data'] as $key=>$datum)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="emp_name text-truncate">{{$datum->name}}</span>
                                    <small class="emp_post text-truncate text-muted"><b>Required Investment: </b>Rs. {{$datum->required_investment_amount}}</small>
                                    <small class="emp_post text-truncate text-muted"><b>Created Date: </b>{{Carbon\Carbon::parse($datum->created_at)->format('d M, Y')}}</small>
                                </div>
                            </td>
                            <td>
                                @forelse ($datum->investors() as $investor)
                                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="{{$investor->name}}" data-bs-original-title="{{$investor->name}}">
                                      <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle">
                                    </li>
                                  </ul>
                                @empty
                                  N/A
                                @endforelse

                            </td>
                            <td>
                                <form method="POST" action="{{ route('dashboard.ideas.changeStatus',$datum->id) }}">
                                    @csrf
                                        <label class="switch switch-primary">
                                            <input type="checkbox" class="switch-input update_confirmation" @if($datum->status=='open') checked @endif>
                                            <span class="switch-toggle-slider">
                                              <span class="switch-on"></span>
                                              <span class="switch-off"></span>
                                            </span>
                                            <span class="switch-label">{{Str::ucfirst($datum->status)}}</span>
                                          </label>
                                </form>

                            </td>
                            <td class="text-center">
                                <a href="{{route($_base_route.'.edit',$datum->id)}}" class="btn btn-icon btn-warning mx-2"> <span class="bx bxs-edit"></span></a>
                                <a href="{{route($_base_route.'.show',$datum->id)}}" class="btn btn-icon btn-info mx-2"> <span class="bx bx-show"></span></a>
                                {{-- <form id="delete-form-{{ $datum->id }}" action="{{ route($_base_route . '.destroy', $datum->id) }}" method="POST" class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-icon btn-danger delete_confirmation">
                                        <span class="bx bxs-trash-alt"></span>
                                    </button>
                                </form> --}}
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

    <script type="text/javascript">
        $('.update_confirmation').click(function(event) {
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Change Status!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>

@endsection
