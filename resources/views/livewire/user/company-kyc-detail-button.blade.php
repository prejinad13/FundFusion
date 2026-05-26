<div class="card-body">
    <div class="d-flex justify-content-end">
        @if ($activeTab=='company_detail_tab')
            <button type="button" class="btn btn-label-secondary me-2" disabled><i class="bx bx-chevron-left bx-sm ms-sm-n2"></i> Previous</button>
            <button type="button" class="btn btn-primary" wire:click="next">Next <i class="bx bx-chevron-right bx-sm me-sm-n2"></i></button>
        @elseif ($activeTab=='company_document_tab')
        <button type="button" class="btn btn-label-secondary me-2" wire:click="previous"><i class="bx bx-chevron-left bx-sm ms-sm-n2"></i> Previous</button>
        @if (Auth::user()->kyc_status!='processing' && Auth::user()->kyc_status!='verified' &&Auth::user()->roles()->first()->name!='superadmin')
        <button type="button" class="btn btn-success" wire:click="submit">Submit</button>
        @endif
        @else
        <button type="button" class="btn btn-label-secondary me-2" wire:click="previous"><i class="bx bx-chevron-left bx-sm ms-sm-n2"></i> Previous</button>
        <button type="button" class="btn btn-primary" wire:click="next">Next <i class="bx bx-chevron-right bx-sm me-sm-n2"></i></button>
        @endif
    </div>
</div>
