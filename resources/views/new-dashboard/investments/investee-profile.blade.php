@extends('new-dashboard.master')

@section('title'){{$_panel}}@endsection

@section('content')

<div class="d-flex justify-content-between  py-1 mb-1">
    <h4 class="text-right">
        {{$data['data']->name}} Profile
    </h4>
</div>

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="user-profile-header-banner">
                <img src="{{asset('new-dashboard/img/backgrounds/profile_cover.jpg')}}" alt="Banner image" class="rounded-top">
            </div>
            <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                    <img src="{{$data['data']->image?asset($data['data']->image):asset('new-dashboard/img/avatars/default.png')}}" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
                </div>
                <div class="flex-grow-1 mt-1 mt-sm-5">
                    <div
                        class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                        <div class="user-profile-info">
                            <h4>{{$data['data']->name}}</h4>
                            {{-- <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                <li class="list-inline-item fw-medium">
                                    <i class="bx bx-pen"></i> UX Designer
                                </li>
                                <li class="list-inline-item fw-medium">
                                    <i class="bx bx-map"></i> Vatican City
                                </li>
                                <li class="list-inline-item fw-medium">
                                    <i class="bx bx-calendar-alt"></i> Joined {{Carbon\Carbon::parse($data['data']->created_at)->format('d M,Y')}}
                                </li>
                            </ul> --}}
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                @foreach ($data['data']->sectors as $sector)
                                <span class="badge bg-label-info"><i class="{{$sector->icon}} mx-1"></i>{{$sector->name}}</span>
                                @endforeach
                            </div>
                        </div>
                        <a href="javascript:void(0)" class="btn btn-primary text-nowrap">
                            <i class="bx bx-user-plus me-1"></i>Connect
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
