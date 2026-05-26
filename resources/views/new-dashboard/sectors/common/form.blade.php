<div class="card mb-4">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-sm-6">
              <label class="form-label" for="name">Sector Name <small class="text-danger">*</small></label>
              {!! Form::text('name', null, [
                'class' => 'form-control',
                'id' => 'name',
                'placeholder' => 'Sector Name',
                ]) !!}
              {{-- <input type="text" id="name" name="name" class="form-control  @error('name') is-invalid @enderror" placeholder="Sector Name"> --}}
              @error('name') <small class="text-danger">{{$message}} </small> @enderror
            </div>
            <div class="col-sm-6">
              <label class="form-label" for="icon">Icon Class</label>
              {!! Form::text('icon', null, [
                'class' => 'form-control',
                'id' => 'icon',
                'placeholder' => 'Example: bx bx-radio-circle-marked',
                ]) !!}
              {{-- <input type="text" id="icon" name="icon" class="form-control" placeholder="Example: bx bx-radio-circle-marked"> --}}
            </div>
            <div class="col-12 d-flex justify-content-end">
              <button class="btn btn-primary btn-next">
                <span class="align-middle d-sm-inline-block d-none me-sm-1">Submit</span>
              </button>
            </div>
          </div>
    </div>
  </div>
