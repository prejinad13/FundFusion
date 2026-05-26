@extends('new-dashboard.master')

@section('content')

<h4 class="text-right py-3 mb-4">
    My Account
</h4>


<div class="card">
    <div class="card-body">
        <h4 class="card-title">Profile Update</h4>
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <input type="hidden" class="form-control" id="name" name="name" placeholder="Name" value="{{ auth()->user()->name }}">
                <div class="col-md-12">
                    <label for="email" class="form-label">Email <small class="text-danger">*</small></label>
                    <input type="hidden" class="form-control" id="email" name="email" placeholder="Email" value="{{ auth()->user()->email }}">
                    <input type="email" class="form-control" placeholder="Email" value="{{ auth()->user()->email }}" disabled style="cursor: no-drop">
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6">
                  <div class="form-password-toggle">
                    <label for="password" class="text-black"> Password</label>
                    <div class="input-group input-group-merge">
                      <input type="password" name="password" id="multicol-password" class="form-control" placeholder="············" aria-describedby="multicol-password2">
                      <span class="input-group-text cursor-pointer" id="multicol-password2"><i class="bx bx-hide"></i></span>
                    </div>
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-password-toggle">
                    <label for="password_confirmation" class="text-black"> Confirm Password </label>
                    <div class="input-group input-group-merge">
                      <input type="password_confirmation" name="password_confirmation" id="multicol-confirm-password" class="form-control" placeholder="············" aria-describedby="multicol-confirm-password2">
                      <span class="input-group-text cursor-pointer" id="multicol-confirm-password2"><i class="bx bx-hide"></i></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="pt-4 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
              </div>
        </form>
    </div>
</div>
@endsection

