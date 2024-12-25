<section class="Financial-report main-section pt-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="main-heading"> @lang('Product report') {{ $product ? $product->name : '' }}</h4>

            <a href="{{ route('products') }} " class="btn-main-sm">@lang('site.Back')</a>
        </div>
        <div class="Financial-report-content bg-white p-4 rounded-3 shadow">
            {{-- <div class="status-info d-flex align-items-center justify-content-start mb-3">

                @if (request('product'))
                <div class="status bg-info rounded-3 text-white py-2 px-3 ms-2"> المنتج:
                    {{ $products->name }}</div>
                @endif

                @if (request('product'))
                <div class="status bg-info rounded-3 text-white py-2 px-3"> عدد الفواتير:
                    {{ $products->count() }}</div>
                @endif
            </div> --}}
            <div class="about-finan-report d-flex flex-wrap align-items-start justify-content-between mb-3">
                <div
                    class="right-holder d-flex flex-wrap flex-sm-nowrap flex-sm-row align-items-center mb-2 mb-lg-0 justify-content-center">
                    <div class="duration-from d-flex align-items-center justify-content-center me-2">
                        <label for="date-from" class="fild-name ms-2">{{ __('site.From') }}</label>
                        <input type="date" class="date-from form-control mb-2 mb-sm-0" id="date-from"
                            wire:model="from" />
                    </div>
                    <div class="duration-to d-flex align-items-center justify-content-center me-2">
                        <label for="date-to" class="fild-name ms-2">{{ __('site.To') }}</label>
                        <input type="date" class="date-to form-control mb-3 mb-sm-0" id="date-to"
                            wire:model="to" />
                    </div>
                    <button type="button" class="btn btn-success w-75 mb-2 mb-sm-0 me-sm-2 me-0 w-50">
                        <span class="ms-1">{{ __('site.Show') }}</span>
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
                <div class="left-holder d-flex justify-content-center justify-content-sm-start m-auto m-sm-0">
                    <button class="btn btn-sm btn-outline-warning ms-2" id="btn-prt-content">
                        <i class="fa-solid fa-print"></i>
                        <span>{{ __('site.Print') }}</span>
                    </button>
                    <button class="btn btn-sm btn-outline-info" id="export-btn">
                        <i class="fa-solid fa-file-excel"></i>
                        <span>{{ __('site.Excel_export') }}</span>
                    </button>
                </div>
            </div>
            <div id="prt-content">
                <x-header-invoice></x-header-invoice>
                <div class="table-responsive">
                    <table class="table main-table" id="data-table">
                        <thead>
                            <tr>
                                <th>{{ __('site.Product_name') }}</th>
                                <th>{{ __('Opening balance') }}</th>
                                <th>{{ __('Current Balance') }}</th>
                                <th>{{ __('site.Purchasing_price') }}</th>
                                <th>{{ __('site.selling_price') }}</th>
                                <th>{{ __('site.Profit') }}</th>
                                <th>{{ __('Sales times') }}</th>
                                <th>{{ __('site.cash_Money') }}</th>
                                <th>{{ __('site.Network_pay') }}</th>
                                <th>{{ __('site.paid') }}</th>
                                <th>{{ __('site.Unpaid') }}</th>
                                @if (setting('active_tax'))
                                    <th>{{ __('site.Tax') }}</th>
                                @endif
                                <th>{{ __('site.Total') }}</th>
                            </tr>
                        </thead>
                        @if ($product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->opening_quantity }}</td>
                                <td>{{ $product->quantity }}</td>

                                <td>{{ $product->price }}</td>
                                <td>{{ $product->saleprice }}</td>
                                <td>{{ $invoices->sum('card') + $invoices->sum('cash') }}</td>
                                <td>{{ $product->invoices->sum('quantity') }}</td>
                                <td>{{ $invoices->sum('cash') }}</td>
                                <td>{{ $invoices->sum('card') }}</td>
                                <td>{{ $invoices->where('status', 'paid')->sum('total') }}</td>
                                <td>{{ $invoices->where('status', 'unpaid')->sum('total') }}</td>
                                @if (setting('active_tax'))
                                    <td>{{ $invoices->sum('tax') }}</td>
                                @endif
                                <td>{{ $invoices->sum('total') }}</td>
                            </tr>
                        @else
                            <tr>
                                <td>يرجى تحديد منتج</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
