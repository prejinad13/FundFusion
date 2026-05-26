<div class="card mb-4 @if($activeTab=='personal_detail_tab') active-tab @else hidden-tab @endif">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h5 class="card-title text-primary">Personal Details</h5>
        </div>
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" disabled wire:model="name">
            </div>
            <div class="mb-3 col-md-6">
                <label for="phone" class="form-label">Phone</label>
                <div class="input-group">
                    <span class="input-group-text">+977-</span>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="98********" disabled wire:model="phone" oninput = "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')">
                </div>
            </div>
            <div class="mb-3 col-md-6">
                <label for="sex" class="form-label ">Sex</label>
                <select id="sex" class="select2 form-select" disabled wire:model="sex">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Others">Others</option>
                  </select>
            </div>
            <div class="mb-3 col-md-6">
                <label for="dob" class="form-label">Date of Birth</label>
                <input class="form-control" type="date" id="dob" name="dob" disabled wire:model="dob">
            </div>
            <div class="mb-3 col-md-6">
                <label for="father_name" class="form-label">Father's Name</label>
                <input type="text" class="form-control" id="father_name" name="father_name" placeholder="Father's Name" disabled wire:model="father_name">
            </div>
            <div class="mb-3 col-md-6">
                <label for="grand_father_name" class="form-label">Grand Father's Name</label>
                <input class="form-control" type="text" id="grand_father_name" name="grand_father_name" placeholder="Grand Father's Name" disabled wire:model="grand_father_name">
            </div>
        </div>
    </div>
    @include('livewire.user.kyc-detail-button')
</div>


