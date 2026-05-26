<div class="card mb-4 @if($activeTab=='address_detail_tab') active-tab @else hidden-tab @endif">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h5 class="card-title text-primary">Address Details</h5>
            <small class="text-danger">All fields are required</small>
        </div>
        <h6>Permanent Address</h6>
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="province" class="form-label">Province</label>
                <select name="province" class="form-select @error('province') is-invalid @enderror" wire:model.live="province">
                    @foreach ($province_names as $province_name)
                    <option value="{{ $province_name['province'] }}">{{ Str::ucfirst(Str::lower($province_name['province']))}}</option>
                    @endforeach
                </select>
                @error('province') <small class="text-danger">{{$message}}</small> @enderror
            </div>
            <div class="mb-3 col-md-6">
                <label for="district" class="form-label">District</label>
                @if ($provinceSelected==true)
                    <select name="district" class="form-select @error('district') is-invalid @enderror" wire:model.live="district">
                        @foreach ($district_names as $district_name)
                        <option value="{{ $district_name['district'] }}">{{ Str::ucfirst(Str::lower($district_name['district']))}}</option>
                        @endforeach
                    </select>
                    @error('district') <small class="text-danger">{{$message}}</small> @enderror
                @else
                <select name="district" class="form-select @error('district') is-invalid @enderror">
                    <option value="" disabled selected>District</option>
                </select>
                @error('district') <small class="text-danger">{{$message}}</small> @enderror
                @endif
            </div>
            <div class="mb-3 col-md-6">
                <label for="municipality" class="form-label">Municipality</label>
                @if ($districtSelected==true)
                <select name="municipality" class="form-select @error('municipality') is-invalid @enderror" wire:model.live="municipality">
                    @foreach ($municipality_names as $municipality_name)
                    <option value="{{ $municipality_name }}">{{ Str::ucfirst(Str::lower($municipality_name))}}</option>
                    @endforeach
                </select>
                @error('municipality') <small class="text-danger">{{$message}}</small> @enderror
            @else
            <select name="municipality" class="form-select @error('municipality') is-invalid @enderror">
                <option value="" disabled selected>Municipality</option>
            </select>
            @error('municipality') <small class="text-danger">{{$message}}</small> @enderror
            @endif
            </div>
            <div class="mb-3 col-md-6">
                <label for="ward" class="form-label">Ward Number</label>
                <input type="text" class="form-control @error('ward') is-invalid @enderror" id="ward" name="ward" placeholder="Ward Number" wire:model.live="ward">
            </div>
            <div class="mb-3 col-md-12">
                <label for="locality" class="form-label">Locality</label>
                <input type="text" class="form-control @error('locality') is-invalid @enderror" id="locality" name="locality" placeholder="Locality" wire:model.live="locality">
                @error('locality') <small class="text-danger">{{$message}}</small> @enderror
            </div>

        </div>
        <hr class="my-4 mx-n4">
        <div class="d-flex justify-content-between">
            <h6>Temporary Address</h6>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="same_as_permanent" wire:model="same_as_permanent">
                <label class="form-check-label" for="same_as_permanent">
                  Same as Permanent
                </label>
              </div>
        </div>
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="temporary_province" class="form-label">Province</label>
                <select name="temporary_province" class="form-select @error('temporary_province') is-invalid @enderror" wire:model.live="temporary_province">
                    @foreach ($temporary_province_names as $temporary_province_name)
                    <option value="{{ $temporary_province_name['province'] }}">{{ Str::ucfirst(Str::lower($temporary_province_name['province']))}}</option>
                    @endforeach
                </select>
                @error('temporary_province') <small class="text-danger">{{$message}}</small> @enderror
            </div>
            <div class="mb-3 col-md-6">
                <label for="temporary_district" class="form-label">District</label>
                @if ($temporary_provinceSelected==true)
                    <select name="temporary_district" class="form-select @error('temporary_district') is-invalid @enderror" wire:model.live="temporary_district">
                        @foreach ($temporary_district_names as $temporary_district_name)
                        <option value="{{ $temporary_district_name['district'] }}">{{ Str::ucfirst(Str::lower($temporary_district_name['district']))}}</option>
                        @endforeach
                    </select>
                    @error('temporary_district') <small class="text-danger">{{$message}}</small> @enderror
                @else
                <select name="temporary_district" class="form-select @error('temporary_district') is-invalid @enderror">
                    <option value="" disabled selected>District</option>
                </select>
                @error('temporary_district') <small class="text-danger">{{$message}}</small> @enderror
                @endif
            </div>
            <div class="mb-3 col-md-6">
                <label for="temporary_municipality" class="form-label">Municipality</label>
                @if ($temporary_districtSelected==true)
                <select name="temporary_municipality" class="form-select @error('temporary_municipality') is-invalid @enderror" wire:model.live="temporary_municipality">
                    @foreach ($temporary_municipality_names as $temporary_municipality_name)
                    <option value="{{ $temporary_municipality_name }}">{{ Str::ucfirst(Str::lower($temporary_municipality_name))}}</option>
                    @endforeach
                </select>
                @error('temporary_municipality') <small class="text-danger">{{$message}}</small> @enderror
            @else
            <select name="temporary_municipality" class="form-select @error('temporary_municipality') is-invalid @enderror">
                <option value="" disabled selected>Municipality</option>
            </select>
            @error('temporary_municipality') <small class="text-danger">{{$message}}</small> @enderror
            @endif
            </div>
            <div class="mb-3 col-md-6">
                <label for="temporary_ward" class="form-label">Ward Number</label>
                <input type="text" class="form-control @error('temporary_ward') is-invalid @enderror" id="temporary_ward" name="temporary_ward" placeholder="Ward Number" wire:model.live="temporary_ward">
                @error('temporary_ward') <small class="text-danger">{{$message}}</small> @enderror
            </div>
            <div class="mb-3 col-md-12">
                <label for="temporary_locality" class="form-label">Locality</label>
                <input type="text" class="form-control @error('temporary_locality') is-invalid @enderror" id="temporary_locality" name="temporary_locality" placeholder="Locality" wire:model.live="temporary_locality">
                @error('temporary_locality') <small class="text-danger">{{$message}}</small> @enderror
            </div>

        </div>
    </div>
    @include('livewire.user.kyc-detail-button')
</div>

