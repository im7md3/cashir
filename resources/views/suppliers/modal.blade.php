<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $suppliers ? __('Edit') : __('Add') }} @lang('Supplier')
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row row-gap-24">
                    <div class=" col-sm-12">
                        <label class="small-label" for="">{{ __('site.Name') }}</label>
                        <input class="form-control" type="text" wire:model.defer='name' placeholder="">
                    </div>
                    <div class=" col-sm-12">
                        <label class="small-label" for="">{{ __('site.Phone') }}</label>
                        <input class="form-control" type="text" wire:model.defer='phone' placeholder="">
                    </div>
                    <div class=" col-sm-12">
                        <label class="small-label" for="">@lang('street')</label>
                        <input class="form-control" type="text" wire:model.defer='strret' placeholder="">
                    </div>
                    <div class=" col-sm-12">
                        <label class="small-label" for="">@lang('Company')</label>
                        <input class="form-control" type="text" wire:model.defer='company' placeholder="">
                    </div>
                    @if (setting('active_tax'))
                        <div class=" col-sm-12">
                            <label class="small-label" for="">@lang('Tax number')</label>
                            <input class="form-control" type="text" wire:model.defer='tax_number' placeholder="">
                        </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('site.Close') }}</button>
                <button wire:click='submit' class="btn btn-primary"
                    data-bs-dismiss="modal">{{ __('site.Save') }}</button>
            </div>
        </div>
    </div>
</div>
