<div class="row">
    <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
        <div class="card mb-4">
            <div class="card-body">
                <div class="user-avatar-section">
                    <div class=" d-flex align-items-center flex-column">
                        @php
                        if(isset($data->image)){
                        $image=asset($data->image);
                        }else{
                        $image=asset('new-dashboard/img/avatars/default.png');
                        }
                        @endphp
                        <img class="img-fluid d-block rounded my-4" src="{{$image}}" height="110" width="110" alt="User avatar" wire:click="openImageModal('passport_photo')">
                        <div class="user-info text-center">
                            <h4 class="mb-2">{{$data->name}}</h4>
                            <span class="badge bg-label-secondary mx-2">
                                @if ($data->account_type=='individual')
                                <i class="bx bx-user bx-sm me-2"></i>
                                @else
                                <i class="bx bx-buildings bx-sm me-2"></i>
                                @endif
                                {{Str::ucfirst($data->account_type)}}
                            </span>
                            <span class="badge bg-label-secondary">
                                @if ($data->roles()->first()->name=='investor')
                                <i class="bx bxs-briefcase bx-sm me-2 text-info"></i>
                                @else
                                <i class="bx bxs-rocket bx-sm me-2 text-warning"></i>
                                @endif
                                {{Str::ucfirst($data->roles()->first()->name)}}
                            </span>
                        </div>
                    </div>
                </div>
                <h5 class="pb-2 mt-2 border-bottom mb-4"></h5>
                <div class="info-container">
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <span class="fw-medium me-2">Email:</span>
                            <span>{{$data->email}}
                                @if ($data->email_verified_at)
                                <small class="text-success" title="Email Verified"><i
                                        class='bx bxs-check-circle'></i></small>
                                @else
                                <small class="text-danger" title="Email Unverified"><i
                                        class='bx bxs-x-circle'></i></small>
                                @endif
                            </span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-medium me-2">KYC Status:</span>
                            @php
                            switch ($data->kyc_status) {
                            case 'rejected':
                            $badge_status="danger";
                            break;

                            case 'verified':
                            $badge_status="success";
                            break;

                            case 'processing':
                            $badge_status="warning";
                            break;

                            default:
                            $badge_status="secondary";
                            break;
                            }
                            @endphp
                            <span
                                class="badge  bg-label-{{$badge_status}}">{{Str::ucfirst($data->kyc_status)}}</span>
                        </li>
                        <li class="mb-3">
                            <span class="fw-medium me-2">Joined At:</span>
                            <span>{{Carbon\Carbon::parse($data->created_at)->format('d M, Y')}}</span>
                        </li>
                    </ul>
                    @if ($data->kyc_status != 'verified' && $data->kyc_status != 'rejected')
                    <div class="d-grid d-flex w-100 mt-4 pt-2">
                        <button wire:click="confirmKycVerify" class="w-50 btn btn-success me-3 @if($data->kyc_status == 'unverified') disabled @endif" >Verify</a>
                        <button wire:click="openModal" class="w-50 btn btn-label-danger suspend-user @if($data->kyc_status == 'unverified') disabled @endif">Reject</a>
                    </div>
                    @endif
                    @if ($data->kyc_status == 'rejected')
                    <div class="alert alert-warning">
                        <h6 class="alert-heading mb-1">KYC Rejected</h6>
                        <p class="mb-0">- {{$data->kyc_remarks}}</p>
                      </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if ($data->account_type=='individual')
    <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
        @if ($data->kyc_status == 'unverified')
        <img class="img-fluid" src="{{asset('new-dashboard/img/illustrations/kyc.jpg')}}" alt="KYC Not Applied"
            title="KYC Not Applied">
        @else
        <ul class="nav nav-pills flex-column flex-md-row mb-3">
            <li class="nav-item"><button class="nav-link @if($activeTab=='personal_detail_tab') active @endif" wire:click="changeTab('personal_detail_tab')"><i class="bx bx-user me-1"></i>Personal Details</button></li>
            <li class="nav-item"><button class="nav-link @if($activeTab=='address_detail_tab') active @endif" wire:click="changeTab('address_detail_tab')"><i class="bx bx-map me-1"></i>Address Details</button></li>
            <li class="nav-item"><button class="nav-link @if($activeTab=='citizenship_detail_tab') active @endif" wire:click="changeTab('citizenship_detail_tab')"><i class="bx bx-id-card me-1"></i>Citizenship Details</button></li>
        </ul>

        @include('livewire.user.personal-detail-tab-show')
        @include('livewire.user.address-detail-tab-show')
        @include('livewire.user.citizenship-detail-tab-show')
        @endif
    </div>
    @endif

    @if ($data->account_type=='company')
    <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
        @if ($data->kyc_status == 'unverified')
        <img class="img-fluid" src="{{asset('new-dashboard/img/illustrations/kyc.jpg')}}" alt="KYC Not Applied"
            title="KYC Not Applied">
        @else
        <ul class="nav nav-pills flex-column flex-md-row mb-3">
            <li class="nav-item"><button class="nav-link @if($activeTab=='company_detail_tab') active @endif" wire:click="changeTab('company_detail_tab')"><i class="bx bx-detail me-1"></i>Company Info</button></li>
            <li class="nav-item"><button class="nav-link @if($activeTab=='company_document_tab') active @endif" wire:click="changeTab('company_document_tab')"><i class="bx bx-file me-1"></i>Company Document</button></li>
          </ul>

        @include('livewire.user.company-detail-tab-show')
        @include('livewire.user.company-document-tab-show')
        @endif
    </div>
    @endif


    @include('livewire.user.remark-modal')
    @include('livewire.user.image-modal')

</div>

@script
<script>
    window.addEventListener('confirm_kyc_verification', event => {
       Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, Verify!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
               $wire.dispatch('verifyKyc');
            }
        });
    });
</script>
@endscript

@script
<script>
    window.addEventListener('kyc_status', event => {
        Swal.fire({
            icon: "success",
            title: "KYC Verified!",
            showConfirmButton: false,
            timer: 1500
            });
            $wire.dispatch('refresh');
         });
</script>
@endscript

@script
<script>
    window.addEventListener('confirm_kyc_rejection', event => {
       Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, Reject!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
               $wire.dispatch('rejectKyc');
            }else{
                $wire.dispatch('closeModal');
            }
        });
    });
</script>
@endscript

@script
<script>
    window.addEventListener('kyc_rejected', event => {
        Swal.fire({
            icon: "error",
            title: "KYC Rejected!",
            showConfirmButton: false,
            timer: 1500
            });
         $wire.dispatch('refresh');
         });
</script>
@endscript
