<div class="row">
    <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
      <div class="card mb-4">

        <div class="card-body">
          <div class="user-avatar-section">
            <div class=" d-flex align-items-center flex-column">
                @error('temp_image')<br> <small class="text-danger"> {{$message}} </small> @enderror
              <img class="img-fluid d-block rounded my-4" @error('temp_image') style="border:5px solid #ff3e1d" @enderror src="{{ $temp_image ? $temp_image->temporaryUrl() : (isset($data->image) ? asset($data->image) :asset('new-dashboard/img/avatars/default.png')) }}" height="110" width="110" alt="User avatar" wire:click="openImageModal('passport_photo')">
              @if ($data->kyc_status=='unverified' || $data->kyc_status=='rejected')
              <div class="button-wrapper">
                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                  <span class="d-none d-sm-block">Upload Photo</span>
                  <i class="bx bx-upload d-block d-sm-none"></i>
                  <input type="file" id="upload" name="image" wire:model="temp_image" class="account-file-input" hidden="" accept="image/png, image/jpeg">
                </label>
              </div>
              @endif
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
                    <small class="text-success" title="Email Verified"><i class='bx bxs-check-circle'></i></small>
                    @else
                    <small class="text-danger" title="Email Unverified"><i class='bx bxs-x-circle'></i></small>
                    @endif
                </span>
              </li>
              <li class="mb-3">
                <span class="fw-medium me-2">Status:</span>
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
                        <span class="badge  bg-label-{{$badge_status}}">{{Str::ucfirst($data->kyc_status)}}</span>
              </li>
              <li class="mb-3">
                <span class="fw-medium me-2">Joined At:</span>
                <span>{{Carbon\Carbon::parse($data->created_at)->format('d M, Y')}}</span>
              </li>
            </ul>
            @if ($data->kyc_status != 'processing' || $data->kyc_status != 'verified')
            <div class="d-grid w-100 mt-4 pt-2">
                @if($data->kyc_status == 'unverified')
                 <button class="btn btn-warning" wire:click="submit">Request KYC Verification </a>
                @endif
                @if($data->kyc_status == 'rejected')
                <div class="alert alert-warning">
                    <h6 class="alert-heading mb-1">KYC Rejected</h6>
                    <p class="mb-0">- {{$data->kyc_remarks}}</p>
                </div>
                 <button class="btn btn-warning" wire:click="submit">Reapply for KYC Verification </a>
                @endif
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
        <ul class="nav nav-pills flex-column flex-md-row mb-3">
            <li class="nav-item"><button class="nav-link @if($activeTab=='personal_detail_tab') active @endif" wire:click="changeTab('personal_detail_tab')"><i class="bx bx-user me-1"></i>Personal Info</button></li>
            <li class="nav-item"><button class="nav-link @if($activeTab=='address_detail_tab') active @endif" wire:click="changeTab('address_detail_tab')"><i class="bx bx-map me-1"></i>Address Info</button></li>
            <li class="nav-item"><button class="nav-link @if($activeTab=='citizenship_detail_tab') active @endif" wire:click="changeTab('citizenship_detail_tab')"><i class="bx bx-id-card me-1"></i>Citizenship Info</button></li>
          </ul>

          @if ($data->kyc_status=='unverified' || $data->kyc_status=='rejected')
              @include('livewire.user.personal-detail-tab')
              @include('livewire.user.address-detail-tab')
              @include('livewire.user.citizenship-detail-tab')
          @else
              @include('livewire.user.personal-detail-tab-show')
              @include('livewire.user.address-detail-tab-show')
              @include('livewire.user.citizenship-detail-tab-show')
          @endif
    </div>

    @if ($data->kyc_verification!='processing' || $data->kyc_verification!='rejected')
        @include('livewire.user.image-modal')
    @endif

</div>

@if ($errors->count()>0)
@script
<script>
        Swal.fire({
            icon: "error",
            title: "Validation Error!",
            text: "Please check all the fields before submitting",
            showConfirmButton: false,
            timer: 2500
            });
</script>
@endscript
@endif


@script
<script>
    window.addEventListener('kyc_message', event => {
        Swal.fire({
            icon: "success",
            title: "KYC Applied Succesfully!",
            text: "KYC Verification May take some time. Please wait till verification!",
            showConfirmButton: false,
            timer: 2500
            });
            $wire.dispatch('refresh');
         });
</script>
@endscript



