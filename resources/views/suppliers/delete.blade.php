<div class="modal fade" id="delete{{ $client->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف مورد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               هل انت متاكد من حذف المورد
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('site.Close') }}</button>
                <button wire:click='delete({{ $client->id }})' type="button" class="btn btn-primary" data-bs-dismiss="modal">{{ __('site.yes') }}</button>
            </div>
        </div>
    </div>
</div>
