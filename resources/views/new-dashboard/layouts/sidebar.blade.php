<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{route('home')}}" class="app-brand-link text-center">
            <span class="app-brand-logo demo ">
                <img width="200px" src="{{asset('new-dashboard/img/logos/fundfusion_text.png')}}">
            </span>
        </a>

        <a class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item @if (request()->is('dashboard/home')) active @endif">
            <a href="{{route('home')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-home"></i>
                <div>Dashboard</div>
            </a>
        </li>

        @if (Auth::user()->roles()->first()->name!='superadmin')
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Investment</span></li>

        @if (Auth::user()->roles()->first()->name=='investor')
        <li class="menu-item @if (request()->is('*investment-opportunities*')) active @endif">
            <a href="{{route('dashboard.investment.investOpportunities')}}" class="menu-link">
                <i class="menu-icon tf-icons fa-solid fa-piggy-bank"></i>
                <div>Opportunities</div>
            </a>
        </li>
        @endif

        @if (Auth::user()->roles()->first()->name=='investee')
        <li class="menu-item @if (request()->is('*investors*')) active @endif">
            <a href="{{route('dashboard.investment.investors')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-briefcase"></i>
                <div>Investors</div>
            </a>
        </li>

        <li class="menu-item @if (request()->is('*ideas*')) active @endif">
            <a href="{{route('dashboard.ideas.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-bulb"></i>
                <div>My Ideas</div>
            </a>
        </li>
        @endif
        @endif


        @if (Auth::user()->roles()->first()->name=='superadmin')
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Users</span></li>
        <li class="menu-item @if (request()->is('dashboard/users')) active @endif">
            <a href="{{route('dashboard.users.index')}}" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-group"></i>
              <div class="text-truncate">All Users</div>
            </a>
          </li>
        <li class="menu-item @if (request()->is('dashboard/users/verified')) active @endif">
            <a href="{{route('dashboard.users.verified')}}" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-user-check"></i>
              <div class="text-truncate">KYC Verified</div>
            </a>
          </li>
          <li class="menu-item @if (request()->is('dashboard/users/unverified')) active @endif">
            <a href="{{route('dashboard.users.unverified')}}" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-user-x"></i>
              <div class="text-truncate">KYC Unverified</div>
            </a>
          </li>
        @endif

        @if (Auth::user()->roles()->first()->name=='superadmin')
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Settings</span></li>
        <li class="menu-item @if (request()->is('*sectors*')) active @endif">
            <a href="{{ route('dashboard.sectors.index') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-directions"></i>
              <div class="text-truncate">Sector</div>
            </a>
        </li>
        @endif

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Account</span></li>
        @if (Auth::user()->roles()->first()->name=='superadmin')
        <li class="menu-item @if (request()->is('profile*')) active @endif">
            <a href="{{ route('profile.show') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-user"></i>
              <div class="text-truncate">Profile</div>
            </a>
        </li>
        @else
        <li class="menu-item  @if (request()->is('*kyc-details*') || request()->is('*interests*') || request()->is('*profile*')) active open @endif">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-user"></i>
                <div class="text-truncate">Profile</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @if (request()->is('*dashboard/my-profile*')) active @endif">
                    <a href="{{ route('dashboard.users.myProfile') }}" class="menu-link">
                        <div>My Profile</div>
                    </a>
                </li>
                <li class="menu-item @if (request()->is('*dashboard/profile')) active @endif">
                    <a href="{{route('profile.show')}}" class="menu-link">
                        <div>My Account</div>
                    </a>
                </li>
            </ul>
        </li>
        @endif
        <li class="menu-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="menu-link" onclick="event.preventDefault(); this.closest('form').submit();">
                <i class="menu-icon tf-icons bx bx-power-off"></i>
                <div class="text-truncate">Logout</div>
                </a>
            </form>
        </li>
    </ul>
</aside>
