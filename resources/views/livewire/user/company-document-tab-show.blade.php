<div class="card mb-4 @if($activeTab=='company_document_tab') active-tab @else hidden-tab @endif">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h5 class="card-title text-primary">Company Documents</h5>
        </div>
        <div class="row">
            <div class="mb-3 col-md-6">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Company Registration Certificate</label>
                    <img class="img-fluid" height="100px" src="{{ isset($data->company_registration_certificate) ? asset($data->company_registration_certificate) :asset('new-dashboard/img/default_img.jpg') }}" wire:click="openImageModal('citizenship_front_image')">
                  </div>
            </div>
            <div class="mb-3 col-md-6">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Company PAN</label>
                    <img class="img-fluid" src="{{ isset($data->company_pan_certificate) ? asset($data->company_pan_certificate) :asset('new-dashboard/img/default_img.jpg') }}" wire:click="openImageModal('citizenship_back_image')">
                </div>
            </div>
        </div>
    </div>
    @include('livewire.user.company-kyc-detail-button')
</div>
