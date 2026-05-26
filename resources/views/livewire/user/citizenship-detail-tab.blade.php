<div class="card mb-4 @if($activeTab=='citizenship_detail_tab') active-tab @else hidden-tab @endif">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h5 class="card-title text-primary">Citizenship Details</h5>
            <small class="text-danger">All fields are required</small>
        </div>
        <div class="row">
            <div class="mb-3 col-md-12">
                <label for="citizenship_number" class="form-label">Citizenship Number</label>
                <input type="text" class="form-control @error('citizenship_number') is-invalid @enderror" id="citizenship_number" name="citizenship_number" placeholder="Citizenship Number" wire:model="citizenship_number">
                @error('citizenship_number') <small class="text-danger"> {{$message}} </small> @enderror
            </div>
            <div class="mb-3 col-md-6">
                <label for="citizenship_issue_date" class="form-label">Citizenship Issue Date</label>
                <input class="form-control @error('citizenship_issue_date') is-invalid @enderror" type="date" id="citizenship_issue_date" name="citizenship_issue_date" wire:model="citizenship_issue_date">
                @error('citizenship_issue_date') <small class="text-danger"> {{$message}} </small> @enderror
            </div>
            <div class="mb-3 col-md-6">
                <label for="citizenship_issue_district" class="form-label">Citizenship Issue District</label>
                <select id="citizenship_issue_district" class="select2 form-select @error('citizenship_issue_district') is-invalid @enderror" wire:model="citizenship_issue_district">
                    @foreach ($district_lists as $district)
                    <option value="{{$district}}">{{Str::ucfirst(Str::lower($district))}}</option>
                    @endforeach
                  </select>
                  @error('citizenship_issue_district') <small class="text-danger"> {{$message}} </small> @enderror
            </div>
            <div class="mb-3 col-md-6">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Citizenship Front Image <small class="text-success" wire:loading wire:target="temp_citizenship_front_document">Image Uploading</small></label>
                    <input class="form-control @error('temp_citizenship_front_document') is-invalid @enderror" type="file" name="temp_citizenship_front_document" wire:model="temp_citizenship_front_document">
                    @error('temp_citizenship_front_document') <small class="text-danger"> {{$message}} </small> <br> @enderror
                    <small class="text-muted">JPG or PNG of size less than MB recommended.</small>
                  </div>
            </div>
            <div class="mb-3 col-md-6">
                <img class="img-fluid" height="100px" src="{{ $temp_citizenship_front_document ? $temp_citizenship_front_document->temporaryUrl() : (isset($data->citizenship_front_document) ? asset($data->citizenship_front_document) :asset('new-dashboard/img/default_img.jpg')) }}">
            </div>
            <div class="mb-3 col-md-6">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Citizenship Back Image  <small class="text-success" wire:loading wire:target="temp_citizenship_back_document">Image Uploading</small> </label>
                    <input class="form-control @error('temp_citizenship_back_document') is-invalid @enderror" type="file" name="temp_citizenship_back_document" wire:model="temp_citizenship_back_document">
                    @error('temp_citizenship_back_document') <small class="text-danger"> {{$message}} </small> <br> @enderror
                    <small class="text-muted">JPG or PNG of size less than MB recommended.</small>
                  </div>
            </div>
            <div class="mb-3 col-md-6">
                <img class="img-fluid" src="{{ $temp_citizenship_back_document ? $temp_citizenship_back_document->temporaryUrl() : (isset($data->citizenship_back_document) ? asset($data->citizenship_back_document) :asset('new-dashboard/img/default_img.jpg')) }}">
            </div>
        </div>
    </div>
    @include('livewire.user.kyc-detail-button')
</div>


