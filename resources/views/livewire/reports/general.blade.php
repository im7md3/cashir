<section>
    <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-3">
        <h4 class="main-heading mb-0">{{ __('site.Reports') }}</h4>
        <a href="{{ route('accounting') }}" class="btn btn-secondary btn-sm px-3 w-fit d-block ms-auto">
            <i class="fas fa-angle-left"></i>
        </a>
    </div>

    <div class="Financial-report-content box-content">
        <div class="d-flex flex-wrap justify-content-between align-items-end mb-3 gap-3">
            <div class="form-group mb-2 mb-md-0 gap-3">
                <div class="row mt-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="small-label mb-2">{{ __('site.From') }}</label>
                            <input type="date" wire:model="from" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="small-label mb-2">{{ __('site.To') }}</label>
                            <input type="date" wire:model="to" class="form-control">
                        </div>
                    </div>

                    @if (!auth()->user()->branch_id && setting('is_branches_active'))
                        <div class="col-md-4">
                            <select wire:model="branch_id" class="main-select">
                                <option value="">{{ __('site.branch_id') }}</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                </div>

            </div>

            <div class="about-finan-report d-flex flex-wrap align-items-start justify-content-between ">
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
        </div>
        <div id="prt-content">
            <x-header-invoice></x-header-invoice>
            <div class="table-responsive">
                <table class="table main-table table-print" id="data-table">
                    <thead>
                        <tr>
                            <th colspan="2" class="text-center">{{ __('site.Department') }}</th>
                            <th colspan="2">{{ __('site.Quantity') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2" class="text-center">{{ __('site.Total_bills_paid') }}</td>
                            <td colspan="2">{{ $invoices->where('status', 'paid')->sum('total') }}</td>
                        </tr>
                        @foreach ($payment_methods as $payment_method)
                            <tr>
                                <td colspan="2" class="text-center">{{ __('site.Total_bills_paid') }} -
                                    {{ $payment_method->name }}
                                </td>
                                <td colspan="2">
                                    {{ $payment_method->payment_transactions()->whereNotNull('invoice_id')->where(function ($query) use ($from, $to, $branch_id) {
                                            if ($branch_id) {
                                                $query->where('branch_id', $branch_id);
                                            }
                                            if ($from && $to) {
                                                $query->whereBetween('created_at', [$from, $to]);
                                            } elseif ($from) {
                                                $query->where('created_at', '>=', $from);
                                            } elseif ($to) {
                                                $query->where('created_at', '<=', $to);
                                            }
                                        })->where('type', 'in')->sum('amount') }}
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="2" class="text-center">{{ __('site.Total_unpaid_bills') }}</td>
                            <td colspan="2">{{ $invoices->where('status', 'unpaid')->sum('total') }}</td>
                        </tr>
                        @if (setting('active_tax'))
                            <tr>
                                <td colspan="2" class="text-center">{{ __('site.Total_Tax') }}</td>
                                <td colspan="2">{{ $invoices->sum('tax') }}</td>
                            </tr>
                        @endif
                        <tr>
                            <td colspan="2" class="text-center">{{ __('site.Total_cost') }}</td>
                            <td colspan="2">{{ $expenses->sum('amount') }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">{{ __('site.Total_purchases') }}</td>
                            <td colspan="2">{{ $purchases->sum('amount') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
