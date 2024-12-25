<section class="">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-3">
            <h4 class="main-heading mb-0">{{ __('sales report') }}</h4>
            <a href="{{ route('accounting') }}" class="btn btn-secondary btn-sm px-3 w-fit d-block ms-auto">
                <i class="fas fa-angle-left"></i>
            </a>
        </div>
        <div class="blocks-data">
            <div class="row g-3 mb-4">
                <div class="col-md-6 col-lg-3">
                    <div class="states-box box-1">
                        <div class="data-icon">
                            <span class="num-1">{{ App\Models\Invoice::where('status', 'paid')->count() }}</span>
                            <i class="fa-solid fa-money-bill-transfer icon-1"></i>
                        </div>
                        <div class="text">
                            <a href="#">{{ __('paid invoices') }}</a>
                        </div>
                        <div class="prog-box">
                            <div class="prog">
                                <span class="prog-1"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="states-box">
                        <div class="data-icon">
                            <span class="num-2">{{ App\Models\Invoice::where('status', 'unpaid')->count() }}</span>
                            <i class="fa-solid fa-money-bill-trend-up icon-2"></i>
                        </div>
                        <div class="text">
                            <a href="#">{{ __('unpaid invoices') }}</a>
                        </div>
                        <div class="prog-box">
                            <div class="prog">
                                <span class="prog-2"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="Financial-report-content bg-white p-4 rounded-2 shadow">
            <div class="about-finan-report d-flex flex-wrap align-items-start justify-content-between">
                <form action=""
                    class="right-holder d-flex flex-wrap flex-sm-nowrap flex-sm-row align-items-center mb-2 mb-lg-0 justify-content-center">
                    <div class="duration-from d-flex align-items-center justify-content-center me-2">
                        <label for="date-from" class="fild-name ms-2">{{ __('From') }}</label>
                        <input type="date" class="date-from form-control mb-2 mb-sm-0" id="date-from"
                            wire:model="from" />
                    </div>
                    <div class="duration-to d-flex align-items-center justify-content-center me-2">
                        <label for="date-to" class="fild-name ms-2">{{ __('To') }}</label>
                        <input type="date" class="date-to form-control mb-3 mb-sm-0" id="date-to"
                            wire:model="to" />
                    </div>
                    <button type="button" class="sec-btn-gre w-75 mb-2 mb-sm-0 me-sm-2 me-0 w-50">
                        {{ __('Show') }}
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </form>
                <div class="left-holder d-flex justify-content-center justify-content-sm-start m-auto m-sm-0">
                    <button class="btn btn-sm btn-outline-warning ms-2" id="btn-prt-content">
                        <i class="fa-solid fa-print"></i>
                        {{ __('Print') }}
                    </button>
                    <button class="btn btn-sm btn-outline-info" id="export-btn">
                        <i class="fa-solid fa-file-excel"></i>
                        {{ __('Export') }}
                        Excel
                    </button>
                </div>
            </div>
            <div id="prt-content" class="table-print">
                <x-header-invoice></x-header-invoice>
                <div class="table-responsive mt-3 w-50 sw-100">
                    <table class="table main-table" id="data-table">
                        <thead>
                            <tr>
                                <th class="text-center">{{ __('department') }}</th>
                                <th>{{ __('amount') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td class="text-center">{{ __('site.Total_bills_paid') }}</td>
                                <td>{{ $invoices->where('status', 'paid')->sum('total') }}</td>
                            </tr>

                            <tr>
                                <td class="text-center">{{ __('site.Total_unpaid_bills') }}</td>
                                <td>{{ $invoices->where('status', 'unpaid')->sum('total') }}</td>
                            </tr>
                            @if (setting('active_tax'))
                                <tr>
                                    <td class="text-center">{{ __('site.Total_Tax') }}</td>
                                    <td>{{ $invoices->sum('tax') }}</td>
                                </tr>
                            @endif
                            @foreach ($payment_methods as $payment_method)
                                <tr>
                                    <td class="text-center">{{ __('site.Total_bills_paid') }} -
                                        {{ $payment_method->name }}</td>
                                    <td>
                                        {{ $payment_method->payment_transactions()->whereNotNull('invoice_id')->where(function ($query) use ($from, $to) {
                                                if ($from && $to) {
                                                    $query->whereBetween('created_at', [$from, $to]);
                                                } elseif ($from) {
                                                    $query->where('created_at', '>=', $from);
                                                } elseif ($to) {
                                                    $query->where('created_at', '<=', $to);
                                                } else {
                                                    $query;
                                                }
                                            })->where('type', 'in')->sum('amount') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
