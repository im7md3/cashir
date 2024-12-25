<div>
    <x-messages></x-messages>
    <h4 class="main-heading">{{ __('site.Settings') }}</h4>

    <div class="box-content">
        <div class="mb-2">
            <label>تفعيل الفروع</label>
            <input wire:model.live="is_branches_active" type="checkbox">
        </div>
        @if($is_branches_active)
        <div class="mb-2">
            <label>عدد الفروع المسموح بها</label>
            <input class="form-control" wire:model="available_branches_count" min="0" type="number">
        </div>
        @endif
        <button class="btn btn-sm btn-success my-2" wire:click="submit">@lang('Save') </button>

    </div>
</div>
