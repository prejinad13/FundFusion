<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Welcome message -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
                Welcome {{ Auth::user()->name ?? "User" }}!
            </div>
        </div>

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- User Dropdown -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow d-flex align-items-center" data-bs-toggle="dropdown">
                    <div class="text mx-3" style="cursor: pointer;">My Account</div>
                    <div class="avatar avatar-online" style="width:40px; height:40px; overflow:hidden;">
                        @if (Auth::user()->image)
                            <img src="{{ asset(Auth::user()->image) }}" class=" rounded-circle"  style="width:100%; height:100%; object-fit:cover;" />
                        @else
                            <img src="{{ asset('new-dashboard/img/avatars/default.png') }}" class=" rounded-circle"  style="width:100%; height:100%; object-fit:cover;" />
                        @endif
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <!-- User info -->
                    <li>
                        <a class="dropdown-item" href="{{ route('dashboard.users.myProfile') }}">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online" style="width:40px; height:40px; overflow:hidden;">
                                        @if (Auth::user()->image)
                                            <img src="{{ asset(Auth::user()->image) }}" class=" rounded-circle"  style="width:100%; height:100%; object-fit:cover;" />
                                        @else
                                            <img src="{{ asset('new-dashboard/img/avatars/default.png') }}" class=" rounded-circle"  style="width:100%; height:100%; object-fit:cover;" />
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">{{ Auth::user()->name ?? "User" }}</span>
                                    <small class="text-muted">{{ Str::ucfirst(Auth::user()->roles()->first()->name) }}</small>
                                </div>
                            </div>
                        </a>
                    </li>

                    <li><div class="dropdown-divider"></div></li>

                    <!-- My Account -->
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.show') }}">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Account</span>
                        </a>
                    </li>

                    <!-- Notifications — now dynamic & clickable -->
                    <li>
                        @php $unreadCount = Auth::user()->unreadNotifications->count(); @endphp
                        <a class="dropdown-item" href="{{ route('dashboard.notifications.index') }}">
                            <span class="d-flex align-items-center align-middle">
                                <i class="flex-shrink-0 bx bx-bell me-2"></i>
                                <span class="flex-grow-1 align-middle">Notifications</span>
                                @if ($unreadCount > 0)
                                    <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">
                                        {{ $unreadCount }}
                                    </span>
                                @endif
                            </span>
                        </a>
                    </li>

                    <li><div class="dropdown-divider"></div></li>

                    <!-- Logout -->
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" class="dropdown-item"
                               onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>