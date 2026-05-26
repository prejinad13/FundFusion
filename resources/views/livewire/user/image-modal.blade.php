@if ($showImageModal==true)
<div class="modal fade show" id="enableOTP" tabindex="-1" style="display: block;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
      <div class="modal-content p-3 p-md-5">
        <div class="modal-body">
          <button type="button" wire:click="closeImageModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center mb-4">
            <h3 class="mb-2">{{$previewImageName}}</h3>
            <div class="easyzoom easyzoom--overlay is-ready">
                <a href={{"$previewImageUrl"}} target="_blank">
                    <img class="img-fluid" src="{{$previewImageUrl}}">
                </a>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="modal-backdrop fade show"></div>
@endif
