@extends('new-dashboard.master')

@section('title'){{ $_panel }}@endsection

@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
@if (session('warning'))
    <div class="alert alert-warning alert-dismissible fade show">
        {{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="d-flex justify-content-between py-1 mb-1">
    <h4 class="text-right">
        {{ $data['data']->name }} Profile
    </h4>
</div>

@php
    $investee         = $data['data'];
    $status           = Auth::user()->connectionStatusWith($investee->id);
    $isPendingRequest = \App\Models\Connection::where('sender_id', $investee->id)
                            ->where('receiver_id', Auth::id())
                            ->where('status', 'pending')
                            ->exists();
@endphp

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="user-profile-header-banner">
                <img src="{{ asset('new-dashboard/img/backgrounds/profile_cover.jpg') }}" alt="Banner image" class="rounded-top w-100" style="height:250px; object-fit:cover;">
            </div>
            <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4 px-4">
                <div class="flex-shrink-0 mt-n5 mx-sm-0 mx-auto" style="z-index: 2;">
                    <img src="{{ $investee->image ? asset($investee->image) : asset('new-dashboard/img/avatars/default.png') }}" alt="user image" class="d-block rounded user-profile-img border border-5 border-white bg-white" style="width:120px; height:120px; object-fit:cover;">
                </div>
                <div class="flex-grow-1 mt-1 mt-sm-5 ms-sm-4">
                    <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start flex-md-row flex-column gap-4">
                        <div class="user-profile-info">
                            <h4 class="mb-2">{{ $investee->name }}</h4>
                            <div class="d-flex align-items-center justify-content-center justify-content-sm-start gap-2 flex-wrap">
                                @foreach ($investee->sectors as $sector)
                                    <span class="badge bg-label-info"><i class="{{ $sector->icon }} mx-1"></i>{{ $sector->name }}</span>
                                @endforeach
                            </div>
                        </div>

                        {{-- Connection action buttons --}}
                        <div class="d-flex gap-2">
                            @if (Auth::id() === $investee->id)
                                <span class="btn btn-secondary disabled">
                                    <i class="bx bx-user me-1"></i> Your Profile
                                </span>

                            @elseif ($status === 'accepted')
                                <span class="btn btn-success disabled">
                                    <i class="bx bx-check me-1"></i> Connected
                                </span>

                            @elseif ($isPendingRequest)
                                {{-- This investee sent a request to me — I can accept or decline --}}
                                <form action="{{ route('dashboard.connect.accept', $investee->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success text-nowrap">
                                        <i class="bx bx-check me-1"></i> Accept
                                    </button>
                                </form>
                                <form action="{{ route('dashboard.connect.decline', $investee->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger text-nowrap">
                                        <i class="bx bx-x me-1"></i> Decline
                                    </button>
                                </form>

                            @elseif ($status === 'pending')
                                <span class="btn btn-warning disabled">
                                    <i class="bx bx-time me-1"></i> Request Pending
                                </span>

                            @elseif ($status === 'rejected')
                                <span class="btn btn-secondary disabled">
                                    <i class="bx bx-x me-1"></i> Request Rejected
                                </span>

                            @else
                                <form action="{{ route('dashboard.connect', $investee->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary text-nowrap">
                                        <i class="bx bx-user-plus me-1"></i> Connect
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Left column: Info & Connected Investors -->
    <div class="col-xl-4 col-lg-5 col-md-5">
        <!-- About card -->
        <div class="card mb-4">
            <div class="card-body">
                <small class="text-muted text-uppercase">About</small>
                <ul class="list-unstyled mb-4 mt-3">
                    <li class="d-flex align-items-center mb-3">
                        <i class="bx bx-user me-2"></i><span class="fw-medium">Full Name:</span> <span class="ms-2">{{ $investee->name }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="bx bx-envelope me-2"></i><span class="fw-medium">Email:</span> <span class="ms-2">{{ $investee->email }}</span>
                    </li>
                    @if($investee->description)
                        <li class="d-flex align-items-start mb-3">
                            <i class="bx bx-detail me-2 mt-1"></i><span class="fw-medium">Bio:</span> <span class="ms-2">{{ $investee->description }}</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        <!-- Connected Investors -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title mb-3"><i class="bx bx-group text-primary me-2"></i>Connected Investors</h5>
                @php
                    $connectedInvestors = $investee->connectedInvestors();
                @endphp
                @if($connectedInvestors->isEmpty())
                    <span class="text-muted">N/A</span>
                @else
                    <ul class="list-unstyled mb-0">
                        @foreach($connectedInvestors as $inv)
                            <li class="d-flex mb-3 align-items-center">
                                <div class="avatar avatar-sm me-2">
                                    <img src="{{ $inv->image ? asset($inv->image) : asset('new-dashboard/img/avatars/default.png') }}" alt="Avatar" class="rounded-circle" style="width: 32px; height: 32px; object-fit: cover;">
                                </div>
                                <div class="d-flex flex-column">
                                    <a href="{{ route('dashboard.investment.investor.profile', $inv->id) }}" class="text-body fw-medium">{{ $inv->name }}</a>
                                    <small class="text-muted text-truncate" style="max-width: 180px;">{{ $inv->description ?? 'Investor' }}</small>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

    <!-- Right column: Ideas -->
    <div class="col-xl-8 col-lg-7 col-md-7">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title mb-4"><i class="bx bx-bulb text-warning me-2"></i>Business Ideas</h5>
                @php
                    $ideas = $investee->ideas()->where('status', 'open')->get();
                @endphp
                @if($ideas->isEmpty())
                    <p class="text-muted">No business ideas published yet.</p>
                @else
                    <div class="row g-3">
                        @foreach($ideas as $idea)
                            <div class="col-12">
                                <div class="p-3 border rounded bg-light">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="mb-0"><a href="{{ route('dashboard.investment.investOpportunitySingle', $idea->slug) }}" class="text-body fw-bold">{{ $idea->name }}</a></h6>
                                        <span class="badge bg-label-success">Open</span>
                                    </div>
                                    <p class="text-muted small mb-2">{{ $idea->short_description }}</p>
                                    <div class="d-flex flex-wrap gap-3 small">
                                        <span><i class="bx bx-money text-success me-1"></i>Required: <strong>Rs. {{ number_format($idea->required_investment_amount) }}</strong></span>
                                        <span><i class="bx bx-trending-up text-info me-1"></i>ROI: <strong>{{ $idea->return_on_investment }}%</strong></span>
                                        <span><i class="bx bx-group text-warning me-1"></i>Team: <strong>{{ $idea->team_size }}</strong></span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
