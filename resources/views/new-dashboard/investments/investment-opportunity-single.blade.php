@extends('new-dashboard.master')

@section('title')View {{$_panel}}@endsection

@section('content')

<h4 class="text-right py-3 mb-4">
    <span class="text-muted fw-light"> {{$data['data']->name}} /</span> Investment Opportunity / {{$_panel}}
</h4>


<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body row g-3">
                <div class="d-flex justify-content-between align-items-center flex-wrap mb-2 gap-1">
                    <div class="me-1">
                        <h5 class="mb-1">{{$data['data']->name}}</h5>
                        <p class="mb-1">Posted Date:<span class="fw-medium"> {{
                                Carbon\Carbon::parse($data['data']->created_at)->format('d M,Y')}}</span></p>
                    </div>
                    <div class="d-flex justify-content-start align-items-center user-name">
                        <div class="avatar-wrapper">
                            <div class="avatar avatar-sm me-2">
                                <img src="{{$data['data']->investee->image ? asset($data['data']->investee->image):asset('new-dashboard/img/avatars/default.png')}}"
                                    alt="{{$data['data']->investee->name}}" class="rounded-circle">
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <span class="fw-medium">{{$data['data']->investee->name}}</span>
                        </div>
                    </div>
                    {{-- <div class="d-flex align-items-center">
                        <span class="badge bg-label-danger">UI/UX</span>
                        <i class="bx bx-share-alt bx-sm mx-4"></i>
                        <i class="bx bx-bookmarks bx-sm"></i>
                    </div> --}}
                </div>
                <div class="card academy-content shadow-none border">
                    <div class="p-2">
                        <div class="cursor-pointer">
                            <iframe class="w-100" height="400" src="{{$data['data']->video_link}}" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="card-body">
                        <hr class="mb-4 mt-2">
                        <h5>Detailed Description</h5>
                        <p>{!!$data['data']->long_description!!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-body">

                <h5 class="pb-2 border-bottom mb-2">Sector</h5>
                @foreach ($data['data']->sectors as $sector)
                <span class="badge rounded-pill bg-label-primary mb-2"><i class="{{$sector->icon}}"> </i> {{$sector->name}}</span>
                @endforeach
                <div class="mb-4"></div>

                <h5 class="pb-2 border-bottom mb-4">Details</h5>
                <div class="info-container">
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <div class="d-flex align-items-start me-4 mt-3 gap-3">
                                <span class="badge bg-label-primary p-2 rounded"><i
                                        class="fa-solid fa-people-group bx-sm"></i></span>
                                <div>
                                    <h5 class="mb-0">Team Size</h5>
                                    <span>{{$data['data']->team_size}}</span>
                                </div>
                            </div>
                        </li>
                        <li class="mb-3">
                            <div class="d-flex align-items-start me-4 mt-3 gap-3">
                                <span class="badge bg-label-primary p-2 rounded"><i
                                        class="fa-solid fa-piggy-bank bx-sm"></i></span>
                                <div>
                                    <h5 class="mb-0">Required Amount</h5>
                                    <span>Rs.{{$data['data']->required_investment_amount}}</span>
                                </div>
                            </div>
                        </li>
                        <li class="mb-3">
                            <div class="d-flex align-items-start me-4 mt-3 gap-3">
                                <span class="badge bg-label-primary p-2 rounded"><i
                                        class="fa-solid fa-money-bill-transfer bx-sm"></i></span>
                                <div>
                                    <h5 class="mb-0">ROI</h5>
                                    <span>{{$data['data']->return_on_investment}}%</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <h5 class="pb-2 border-bottom mt-4 mb-4">Brief</h5>
                    <p>{{$data['data']->short_description}}
                        {{--
                    <div class="d-flex justify-content-center pt-3">
                        <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser"
                            data-bs-toggle="modal">Edit</a>
                        <a href="javascript:;" class="btn btn-label-danger suspend-user">Suspended</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
