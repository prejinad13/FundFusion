<div class="card mb-4 @if($activeTab=='address_detail_tab') active-tab @else hidden-tab @endif">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h5 class="card-title text-primary">Address Details</h5>
        </div>
        <h6>Permanent Address</h6>
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="province" class="form-label">Province</label>
                <input type="text" class="form-control" id="province" name="province" placeholder="Province" disabled wire:model.live="province">
            </div>
            <div class="mb-3 col-md-6">
                <label for="district" class="form-label">District</label>
                <input type="text" class="form-control" id="district" name="district" placeholder="District" disabled wire:model.live="district">
            </div>
            <div class="mb-3 col-md-6">
                <label for="municipality" class="form-label">Municipality</label>
                <input type="text" class="form-control" id="municipality" name="municipality" placeholder="Municipality" disabled wire:model.live="municipality">
            </div>
            <div class="mb-3 col-md-6">
                <label for="ward" class="form-label">Ward Number</label>
                <input type="text" class="form-control" id="ward" name="ward" placeholder="Ward Number" disabled wire:model.live="ward">
            </div>
            <div class="mb-3 col-md-12">
                <label for="locality" class="form-label">Locality</label>
                <input type="text" class="form-control" id="locality" name="locality" placeholder="Locality" disabled wire:model.live="locality">
            </div>

        </div>
        <hr class="my-4 mx-n4">
        <div class="d-flex justify-content-between">
            <h6>Temporary Address</h6>
        </div>
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="temporary_province" class="form-label">Province</label>
                <input type="text" class="form-control" id="temporary_province" name="temporary_province" placeholder="Province" disabled wire:model.live="temporary_province">
            </div>
            <div class="mb-3 col-md-6">
                <label for="temporary_district" class="form-label">District</label>
                <input type="text" class="form-control" id="temporary_district" name="temporary_district" placeholder="District" disabled wire:model.live="temporary_district">
            </div>
            <div class="mb-3 col-md-6">
                <label for="temporary_municipality" class="form-label">Municipality</label>
                <input type="text" class="form-control" id="temporary_municipality" name="temporary_municipality" placeholder="Municipality" disabled wire:model.live="temporary_municipality">
            </div>
            <div class="mb-3 col-md-6">
                <label for="temporary_ward" class="form-label">Ward Number</label>
                <input type="text" class="form-control" id="temporary_ward" name="temporary_ward" placeholder="Ward Number" disabled wire:model.live="temporary_ward">
            </div>
            <div class="mb-3 col-md-12">
                <label for="temporary_locality" class="form-label">Locality</label>
                <input type="text" class="form-control" id="temporary_locality" name="temporary_locality" placeholder="Locality" disabled wire:model.live="temporary_locality">
            </div>

        </div>
    </div>
    @include('livewire.user.kyc-detail-button')
</div>

