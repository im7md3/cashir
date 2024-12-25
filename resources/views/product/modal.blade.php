<button class="btn btn-primary btn-sm" wire:click='back'>@lang('Back')</button>
<div class="row row-gap-24">

    @if (!auth()->user()->branch_id && setting('is_branches_active'))
        <div class=" col-sm-6">
            <label class="small-label" for="">{{ __('site.branch_id') }}</label>
            <select class="form-control" wire:model.defer='branch_id' id="branch_id">
                <option value="">{{ __('site.branch_id') }}</option>
                @foreach ($branches as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                @endforeach
            </select>
        </div>
    @endif

    <div class=" col-sm-6">
        <label class="small-label" for="">{{ __('site.Name') }}</label>
        <input class="form-control" type="text" wire:model.defer='name' id="name" placeholder="">
    </div>

    <div class=" col-sm-6">
        <label class="small-label" for="">@lang('Barcode')
            <i class="fa-solid fa-barcode fs-6"></i>
        </label>
        <input class="form-control" type="text" wire:model.defer='barcode' id="barcode" placeholder="">
    </div>
    <div class=" col-sm-6">
        <label class="small-label" for="">{{ __('site.Departments') }}</label>
        <select class="form-control" wire:model.defer='department_id' id="department_id">
            <option value="">{{ __('site.Choose_Department') }}</option>
            @foreach ($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
        </select>
    </div>
    <div class=" col-sm-6">
        <label class="small-label" for="">@lang('Unity')</label>
        <select class="form-control" wire:model.defer='unit_id' id="unit_id">
            <option value="">@lang('Select unit')</option>
            @foreach ($units as $unit)
                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
            @endforeach
        </select>
    </div>


    <div class="col-sm-6">
        <div class="form-group">
            <label>{{ __('site.Product_picture') }}</label>
            <input class="form-control img" type="file" accept="image/*" wire:model.defer='cover' id="cover">
            @if ($obj?->cover)
                <img src="{{ display_file($obj->cover) }}" alt="" class="img-thumbnail mt-1 img-preview"
                    width="200px">
            @else
                <img src="{{ asset('img/no-image.jpg') }}" alt="" class="img-thumbnail mt-1 img-preview"
                    width="200px">
            @endif
            @error('cover')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>
    </div>

    <div class="col-sm-6">
        <div class="d-flex gap-3">
            <div class=" ">
                <label class="small-label d-block" for="">{{ __('site.Purchasing_price') }}</label>
                <input class="form-control" type="number" min="0" wire:model='price' id="price"
                    placeholder="">
            </div>
            <div class=" ">
                <label class="small-label d-block" for="">{{ __('site.selling_price') }}</label>
                <input class="form-control" type="number" min="0" wire:model='saleprice' id="saleprice"
                    placeholder="">
            </div>
        </div>
        <small class="alert alert-primary mb-0 p-2 mt-3  d-block" role="alert">
            {{ __('site.In_the_event_of_selling_in_quantity,_activation_will_be_required') }}
        </small>
        <div class="d-flex align-items-end gap-3">
            @if (!$obj)
                <div class="inp-holder">
                    <label class="small-label d-block " for="">{{ __('site.opening_quantity') }}</label>
                    <input class="form-control w-110px" type="number" wire:model='opening_quantity'
                        id="opening_quantity" placeholder="{{ __('site.Enter_the_opening_quantity') }}" min="1">
                </div>
                <div class="inp-holder">
                    <label class="small-label d-block " for="">{{ __('site.Quantity_Available') }}</label>
                    <input class="form-control w-110px" type="number" wire:model='quantity' id="quantity"
                        placeholder="{{ __('site.Enter_the_optional_quantity') }}" min="1">
                </div>
            @endif
            <div class="inp-holder d-flex align-items-center gap-1">
                <label class="small-label d-block mb-0" for="">{{ __('site.Activate_quantity') }}</label>
                <input value="1" type="checkbox" id="allow_quantity" wire:model='allow_quantity'>
            </div>

        </div>

        <div class="d-flex mt-3 gap-3">
            <div class="inp-holder ">
                <label class="small-label d-block mb-0" for="">{{ __('site.is_has_end_date') }}</label>
                <input type="checkbox" id="has_end_date" wire:model.live='has_end_date'>
            </div>
            @if ($has_end_date)
                <div class="inp-holder">
                    <label class="small-label d-block " for="">{{ __('site.end_date') }}</label>
                    <input class="form-control" type="date" wire:model='end_date' id="end_date">
                </div>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <button wire:click='submit' class="btn btn-primary">{{ __('site.Save') }}</button>
    </div>
</div>
