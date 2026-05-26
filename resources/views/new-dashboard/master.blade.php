<!DOCTYPE html>
<html lang="en">
@include('new-dashboard.layouts.head')

<body>

    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('new-dashboard.layouts.sidebar')
            <div class="layout-page">
                @include('new-dashboard.layouts.navbar')
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme text-center">
                        <div class="container-xxl py-2">
                            <div class="mb-2 mb-md-0"><strong>FundFusion</strong> made with ❤️ by Dinesh Baral, Rojal Shakya & Rojina Upreti</div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    @if (Auth::user()->roles()->first()->name!='superadmin')
        @if (Auth::user()->kyc_status!='verified')
            @php
                switch (Auth::user()->kyc_status) {
                    case 'processing':
                        $class_name='warning';
                        $message="KYC Under Verification!";
                        break;

                    case 'rejected':
                        $class_name='danger';
                        $message="KYC Rejected!";
                        break;

                    default:
                        $class_name='danger';
                        $message="KYC Not Applied!";
                        break;
                }
            @endphp
        <div class="buy-now">
            <a href="{{route('dashboard.users.myProfile')}}" class="btn btn-{{$class_name}} btn-buy-now">{{$message}}</a>
        </div>
        @endif

    @endif
    @include('new-dashboard.layouts.script')
</body>

</html>
