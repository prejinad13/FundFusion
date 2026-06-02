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
                        <div class="col-sm-6 col-lg-4 my-3 d-flex align-items-stretch">
                            <div class="card p-2 w-100 d-flex flex-column shadow-none border">
                                    @php
                                        $videoUrl = $datum->video_link;
                                        $isDirectVideo = false;
                                        $isEmbed = false;

                                        if ($videoUrl) {
                                            if (Str::startsWith($videoUrl, 'storage/')) {
                                                $videoUrl = asset($videoUrl);
                                                $isDirectVideo = true;
                                            }
                                            elseif (preg_match('/\.(mp4|webm|ogg|mov)(\?.*)?$/i', $videoUrl)) {
                                                $isDirectVideo = true;
                                            }
                                            elseif (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $videoUrl, $m)) {
                                                $videoUrl = 'https://www.youtube.com/embed/' . $m[1];
                                                $isEmbed = true;
                                            }
                                            elseif (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $videoUrl, $m)) {
                                                $videoUrl = 'https://www.youtube.com/embed/' . $m[1];
                                                $isEmbed = true;
                                            }
                                            elseif (str_contains($videoUrl, 'youtube.com/embed') || str_contains($videoUrl, 'player.vimeo')) {
                                                $isEmbed = true;
                                            }
                                            elseif (preg_match('/vimeo\.com\/(\d+)/', $videoUrl, $m)) {
                                                $videoUrl = 'https://player.vimeo.com/video/' . $m[1];
                                                $isEmbed = true;
                                            }
                                            else {
                                                $isEmbed = true;
                                            }
                                        }
                                    @endphp

                                    <div class="rounded-2 text-center mb-3">
                                        @if ($isDirectVideo)
                                            <video class="w-100 rounded-2" height="200" controls style="background:#000; object-fit: cover;">
                                                <source src="{{ $videoUrl }}">
                                                Your browser does not support the video tag.
                                            </video>
                                        @elseif ($isEmbed)
                                            <iframe class="w-100 rounded-2" height="200" src="{{ $videoUrl }}" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                allowfullscreen></iframe>
                                        @else
                                            <div class="text-center py-4 bg-light rounded-2 d-flex flex-column align-items-center justify-content-center" style="height: 200px; background-color: #f1f2f6 !important;">
                                                <i class="bx bx-video-off bx-lg text-muted mb-2"></i>
                                                <span class="text-muted small">No video uploaded</span>
                                            </div>
                                        @endif
                                    </div>
                                <div class="card-body p-3 pt-2 d-flex flex-column flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-baseline mb-3">
                                        <div class="d-flex align-items-center gap-1 flex-wrap">
                                            <small class="badge bg-label-primary">{{Carbon\Carbon::parse($datum->created_at)->format('d M,Y')}}</small>
                                            @if (isset($datum->similarity_score))
                                                @if ($datum->similarity_score >= 0.4999)
                                                    <small class="badge text-white" style="background: linear-gradient(45deg, #28c76f, #00cfe8) !important;" data-bs-toggle="tooltip" title="High Match! Over 50% sector alignment."><i class="bx bxs-star me-1"></i> Recommended ({{ round($datum->similarity_score * 100) }}%)</small>
                                                @elseif ($datum->similarity_score > 0)
                                                    <small class="badge bg-label-info">{{ round($datum->similarity_score * 100) }}% Match</small>
                                                @else
                                                    <small class="badge bg-label-secondary">No Match</small>
                                                @endif
                                            @endif
                                        </div>
                                        <small class="d-flex align-items-center justify-content-center gap-1 mb-0"
                                            style="text-align: right">
                                            <a href="{{route('dashboard.investment.investee.profile', $datum->investee->id)}}"><span
                                                    class="text-primary"><i class="bx bxs-user me-1"></i></span><span
                                                    class="text-primary">{{$datum->investee->name}}</span></a>
                                        </small>
                                    </div>
                                    <a href="{{route('dashboard.investment.investOpportunitySingle', $datum->slug)}}"
                                        class="h5">{{$datum->name}}</a>
                                    <p class="mt-2">{{$datum->short_description}}</p>
                                    <p class="text-center">
                                        @foreach ($datum->sectors as $sector)
                                            <span class="badge badge-center bg-label-primary" data-bs-toggle="tooltip"
                                                data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                                data-bs-original-title="<i class='{{$sector->icon}}' ></i> <span>{{$sector->name}}</span>"><i
                                                    class="{{$sector->icon}}"></i></span>
                                        @endforeach
                                    </p>
                                    {{-- <p class="d-flex align-items-center"><i class="bx bx-time-five me-2"></i>30 minutes</p>
                                    <div class="progress mb-4" style="height: 8px">
                                        <div class="progress-bar w-75" role="progressbar" aria-valuenow="25" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div> --}}
                                    <!-- <div class="d-flex justify-content-between"> -->
                                    <div class="mt-auto">
                                        <div class="align-items-center justify-content-center d-flex">
                                            <a href="{{route('dashboard.investment.investOpportunitySingle', $datum->slug)}}"
                                                class="btn btn-primary w-100">Details</a>
                                        </div>
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