@extends('new-dashboard.master')

@section('title'){{$_panel}}@endsection

@section('content')

<div class="d-flex justify-content-between  py-3 mb-4">
    <h4 class="text-right">
        {{$_panel}}
    </h4>
</div>

<div class="app-academy">
    <div class="card mb-4">
        {{-- <div class="card-header d-flex flex-wrap justify-content-between gap-3">
            <div class="card-title mb-0 me-1">
                <h5 class="mb-1">My Courses</h5>
                <p class="text-muted mb-0">Total 6 course you have purchased</p>
            </div>
            <div class="d-flex justify-content-md-end align-items-center gap-3 flex-wrap">
                <div class="position-relative"><select id="select2_course_select"
                        class="select2 form-select select2-hidden-accessible" data-placeholder="All Courses"
                        data-select2-id="select2_course_select" tabindex="-1" aria-hidden="true">
                        <option value="" data-select2-id="2">All Courses</option>
                        <option value="all courses">All Courses</option>
                        <option value="ui/ux">UI/UX</option>
                        <option value="seo">SEO</option>
                        <option value="web">Web</option>
                        <option value="music">Music</option>
                        <option value="painting">Painting</option>
                    </select><span class="select2 select2-container select2-container--default" dir="ltr"
                        data-select2-id="1" style="width: 127px;"><span class="selection"><span
                                class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true"
                                aria-expanded="false" tabindex="0" aria-disabled="false"
                                aria-labelledby="select2-select2_course_select-container"><span
                                    class="select2-selection__rendered w-px-150"
                                    id="select2-select2_course_select-container" role="textbox"
                                    aria-readonly="true"><span class="select2-selection__placeholder">All
                                        Courses</span></span><span class="select2-selection__arrow"
                                    role="presentation"><b role="presentation"></b></span></span></span><span
                            class="dropdown-wrapper" aria-hidden="true"></span></span></div>

                <label class="switch">
                    <input type="checkbox" class="switch-input">
                    <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                    </span>
                    <span class="switch-label text-nowrap mb-0">Hide completed</span>
                </label>
            </div>
        </div> --}}
        <div class="card-body">
            <div class="row">
                @forelse ($data['data'] as $datum)
                <div class="col-sm-6 col-lg-4 my-3">
                    <div class="card p-2 h-100 shadow-none border">
                        <div class="rounded-2 text-center mb-3">
                            <iframe class="w-100" height="200" src="{{$datum->video_link}}" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                        </div>
                        <div class="card-body p-3 pt-2">
                            <div class="d-flex justify-content-between align-items-baseline mb-3">
                                <small class="badge bg-label-primary">{{Carbon\Carbon::parse($datum->created_at)->format('d M,Y')}}</small>
                                <small class="d-flex align-items-center justify-content-center gap-1 mb-0" style="text-align: right">
                                  <a href="{{route('dashboard.investment.investee.profile',$datum->investee->id)}}"><span class="text-primary"><i class="bx bxs-user me-1"></i></span><span class="text-primary">{{$datum->investee->name}}</span></a>
                                </small>
                              </div>
                            <a href="{{route('dashboard.investment.investOpportunitySingle',$datum->slug)}}" class="h5">{{$datum->name}}</a>
                            <p class="mt-2">{{$datum->short_description}}</p>
                            <p class="text-center">
                                @foreach ($datum->sectors as $sector )
                                <span class="badge badge-center bg-label-primary"  data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" data-bs-original-title="<i class='{{$sector->icon}}' ></i> <span>{{$sector->name}}</span>"><i class="{{$sector->icon}}"></i></span>
                                @endforeach
                              </p>
                            {{-- <p class="d-flex align-items-center"><i class="bx bx-time-five me-2"></i>30 minutes</p>
                            <div class="progress mb-4" style="height: 8px">
                                <div class="progress-bar w-75" role="progressbar" aria-valuenow="25" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div> --}}
                            <div class="d-flex justify-content-between">
                                <a href="{{route('dashboard.investment.investOpportunitySingle',$datum->slug)}}" class="btn btn-primary w-100">Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center">
                    No Opportunities Available
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>


@endsection
