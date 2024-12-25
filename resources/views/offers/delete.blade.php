<div class="modal fade" id="delete_agent{{ $offer->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                {{ __('site.Are_you_sure_to_delete?') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger"
                    data-bs-dismiss="modal">{{ __('site.Back') }}</button>
                <button class="btn btn-sm  btn-success" data-bs-dismiss="modal"
                    wire:click='delete({{ $offer }})'>{{ __('site.yes') }}</button>
            </div>

        </div>

    </div>
</div>
