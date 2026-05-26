@extends('new-dashboard.master')

@section('title'){{$_panel}}@endsection

@section('content')

<div class="d-flex justify-content-between  py-3 mb-4">
    <h4 class="text-right">
        {{$_panel}}
    </h4>
</div>

<div class="row g-4">
    @foreach ($data['data'] as $datum)
    <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card">
            <div class="card-body text-center">
                {{-- <div class="dropdown btn-pinned">
                    <button type="button" class="btn dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown"
                        aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="javascript:void(0);">Share connection</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);">Block connection</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-danger" href="javascript:void(0);">Delete</a></li>
                    </ul>
                </div> --}}
                <div class="mx-auto mb-3">
                    <img src="{{$datum->image?asset($datum->image):asset('new-dashboard/img/avatars/default.png')}}" alt="{{$datum->name}}" class="rounded-circle w-px-100">
                </div>
                <h5 class="mb-1 card-title">{{$datum->name}}</h5>
                <span>{{$datum->description}}</span>

                <div class="my-3 gap-2">
                    @foreach ($datum->sectors as $sector)
                        <small class="badge bg-label-info my-1"><i class="{{$sector->icon}}"></i> {{$sector->name}}</small>
                    @endforeach
                </div>

                {{-- <div class="d-flex align-items-center justify-content-around my-4 py-2">
                    <div>
                        <h4 class="mb-1">18</h4>
                        <span>Projects</span>
                    </div>
                    <div>
                        <h4 class="mb-1">834</h4>
                        <span>Tasks</span>
                    </div>
                    <div>
                        <h4 class="mb-1">129</h4>
                        <span>Connections</span>
                    </div>
                </div> --}}
                <div class="d-flex align-items-center justify-content-center">
                    <a href="{{route('dashboard.investment.investor.profile',$datum->id)}}" class="btn btn-primary d-flex align-items-center me-3 w-100">Details</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
