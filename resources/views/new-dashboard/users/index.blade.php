@extends('new-dashboard.master')

@section('title'){{$_panel}}@endsection

@section('content')

<h4 class="text-right py-3 mb-4">
    <span class="text-muted fw-light">{{$_panel}}/</span> Users
</h4>

<div class="card">
    <div class="card-body">
        <div class="card-datatable">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                <table class="datatables-basic table border-top dataTable no-footer dtr-column collapsed" id="datatable"
                    aria-describedby="DataTables_Table_0_info" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Name</th>
                            <th>Account Type</th>
                            <th>Registered As</th>
                            <th>Joined Date</th>
                            <th>KYC Status</th>
                            <th data-orderable="false">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $key=0;
                        @endphp
                        @foreach ($data['data'] as $datum)
                        @if ($datum->roles()->first()->name!='superadmin')
                        @php
                            $key++
                        @endphp
                        <tr>
                            <td>{{$key}}</td>
                            <td>
                                <div class="d-flex justify-content-start align-items-center customer-name">
                                    <div class="avatar-wrapper">
                                        @php
                                            if(isset($datum->image)){
                                                $image=asset($datum->image);
                                            }else{
                                                $image=asset('new-dashboard/img/avatars/default.png');
                                            }
                                        @endphp
                                        <div class="avatar me-2"><img src="{{$image}}" alt="Avatar" class="rounded-circle"></div>
                                    </div>
                                        <div class="d-flex flex-column"><a href="{{route('dashboard.users.show',$datum->id)}}"><span class="fw-medium">{{$datum->name}}</span></a>
                                        <small class="text-muted">{{$datum->email}}
                                            @if ($datum->email_verified_at)
                                            <small class="text-success" title="Email Verified"><i class='bx bxs-check-circle'></i></small>
                                            @else
                                            <small class="text-danger" title="Email Unverified"><i class='bx bxs-x-circle'></i></small>
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if ($datum->account_type=='individual')
                                <i class="bx bx-user bx-sm me-2"></i>
                                @else
                                <i class="bx bx-buildings bx-sm me-2"></i>
                                @endif
                                {{Str::ucfirst($datum->account_type)}}
                            </td>
                            <td>
                                @if ($datum->roles()->first()->name=='investor')
                                <i class="bx bxs-briefcase bx-sm me-2 text-info"></i>
                                @else
                                <i class="bx bxs-rocket bx-sm me-2 text-warning"></i>
                                @endif
                                {{Str::ucfirst($datum->roles()->first()->name)}}
                            </td>
                            <td>{{Carbon\Carbon::parse($datum->created_at)->format('d M,Y')}}</td>
                            <td>
                                @php
                                    switch ($datum->kyc_status) {
                                        case 'rejected':
                                            $badge_status="danger";
                                            break;

                                        case 'verified':
                                            $badge_status="success";
                                            break;

                                        case 'processing':
                                            $badge_status="warning";
                                            break;

                                        default:
                                            $badge_status="secondary";
                                            break;
                                    }
                                @endphp
                                <span class="badge  bg-label-{{$badge_status}}">{{Str::ucfirst($datum->kyc_status)}}</span>
                            </td>
                            <td class="text-center">
                                <a href="{{route($_base_route.'.show',$datum->id)}}" class="btn btn-icon btn-info mx-2" title="View KYC"> <span class="bx bxs-user-detail"></span></a>
                                @if ($datum->roles()->first()->name=='investor')
                                <a href="{{route('dashboard.investment.investor.profile',$datum->id)}}" class="btn btn-icon btn-info mx-2" title="View Profile"> <span class="bx bx-show"></span></a>
                                @endif
                                @if ($datum->roles()->first()->name=='investee')
                                <a href="{{route('dashboard.investment.investee.profile',$datum->id)}}" class="btn btn-icon btn-info mx-2" title="View Profile"> <span class="bx bx-show"></span></a>
                                @endif
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection
