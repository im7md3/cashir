<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $name ? __('Edit') : __('Add') }}
                    {{ __('site.department') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row row-gap-24">
                    <div class=" col-sm-12">
                        <label class="small-label" for="">{{ __('site.Name') }}</label>
                        <input class="form-control" type="text" wire:model.defer='name' placeholder="">
                    </div>
                    <div class=" col-sm-12">
                        <label class="small-label" for="">{{ __('site.Sub_Of') }}</label>
                        <select class="form-control" wire:model.defer='parent'>
                            <option value="">{{ __('site.choose') }}</option>
                            @foreach ($allCategories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                    @if ($category->parent)
                                        - {{ __('site.Sub_Of') }} : {{ $category->main?->name }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
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
