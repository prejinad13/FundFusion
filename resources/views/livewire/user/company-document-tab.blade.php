<div class="card mb-4 @if($activeTab=='company_document_tab') active-tab @else hidden-tab @endif">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h5 class="card-title text-primary">Company Documents</h5>
            <small class="text-danger">All fields are required</small>
        </div>
        <div class="row">
            <div class="mb-3 col-md-6">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Company Registration Certificate Image <small class="text-success" wire:loading wire:target="temp_company_registration_certificate">Image Uploading</small></label>
                    <input class="form-control @error('temp_company_registration_certificate') is-invalid @enderror" type="file" name="temp_company_registration_certificate" wire:model="temp_company_registration_certificate">
                    @error('temp_company_registration_certificate') <small class="text-danger"> {{$message}} </small> <br> @enderror
                    <small class="text-muted">JPG or PNG of size less than MB recommended.</small>
                  </div>
            </div>
            <div class="mb-3 col-md-6">
                <img class="img-fluid" height="100px" src="{{ $temp_company_registration_certificate ? $temp_company_registration_certificate->temporaryUrl() : (isset($data->company_registration_certificate) ? asset($data->company_registration_certificate) :asset('new-dashboard/img/default_img.jpg')) }}">
            </div>
            <div class="mb-3 col-md-6">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Company PAN Image  <small class="text-success" wire:loading wire:target="temp_company_pan_certificate">Image Uploading</small> </label>
                    <input class="form-control @error('temp_company_pan_certificate') is-invalid @enderror" type="file" name="temp_company_pan_certificate" wire:model="temp_company_pan_certificate">
                    @error('temp_company_pan_certificate') <small class="text-danger"> {{$message}} </small> <br> @enderror
                    <small class="text-muted">JPG or PNG of size less than MB recommended.</small>
                  </div>
            </div>
            <div class="mb-3 col-md-6">
                <img class="img-fluid" src="{{ $temp_company_pan_certificate ? $temp_company_pan_certificate->temporaryUrl() : (isset($data->company_pan_certificate) ? asset($data->company_pan_certificate) :asset('new-dashboard/img/default_img.jpg')) }}">
            </div>
        </div>
    </div>
    @include('livewire.user.company-kyc-detail-button')

</div>


