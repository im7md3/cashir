<div class="modal fade" id="edit{{ $purchase->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('site.edit') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row row-gap-24">
                    <div class=" col-sm-4">
                        <label class="small-label" for="">{{ __('site.Name') }}</label>
                        <input class="form-control" type="text" wire:model.defer='name' placeholder="">
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="row row-gap-24">
                    <div class=" col-sm-4">
                        <label class="small-label" for="">{{ __('site.Amount') }}</label>
                        <input class="form-control" type="number" min="0" wire:model.defer='amount' placeholder="">
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="row row-gap-24">
                    <div class=" col-sm-4">
                        <label class="small-label" for="">{{ __('site.tax_status') }}</label>
                        <input  type="checkbox" wire:model.defer='status' >
                        {{-- {{ var_export($status) }} --}}
                    </div>
                </div>
            </div>
            <input type="hidden" wire:model="id" class="form-control">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('site.Close') }}</button>
                <button wire:click='update("{{ $purchase->id }}")'  class="btn btn-primary" data-bs-dismiss="modal">{{ __('site.edit') }}</button>
            </div>
        </div>
    </div>
</div>
