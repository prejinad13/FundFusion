@if ($showModal==true)
<div class="modal fade show" id="enableOTP" tabindex="-1" style="display: block;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
      <div class="modal-content p-3 p-md-5">
        <div class="modal-body">
          <button type="button" wire:click="closeModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center mb-4">
            <h3 class="mb-2">Reject KYC Verification</h3>
          <p>Please enter the reason to reject KYC Verification.</p>
          </div>
          <div>
            <label for="kyc_remarks" class="form-label">Remark <small class="text-danger">*</small></label>
            <textarea class="form-control" wire:model="kyc_remarks" name="kyc_remarks" id="kyc_remarks" rows="3" spellcheck="false" placeholder="Remarks for KYC Rejection."></textarea>
            @error('kyc_remarks')  <small class="text-danger"> {{$message}}  </small> @enderror
          </div>
            <div class="col-12 mt-3">
              <button type="submit" class="btn btn-primary me-sm-3 me-1 w-100" wire:click="kycRemarkSubmit">Submit</button>
            </div>
        </div>
      </div>
    </div>
</div>

<div class="modal-backdrop fade show"></div>
@endif
