@extends('new-dashboard.master')

@section('title') Notifications @endsection

@section('content')

{{-- Flash messages --}}
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

<div class="d-flex justify-content-between py-1 mb-3">
    <h4>Notifications</h4>
</div>

@if ($notifications->isEmpty())
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="bx bx-bell-off bx-lg text-muted mb-3 d-block"></i>
            <p class="text-muted">You have no notifications.</p>
        </div>
    </div>
@else
    <div class="card">
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                @foreach ($notifications as $notification)
                    @php
                        $d        = $notification->data;
                        $senderId = $d['sender_id'] ?? null;
                        // Check if this is a pending connection request TO the current user
                        $isPendingRequest = false;
                        if ($senderId) {
                            $isPendingRequest = \App\Models\Connection::where('sender_id', $senderId)
                                ->where('receiver_id', Auth::id())
                                ->where('status', 'pending')
                                ->exists();
                        }
                    @endphp
                    <li class="list-group-item d-flex align-items-center gap-3 py-3 px-4
                        {{ is_null($notification->read_at) ? 'bg-light' : '' }}">

                        {{-- Sender avatar --}}
                        <div class="avatar flex-shrink-0" style="cursor:pointer"
                             onclick="loadProfileModal({{ $senderId }})">
                            <img src="{{ isset($d['sender_image']) && $d['sender_image'] ? asset($d['sender_image']) : asset('new-dashboard/img/avatars/default.png') }}"
                                 class="rounded-circle" style="width:45px;height:45px;object-fit:cover;" alt="avatar">
                        </div>

                        {{-- Message --}}
                        <div class="flex-grow-1">
                            <span class="fw-semibold" style="cursor:pointer"
                                  onclick="loadProfileModal({{ $senderId }})">
                                {{ $d['sender_name'] ?? 'Someone' }}
                            </span>
                            {{ $d['message'] ?? 'sent you a notification' }}
                            <br>
                            <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                        </div>

                        {{-- Unread badge --}}
                        @if (is_null($notification->read_at))
                            <span class="badge rounded-pill bg-danger">New</span>
                        @endif

                        {{-- Action buttons --}}
                        <div class="d-flex gap-2 flex-shrink-0">
                            {{-- View Profile button (opens modal) --}}
                            @if ($senderId)
                                <button class="btn btn-sm btn-outline-primary"
                                        onclick="loadProfileModal({{ $senderId }})">
                                    <i class="bx bx-user me-1"></i> View Profile
                                </button>
                            @endif

                            {{-- Accept / Decline for pending requests --}}
                            @if ($isPendingRequest)
                                <form action="{{ route('dashboard.connect.accept', $senderId) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="bx bx-check me-1"></i> Accept
                                    </button>
                                </form>
                                <form action="{{ route('dashboard.connect.decline', $senderId) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bx bx-x me-1"></i> Decline
                                    </button>
                                </form>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $notifications->links() }}
    </div>
@endif

{{-- Profile Modal --}}
<div class="modal fade" id="profileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0" id="profileModalBody">
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p class="mt-2 text-muted">Loading profile...</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function loadProfileModal(userId) {
    if (!userId) return;

    // Reset modal content
    document.getElementById('profileModalBody').innerHTML = `
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status"></div>
            <p class="mt-2 text-muted">Loading profile...</p>
        </div>`;

    // Show the modal
    var modal = new bootstrap.Modal(document.getElementById('profileModal'));
    modal.show();

    // Fetch profile partial
    fetch(`/dashboard/profile-modal/${userId}`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(res => res.text())
    .then(html => {
        document.getElementById('profileModalBody').innerHTML = html;
    })
    .catch(() => {
        document.getElementById('profileModalBody').innerHTML =
            '<div class="text-center py-4 text-danger">Failed to load profile.</div>';
    });
}
</script>
@endpush

@endsection