@extends('new-dashboard.master')

@section('title'){{$_panel}}@endsection


@section('content')

<h4 class="text-right py-3 mb-4">
    {{$_panel}}
</h4>

@if (Auth::user()->account_type=='individual')
@livewire('user.kyc-detail')
@endif

@if (Auth::user()->account_type=='company')
@livewire('user.company-kyc-detail')
@endif

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Other Details</h4>
        <form action="{{ route('dashboard.users.update',Auth::user()->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                @if (Auth::user()->roles()->first()->name=='investor')
                <div class="col-md-12">
                    <label for="max_investment_amount" class="form-label">Investment Amount (Max)</label>
                    <input type="text" class="form-control @error('max_investment_amount') is-invalid @enderror" id="max_investment_amount" name="max_investment_amount" placeholder="Max. Investment Amount" oninput = "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')" value="{{Auth::user()->max_investment_amount ?? old('max_investment_amount')}}">
                    @error('max_investment_amount') <small class="text-danger">{{$message}} </small> @enderror
                </div>
                @endif

                <div class="col-md-12">
                    <label for="interest" class="form-label">Area of Interest</label>
                    <div class="position-relative">
                        @php
                            $selectedSectors=Auth::user()->sectors->pluck('id')->toArray();
                        @endphp
                    <select class="form-select select2" multiple id="interest" name="interest[]">
                        @foreach ($data['interests'] as $sector)
                        <option value="{{$sector->id}}" @if (in_array($sector->id, $selectedSectors)) selected @endif>{{Str::ucfirst($sector->name)}}</option>
                        @endforeach
                    </select>
                    </div>
                    @error('interest') <small class="text-danger">{{$message}} </small> @enderror
                </div>

                <div class="col-md-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter Your Short Description">{{Auth::user()->description??old('description')}}</textarea>
                    @error('description') <small class="text-danger">{{$message}} </small> @enderror
                </div>
              </div>
              <div class="pt-4 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
              </div>
        </form>
    </div>
</div>

@endsection

@section('js')
<script>
    $(document).ready(function() {
    $('.select2').select2({
        placeholder:'Select Interests',
        allowClear:true
    });
});
</script>
@endsection
