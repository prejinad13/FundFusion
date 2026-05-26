<div class="card mb-4">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-sm-12 mb-2">
                        <label class="form-label" for="name">Idea Name <small class="text-danger">*</small></label>
                        {!! Form::text('name', null, [
                          'class' => 'form-control',
                          'id' => 'name',
                          'placeholder' => 'Idea Name',
                          ]) !!}
                        @error('name') <small class="text-danger">{{$message}} </small> @enderror
                      </div>
                      <div class="col-sm-7">
                          <label class="form-label" for="video_link">Explanation Video <small class="text-danger">*</small></label>
                          {!! Form::url('video_link', null, [
                            'class' => 'form-control',
                            'id' => 'video_link',
                            'placeholder' => 'Explanatory Video Link',
                            ]) !!}
                          @error('video_link') <small class="text-danger">{{$message}} </small> @enderror
                      </div>
                      <div class="col-sm-5">
                        @php
                            $team_sizes=['Single'=>'Single','Less than 5'=>'Less than 5','5 to 10'=>'5 to 10','Greater than 10'=>'Greater than 10'];
                        @endphp
                        <label class="form-label" for="team_size">Team Size <small class="text-danger">*</small></label>
                        {!! Form::select('team_size',$team_sizes, null, [
                          'class' => 'form-select',
                          'id' => 'team_size',
                          'placeholder' => 'Team Size',
                          ]) !!}
                        @error('team_size') <small class="text-danger">{{$message}} </small> @enderror
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <label for="investment_sectors" class="form-label">Investment Sector <small class="text-danger">*</small></label>
                    <div class="position-relative">
                        @if(isset($data['data']))
                            @php
                            $selectedSectors=$data['data']->sectors->pluck('id')->toArray();
                            @endphp
                            @else
                            @php
                            $selectedSectors=null;
                            @endphp
                        @endisset

                        {!! Form::select('investment_sectors[]',$data['investment_sectors']->pluck('name','id')->toArray(), $selectedSectors, [
                            'class' => 'form-select select2',
                            'id' => 'investment_sectors',
                            'placeholder' => 'Team Size',
                            'multiple',
                            ]) !!}
                    {{-- <select class="" multiple id="investment_sectors" name="investment_sectors[]">
                        @foreach ($data['investment_sectors'] as $sector)
                        <option value="{{$sector->id}}" @if (in_array($sector->id, $selectedSectors)) selected @endif>{{Str::ucfirst($sector->name)}}</option>
                        @endforeach
                    </select> --}}
                    </div>
                    @error('investment_sectors') <small class="text-danger">{{$message}} </small> @enderror
                </div>
            </div>
            <div class="col-md-6">
                @livewire('idea.roi',[
                    'required_investment_amount'=>$data['data']->required_investment_amount??old('required_investment_amount'),
                    'return_on_investment'=>$data['data']->return_on_investment??old('return_on_investment'),
                    'estimated_return'=>$data['data']->estimated_return??old('estimated_return'),
                    ])
            </div>

            <div class="col-md-12">
                <label class="form-label" for="short_description">Short Description <small class="text-danger">*</small></label>
                {!! Form::textarea('short_description', null, [
                    'class' => 'form-control',
                    'id' => 'short_description',
                    'placeholder' => 'Write a short brief about your idea',
                    'rows'=>'3'
                    ]) !!}
                @error('short_description') <small class="text-danger">{{$message}} </small> @enderror
            </div>

            <div class="col-md-12">
                <label class="form-label" for="long_description">Main Description <small class="text-danger">*</small></label>
                {!! Form::textarea('long_description', null, [
                    'class' => 'form-control',
                    'id' => 'long_description',
                    'placeholder' => 'Write your idea explanation in details.',
                    ]) !!}
                @error('long_description') <small class="text-danger">{{$message}} </small> @enderror
            </div>


            <div class="col-12 d-flex justify-content-end">
              <button class="btn btn-primary btn-next">
                <span class="align-middle d-sm-inline-block d-none me-sm-1">Submit</span>
              </button>
            </div>
          </div>
    </div>
  </div>
