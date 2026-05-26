<div class="card mb-4 @if($activeTab=='personal_detail_tab') active-tab @else hidden-tab @endif">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h5 class="card-title text-primary">Personal Details</h5>
            <small class="text-danger">All fields are required</small>
        </div>
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Full Name" wire:model="name">
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
            <div class="mb-3 col-md-6">
                <label for="sex" class="form-label ">Sex</label>
                <select id="sex" class="form-select @error('sex') is-invalid @enderror" wire:model="sex">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Others">Others</option>
                  </select>
                  @error('sex') <small class="text-danger">{{$message}} </small> @enderror
            </div>
            <div class="mb-3 col-md-6">
                <label for="dob" class="form-label">Date of Birth</label>
                <input class="form-control @error('dob') is-invalid @enderror" type="date" id="dob" name="dob" wire:model="dob">
                @error('dob') <small class="text-danger">{{$message}} </small> @enderror
            </div>
            <div class="mb-3 col-md-6">
                <label for="father_name" class="form-label">Father's Name</label>
                <input type="text" class="form-control @error('father_name') is-invalid @enderror" id="father_name" name="father_name" placeholder="Father's Name" wire:model="father_name">
                @error('father_name') <small class="text-danger">{{$message}} </small> @enderror
            </div>
            <div class="mb-3 col-md-6">
                <label for="grand_father_name" class="form-label">Grand Father's Name</label>
                <input class="form-control @error('grand_father_name') is-invalid @enderror" type="text" id="grand_father_name" name="grand_father_name" placeholder="Grand Father's Name" wire:model="grand_father_name">
                @error('grand_father_name') <small class="text-danger">{{$message}} </small> @enderror
            </div>
        </div>
    </div>
    @include('livewire.user.kyc-detail-button')
</div>


