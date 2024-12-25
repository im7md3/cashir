<div class="modal fade" id="delete{{ $invoice->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('site.Delete_an_invoice?') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ __('site.Are_you_sure_to_delete_an_invoice?') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('site.Close') }}</button>
                <button wire:click='delete({{ $invoice->id }})' type="button" class="btn btn-primary" data-bs-dismiss="modal">{{ __('site.yes') }}</button>
            </div>
        </div>
    </div>
</div>
