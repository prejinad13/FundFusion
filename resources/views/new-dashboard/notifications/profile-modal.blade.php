<div class="card border-0 mb-0">
    {{-- Cover banner --}}
    <div class="user-profile-header-banner">
        <img src="{{ asset('new-dashboard/img/backgrounds/profile_cover.jpg') }}" alt="Banner" class="rounded-top w-100"
            style="height:150px;object-fit:cover;">
    </div>

    {{-- Avatar + name --}}
    <div class="px-4 pb-4">
        <div class="d-flex align-items-end gap-3 mt-n4 mb-3">
            <img src="{{ $user->image ? asset($user->image) : asset('new-dashboard/img/avatars/default.png') }}"
                class="rounded-circle border border-3 border-white" style="width:80px;height:80px;object-fit:cover;"
                alt="{{ $user->name }}">
            <div>
                <h5 class="mb-0">{{ $user->name }}</h5>
                <small class="text-muted">{{ Str::ucfirst($user->roles()->first()->name) }}</small>
            </div>
        </div>

        {{-- Sectors --}}
        @if ($user->sectors->count())
            <div class="mb-3 d-flex flex-wrap gap-2">
                @foreach ($user->sectors as $sector)
                    <span class="badge bg-label-info">
                        <i class="{{ $sector->icon }} me-1"></i>{{ $sector->name }}
                    </span>
                @endforeach
            </div>
        @endif

        {{-- Description --}}
        @if ($user->description)
            <p class="text-muted mb-3">{{ $user->description }}</p>
        @endif

        {{-- Info row --}}
        <div class="d-flex flex-wrap gap-3 text-muted small mb-3">
            @if ($user->province)
                <span><i class="bx bx-map me-1"></i>{{ $user->province }}</span>
            @endif
            @if ($user->created_at)
                <span><i class="bx bx-calendar me-1"></i>Joined {{ $user->created_at->format('d M, Y') }}</span>
            @endif
        </div>

        {{-- Connection status + Accept/Decline --}}
        @php
            $status = Auth::user()->connectionStatusWith($user->id);
            $isPendingRequest = \App\Models\Connection::where('sender_id', $user->id)
                ->where('receiver_id', Auth::id())
                ->where('status', 'pending')
                ->exists();
        @endphp

        <div class="d-flex gap-2 mb-4">
            @if (Auth::id() === $user->id)
                <span class="btn btn-secondary disabled">Your Profile</span>

            @elseif ($status === 'accepted')
                <span class="btn btn-success disabled">
                    <i class="bx bx-check me-1"></i> Connected
                </span>

            @elseif ($isPendingRequest)
                <form action="{{ route('dashboard.connect.accept', $user->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <i class="bx bx-check me-1"></i> Accept
                    </button>
                </form>
                <form action="{{ route('dashboard.connect.decline', $user->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <i class="bx bx-x me-1"></i> Decline
                    </button>
                </form>

            @elseif ($status === 'pending')
                <span class="btn btn-warning disabled">
                    <i class="bx bx-time me-1"></i> Request Pending
                </span>

            @elseif ($status === 'rejected')
                <span class="btn btn-secondary disabled">
                    <i class="bx bx-x me-1"></i> Rejected
                </span>

            @else
                <form action="{{ route('dashboard.connect', $user->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-user-plus me-1"></i> Connect
                    </button>
                </form>
            @endif
        </div>

        {{-- Ideas section (only for investees) --}}
        @if ($user->roles()->first()->name === 'investee')
            @php $ideas = $user->ideas()->where('status', 'open')->get(); @endphp

            <hr>
            <h6 class="mb-3"><i class="bx bx-bulb me-1 text-warning"></i> Ideas / Opportunities</h6>

            @if ($ideas->isEmpty())
                <p class="text-muted small">No open ideas at the moment.</p>
            @else
                <div class="row g-3">
                    @foreach ($ideas as $idea)
                        <div class="col-12">
                            <a href="{{ route('dashboard.investment.investOpportunitySingle', $idea->slug) }}"
                                class="text-decoration-none text-dark">
                                <div class="card border shadow-none bg-light mb-0"
                                    style="cursor:pointer; transition: box-shadow 0.2s;"
                                    onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'"
                                    onmouseout="this.style.boxShadow='none'">
                                    <div class="card-body py-3 px-3">
                                        <div class="d-flex justify-content-between align-items-start mb-1">
                                            <h6 class="mb-0">{{ $idea->name }}</h6>
                                            <span class="badge bg-success ms-2">Open</span>
                                        </div>
                                        <p class="text-muted small mb-2">{{ $idea->short_description }}</p>
                                        <div class="d-flex flex-wrap gap-3 small">
                                            <span>
                                                <i class="bx bx-money text-success me-1"></i>
                                                Required: <strong>Rs.
                                                    {{ number_format($idea->required_investment_amount) }}</strong>
                                            </span>
                                            <span>
                                                <i class="bx bx-trending-up text-info me-1"></i>
                                                ROI: <strong>{{ $idea->return_on_investment }}%</strong>
                                            </span>
                                            <span>
                                                <i class="bx bx-group text-warning me-1"></i>
                                                Team: <strong>{{ $idea->team_size }}</strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif

    </div>
</div>