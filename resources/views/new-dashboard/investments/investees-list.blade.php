@extends('new-dashboard.master')

@section('title'){{$_panel}}@endsection

@section('content')

<div class="d-flex justify-content-between py-3 mb-4">
    <h4 class="text-right">
        {{$_panel}}
    </h4>
</div>

<div class="row g-4">
    @foreach ($data['data'] as $datum)
    <div class="col-xl-4 col-lg-6 col-md-6 d-flex align-items-stretch">
        <div class="card w-100 d-flex flex-column">
            <div class="card-body text-center d-flex flex-column flex-grow-1">
                <div class="mx-auto mb-3" style="width:100px; height:100px; overflow:hidden;">
                    <img src="{{$datum->image?asset($datum->image):asset('new-dashboard/img/avatars/default.png')}}" alt="{{$datum->name}}" class="rounded-circle w-px-100"
                     style="width:100%; height:100%; object-fit:cover;">
                </div>
                <h5 class="mb-1 card-title">{{$datum->name}}</h5>
                <div class="d-flex align-items-center justify-content-center gap-1 flex-wrap mb-2">
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
                <span>{{$datum->description}}</span>

                <div class="my-3 gap-2">
                    @foreach ($datum->sectors as $sector)
                        <small class="badge bg-label-info my-1"><i class="{{$sector->icon}}"></i> {{$sector->name}}</small>
                    @endforeach
                </div>

                <div class="d-flex align-items-center justify-content-center mt-auto">
                    <a href="{{route('dashboard.investment.investee.profile',$datum->id)}}" class="btn btn-primary d-flex align-items-center w-100">Details</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
