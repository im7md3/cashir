<section class="main-section ">
    <!-- @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-warning">{{$error}}</div>
    @endforeach
    @endif -->
    <x-alert></x-alert>
    <div class="container">
        <h4 class="main-heading mb-4">{{ __('site.add_offer') }}</h4>
        <div class="section-content bg-white p-4 shadow rounded-3">
            <div class="mb-4">
                <button class="btn trans-btn btn-sm px-5" wire:click='$set("screen","index")'>{{ __('site.offers') }}</button>
            </div>
            <div class="d-flex flex-column flex-xl-row">
                <div class="collect-info d-flex flex-column ms-lg-2">
                    <label for="" class="small-label mb-2">{{ __('site.start') }}</label>
                    <input type="date" wire:model.defer="start" id="" class="form-control mb-2 mb-lg-0">
                </div>
                <div class="collect-info d-flex flex-column ms-lg-2">
                    <label for="" class="small-label mb-2">{{ __('site.end') }}</label>
                    <input type="date" wire:model.defer="end" id="" class="form-control mb-2 mb-lg-0">
                </div>
                <div class="collect-info d-flex flex-column ms-lg-2">
                    <label for="" class="small-label mb-2">{{ __('site.product') }}</label>
                    <select wire:model.defer="product_id" id="" class="main-select mb-2 mb-lg-0 w-100">
                        <option value="">{{ __('site.Products') }}</option>
                        @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                        <option value="all">كل المنتجات</option>
                    </select>
                </div>
                <div class="collect-info flex-column ms-lg-2">
                    <label for="" class="small-label mb-2">{{ __('site.Show Rate') }}</label>
                    <select wire:model.defer="show" id="" class="main-select mb-2 mb-lg-0 w-100">
                        <option value="">{{ __('site.Show Rate') }}</option>
                        <option value="1">{{ __('site.yes') }}</option>
                        <option value="0">{{ __('site.no') }}</option>
                    </select>
                </div>

                <div class="collect-info flex-column ms-lg-2">
                    <label for="" class="small-label mb-2">{{ __('site.rate') }}</label>
                    <input type="number" min="0" wire:model.defer="rate" id="" class="form-control mb-2 mb-lg-0">
                </div>

                <div class="btn-holder d-flex align-items-end mt-2 mt-lg-0 mb-lg-1">
                    <button class="btn btn-success btn-sm px-5" wire:click='save'>{{ __('site.Save') }}</button>
                </div>
            </div>
        </div>
    </div>
</section>
