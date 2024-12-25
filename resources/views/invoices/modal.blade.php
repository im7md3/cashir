<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $name?'تعديل':'إضافة' }} {{ __('site.product') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row row-gap-24">
                    <div class=" col-sm-4">
                        <label class="small-label" for="">{{ __('site.Name') }}</label>
                        <input class="form-control" type="text" wire:model.defer='name' placeholder="">
                    </div>
                    <div class=" col-sm-4">
                        <label class="small-label" for="">{{ __('site.Departments') }}</label>
                        <select class="form-control" wire:model.defer='department_id'>
                            <option value="">{{ __('site.Choose_Department') }}</option>
                            @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class=" col-sm-4">
                        <label class="small-label" for="">{{ __('site.price') }}</label>
                        <input class="form-control" type="number" min="0"   wire:model.defer='price' placeholder="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('site.Close') }}</button>
                <button wire:click='submit' class="btn btn-primary" data-bs-dismiss="modal">{{ __('site.Save') }}</button>
            </div>
        </div>
    </div>
</div>
