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
    <h4>{{ $data['data']->name }} Profile</h4>
</div>

@php
    $investor         = $data['data'];
    $status           = Auth::user()->connectionStatusWith($investor->id);
    $isPendingRequest = \App\Models\Connection::where('sender_id', $investor->id)
                            ->where('receiver_id', Auth::id())
                            ->where('status', 'pending')
                            ->exists();
@endphp

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="user-profile-header-banner">
                <img src="{{ asset('new-dashboard/img/backgrounds/profile_cover.jpg') }}"
                     alt="Banner image" class="rounded-top">
            </div>
            <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                    <img src="{{ $investor->image ? asset($investor->image) : asset('new-dashboard/img/avatars/default.png') }}"
                         alt="user image"
                         class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
                </div>
                <div class="flex-grow-1 mt-1 mt-sm-5">
                    <div class="d-flex align-items-md-end align-items-sm-start align-items-center
                                justify-content-md-between justify-content-start mx-4
                                flex-md-row flex-column gap-4">

                        <div class="user-profile-info">
                            <h4>{{ $investor->name }}</h4>
                            <div class="d-flex align-items-center justify-content-center gap-2 flex-wrap">
                                @foreach ($investor->sectors as $sector)
                                    <span class="badge bg-label-info">
                                        <i class="{{ $sector->icon }} mx-1"></i>{{ $sector->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        {{-- Connection action buttons --}}
                        <div class="d-flex gap-2">
                            @if (Auth::id() === $investor->id)
                                <span class="btn btn-secondary disabled">
                                    <i class="bx bx-user me-1"></i> Your Profile
                                </span>

                            @elseif ($status === 'accepted')
                                <span class="btn btn-success disabled">
                                    <i class="bx bx-check me-1"></i> Connected
                                </span>

                            @elseif ($isPendingRequest)
                                {{-- This investor sent a request to me — I can accept or decline --}}
                                <form action="{{ route('dashboard.connect.accept', $investor->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success text-nowrap">
                                        <i class="bx bx-check me-1"></i> Accept
                                    </button>
                                </form>
                                <form action="{{ route('dashboard.connect.decline', $investor->id) }}" method="POST">
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
                                <form action="{{ route('dashboard.connect', $investor->id) }}" method="POST">
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

@endsection