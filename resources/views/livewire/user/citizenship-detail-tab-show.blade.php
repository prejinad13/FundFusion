<div class="card mb-4 @if($activeTab=='citizenship_detail_tab') active-tab @else hidden-tab @endif">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h5 class="card-title text-primary">Citizenship Details</h5>
        </div>
        <div class="row">
            <div class="mb-3 col-md-12">
                <label for="citizenship_number" class="form-label">Citizenship Number</label>
                <input type="text" class="form-control" id="citizenship_number" name="citizenship_number" placeholder="Citizenship Number" disabled wire:model="citizenship_number">
            </div>
            <div class="mb-3 col-md-6">
                <label for="citizenship_issue_date" class="form-label">Citizenship Issue Date</label>
                <input class="form-control" type="date" id="citizenship_issue_date" name="citizenship_issue_date" disabled wire:model="citizenship_issue_date">
            </div>
            <div class="mb-3 col-md-6">
                <label for="citizenship_issue_district" class="form-label">Citizenship Issue District</label>
                <input type="text" class="form-control" id="citizenship_issue_district" name="citizenship_issue_district" placeholder="Citizenship Number" disabled wire:model="citizenship_issue_district">
            </div>
            <div class="mb-3 col-md-6">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Citizenship Front Image</label>
                    <img class="img-fluid" height="100px" src="{{ isset($data->citizenship_front_document) ? asset($data->citizenship_front_document) :asset('new-dashboard/img/default_img.jpg') }}" wire:click="openImageModal('citizenship_front_image')">
                  </div>
            </div>
            <div class="mb-3 col-md-6">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Citizenship Back Image</label>
                    <img class="img-fluid" src="{{ isset($data->citizenship_back_document) ? asset($data->citizenship_back_document) :asset('new-dashboard/img/default_img.jpg') }}" wire:click="openImageModal('citizenship_back_image')">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.user.kyc-detail-button')
</div>


