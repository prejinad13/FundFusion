<div class="card mb-4 @if($activeTab=='company_detail_tab') active-tab @else hidden-tab @endif">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h5 class="card-title text-primary">Company Details</h5>
            <small class="text-danger">All fields are required</small>
        </div>
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="name" class="form-label">Company Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Company Name" wire:model="name">
                @error('name') <small class="text-danger">{{$message}} </small> @enderror
            </div>
            <div class="mb-3 col-md-6">
                <label for="phone" class="form-label">Phone</label>
                <div class="input-group">
                    <span class="input-group-text">+977-</span>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="98********" wire:model="phone" oninput = "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')">
                </div>
                @error('phone') <small class="text-danger">{{$message}} </small> @enderror
            </div>
            <div class="mb-3 col-md-12">
                <label for="company_address" class="form-label">Company Address</label>
                <input type="text" class="form-control @error('company_address') is-invalid @enderror" id="company_address" name="company_address" placeholder="Company Address" wire:model="company_address">
                @error('company_address') <small class="text-danger">{{$message}} </small> @enderror
            </div>
            <div class="mb-3 col-md-6">
                <label for="company_registration_date" class="form-label">Company Registered Date</label>
                <input class="form-control @error('company_registration_date') is-invalid @enderror" type="date" id="company_registration_date" name="company_registration_date" wire:model="company_registration_date">
                @error('company_registration_date') <small class="text-danger">{{$message}} </small> @enderror
            </div>
            <div class="mb-3 col-md-6">
                <label for="company_registration_number" class="form-label">Company Registration Number</label>
                <input type="text" class="form-control @error('company_registration_number') is-invalid @enderror" id="company_registration_number" name="company_registration_number" placeholder="Company Registration Number" wire:model="company_registration_number">
                @error('company_registration_number') <small class="text-danger">{{$message}} </small> @enderror
            </div>
            <div class="mb-3 col-md-6">
                <label for="pan_number" class="form-label">PAN Number</label>
                <input class="form-control @error('pan_number') is-invalid @enderror" type="text" id="pan_number" name="pan_number" placeholder="Company PAN Number" wire:model="pan_number">
                @error('pan_number') <small class="text-danger">{{$message}} </small> @enderror
            </div>
        </div>
    </div>
    @include('livewire.user.company-kyc-detail-button')
</div>


