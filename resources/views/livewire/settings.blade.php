<div class="row">
    <x-messages></x-messages>
    <div class="alert alert-primary">يمكنك تفعيل الفروع التواصل معنا
        <br>
        لطلب تفعيل الفروع يمكنكم التواصل معنا والتفعيل <a href="tel:0506499275"
            class='text-decoration-underline'>0506499275</a>
    </div>
    <div class="col-md-12">
        <div
            class="bar-options d-flex flex-column flex-md-row align-md-items-center justify-content-between  gap-3 mb-3">
            <h4 class="main-heading mb-0">{{ __('site.Settings') }}</h4>
            <div class="btns-holder d-flex align-items-center justify-content-center flex-wrap gap-1 mx-auto">
                @if (auth()->user()->hasPermission('read_admins'))
                    <a href="{{ route('admins.index') }}" class="btn-main-sm">
                        {{ __('site.Employees') }}
                        <i class="fas fa-user-tie"></i>
                    </a>
                @endif
                @if (auth()->user()->hasPermission('read_departments'))
                    <!-- <a href="{{ route('departments.index') }}" class="btn-main-sm">
                        {{ __('site.Departments') }}
                        <i class="fab fa-buffer"></i>
                    </a> -->
                @endif
                @if (auth()->user()->hasPermission('read_branches'))
                    @if (setting('is_branches_active'))
                        <a href="{{ route('branches.index') }}" class="btn-main-sm">
                            {{ __('site.Branches') }}
                            <i class="fas fa-shop"></i>
                        </a>
                    @endif
                @endif
                @if (auth()->user()->hasPermission('read_offers'))
                    <a href="{{ route('offers') }}" class="btn-main-sm">
                        {{ __('Offers') }}
                        <i class="fas fa-bag-shopping"></i>
                    </a>
                @endif
                @if (auth()->user()->hasPermission('read_packages'))
                    @if (setting('active_bouquet'))
                        <a href="{{ route('packages') }}" class="btn-main-sm">
                            {{ __('site.Packages') }}
                            <i class="fas fa-cubes"></i>
                        </a>
                    @endif
                @endif
                @if (auth()->user()->hasPermission('read_payment_methods'))
                    <a href="{{ route('payment_methods') }}" class="btn-main-sm">
                        {{ __('Payment Methods') }}
                        <i class="fas fa-credit-card"></i>
                    </a>
                @endif
            </div>
        </div>
        <div class="box-content">
            <div class="row g-3">
                <div class="form-group col-md-3 mb-2 ">
                    <label class="small-label" for="website_name">{{ __('site.Business_Name') }}</label>
                    <input type="text" wire:model="website_name" id="website_name" class="form-control">
                </div>
                <div class="form-group col-md-3 mb-2 ">
                    <label class="small-label" for="tax_number">{{ __('site.Tax_number') }} <span
                            class='fw-bold text-danger fs-10px'>({{ __('site.It must consist of 15 numbers') }})</span></label>
                    <input type="number" min="0" wire:model="tax_no" id="tax_number" class="form-control">
                </div>
                <div class="form-group col-md-3 mb-2 ">
                    <label class="small-label" for="address">{{ __('site.Address') }}</label>
                    <input type="text" wire:model="address" id="address" class="form-control">
                </div>
                <div class="form-group col-md-3 mb-2 ">
                    <label class="small-label" for="building_number"> {{ __('site.Building_Number') }}</label>
                    <input type="text" wire:model="building_no" id="building_number" class="form-control">
                </div>
                <div class="form-group col-md-3 mb-2 ">
                    <label class="small-label" for="street">{{ __('site.Street') }}</label>
                    <input type="text" wire:model="street" id="street" class="form-control">
                </div>
                <div class="form-group col-md-3 mb-2 ">
                    <label class="small-label" for="phone">{{ __('site.Phone') }}</label>
                    <input type="text" wire:model="phone" id="phone" class="form-control">
                </div>
                <div class="form-group col-md-3 mb-2 ">
                    <label class="small-label" for="capital">{{ __('site.Capital') }}</label>
                    <input type="number" min="0" wire:model="capital" id="capital" class="form-control">
                </div>
                <div class="form-group col-md-3 mb-2 ">
                    <label class="small-label" for="phone">{{ __('site.Tax') }}</label>
                    <input type="number" min="0" wire:model="tax" id="phone" class="form-control">
                </div>
                <div class="form-group col-md-3 mb-2 ">
                    <label class="small-label" for="logo_file">{{ __('site.Logo_Image') }}</label>
                    <input type="file" wire:model="logo_img" id="logo_file" class="form-control">
                    @if ($logo_img)
                        <img src="{{ $logo_img->temporaryUrl() }}" width='100' alt="">
                    @else
                        <img src="{{ display_file(setting('logo_img')) }}" width='100' alt="">
                    @endif
                </div>

                <div class="form-group col-md-3 mb-2 ">
                    <label class="small-label" for="fav_icon_file">{{ __('site.Browser_Icon') }}</label>
                    <input type="file" wire:model="icon_img" id="fav_icon_file" class="form-control">
                    @if ($icon_img)
                        <img src="{{ $icon_img->temporaryUrl() }}" width='100' alt="">
                    @else
                        <img src="{{ display_file(setting('icon_img')) }}" width='100' alt="">
                    @endif
                </div>
                <div class="col-12 m-0">
                    <hr class="m-0 border-0 bg-transparent">
                </div>
                <div class="col-12 col-md-4 form-group mb-2">
                    <div class="inp-holder">
                        <div class="d-flex flex-column align-items-start">
                            <label class="small-label" for="activate_taxes">{{ __('site.Tax_Activation') }} <small
                                    class="text-danger fs-10px">@lang('site.The tax is calculated automatically')</small></label>
                            <input type="checkbox" {{ $price_include_tax ? 'disabled' : '' }}
                                wire:model="active_tax">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 form-group mb-2">
                    <div class="inp-holder">
                        <div class="d-flex flex-column align-items-start">
                            <label
                                class="small-label"for="acivate_categories">تفعيل الأقسام في شاشة البيع</label>
                            <input type="checkbox" wire:model="acivate_categories">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 form-group mb-2">
                    <div class="inp-holder">
                        <div class="d-flex flex-column align-items-start">
                            <label
                                class="small-label"for="active_invoice_print">{{ __('site.Preview invoice after addition') }}</label>
                            <input type="checkbox" wire:model="active_invoice_print">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 form-group mb-2">
                    <div class="inp-holder">
                        <div class="d-flex flex-column align-items-start">
                            <label class="small-label"
                                for="active_free_invoice">{{ __('site.Free invoices') }}</label>
                            <input type="checkbox" wire:model="active_free_invoice">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 form-group mb-2">
                    <div class="inp-holder">
                        <div class="d-flex flex-column align-items-start">
                            <label class="small-label" for="">{{ __('site.Activate the package') }}</label>
                            <input type="checkbox" wire:model="active_bouquet">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 form-group mb-2">
                    <div class="inp-holder">
                        <div class="d-flex flex-column align-items-start">
                            <label class="small-label" for="">{{ __('site.The price includes tax') }}<small
                                    class="text-danger fs-10px">{{ __('site.The tax amount will be calculated from the total product amount') }}</small></label>
                            <input type="checkbox" {{ $active_tax ? 'disabled' : '' }}
                                wire:model="price_include_tax">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 form-group mb-2">
                    <div class="inp-holder">
                        <div class="d-flex flex-column align-items-start">
                            <label class="small-label"
                                for="">{{ __('Activate the package balance') }}</label>
                            <input type="checkbox" wire:model="activate_package_balance">
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 form-group mb-2">
                    <div class="inp-holder">
                        <label class="small-label"
                            for="amount_free_invoice">{{ __('site.Free bill amount') }}</label>
                        <input type="number" class="form-control" min="0" wire:model="amount_free_invoice">
                    </div>
                </div>
                <div class="col-12 col-md-4 form-group mb-2">
                    <div class="inp-holder">
                        <label class="small-label" for="default_currency">{{ __('site.Virtual currency') }}</label>
                        <select wire:model='default_currency' id="default_currency" class="form-check form-select">
                            <option value="">{{ __('site.Select currency') }}</option>
                            @php
                                $currencies = [
                                    'USD',
                                    'EUR',
                                    'JPY',
                                    'GBP',
                                    'AUD',
                                    'CAD',
                                    'CHF',
                                    'CNY',
                                    'SEK',
                                    'NZD',
                                    'MXN',
                                    'SGD',
                                    'HKD',
                                    'NOK',
                                    'KRW',
                                    'TRY',
                                    'INR',
                                    'BRL',
                                    'ZAR',
                                    'RUB',
                                    'SAR',
                                    'EGP',
                                ];
                            @endphp
                            @foreach ($currencies as $currency)
                                <option value="{{ $currency }}">{{ __($currency) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-12 col-md-4 form-group mb-2">
                    <div class="inp-holder">
                        <label class="small-label"
                            for="default_payment_method">{{ __('Default payment method') }}</label>
                        <select wire:model='default_payment_method' id="default_payment_method"
                            class="form-check form-select">
                            <option value="">{{ __('Select') }}</option>
                            <option value="cash">{{ __('Cash') }}</option>
                            <option value="not_cash">{{ __('Not cash') }}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-3 mb-2 ">
                    <label class="small-label" for="message_invoice">رسالة الفاتوره</label>
                    <input type="text" min="0" wire:model="message_invoice" id="message_invoice"
                        class="form-control">
                </div>

            </div>
            <button wire:click="update"
                class="btn btn-primary mt-3 mx-auto btn-sm px-4 sw-100">{{ __('site.Save') }}</button>
        </div>
    </div>
