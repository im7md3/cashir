<section class="patinet-report">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-3">
            <h4 class="main-heading mb-0">{{ __('site.Employee_report') }}</h4>
            <a href="{{ route('accounting') }}" class="btn btn-secondary btn-sm px-3 w-fit d-block ms-auto">
                <i class="fas fa-angle-left"></i>
            </a>
        </div>
        <div class="treasuryAccount-content box-content">
            <div class="row">
                <div class="col-12">
                    <div class="box-info d-flex  flex-column">
                        <label for="user-name" class="small-label">{{ __('site.Choose_employee') }}</label>
                        <select wire:model="user_id" id="user-name" class="main-select w-110px">
                            <option value="">{{ __('site.choose') }}</option>
                            @foreach (\App\Models\User::get() as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="box-info">
                        <label for="duration-from"
                            class="report-name mt-3 mb-2 small-label">{{ __('site.From') }}</label>
                        <input type="date" class="form-control" value="2022-07-12" wire:model="from"
                            id="duration-from" />
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="box-info">
                        <label for="duration-to" class="small-label report-name mt-3 mb-2">{{ __('site.To') }}</label>
                        <input type="date" class="form-control" value="2024-03-03" wire:model="to"
                            id="duration-to" />
                    </div>
                </div>
            </div>


            <!-- <hr> -->
            @if (count($invoices) > 0)

                <button class="btn btn-success btn-sm" wire:click="export">
                    تصدير اكسيل
                </button>

                <div class="table-responsive mt-3">
                    <table class="table main-table" id="data-table">
                        <thead>
                            <tr>
                                <th>{{ __('site.invoice_number') }}</th>
                                <th>{{ __('site.The_Employee') }}</th>
                                <th>{{ __('site.Client') }}</th>
                                <th>{{ __('site.price') }}</th>
                                <th>{{ __('site.Discount') }}</th>
                                @if (setting('active_tax'))
                                    <th>{{ __('site.Tax') }}</th>
                                @endif
                                <th>{{ __('site.Total') }}</th>
                                @foreach ($payment_methods as $payment_method)
                                    <th>{{ $payment_method->name }}</th>
                                @endforeach
                                <th>{{ __('site.Status') }}</th>
                                <th>{{ __('Date') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->id }}</td>
                                    <td>{{ $invoice->user->name }}</td>
                                    <td>{{ $invoice->client ? $invoice->client->name : 'غير محدد' }}</td>
                                    <td>{{ $invoice->price }}</td>
                                    <td>{{ $invoice->discount }}</td>
                                    @if (setting('active_tax'))
                                        <td>{{ $invoice->tax }}</td>
                                    @endif
                                    <td>{{ $invoice->total }}</td>
                                    @foreach ($payment_methods as $payment_method)
                                        <td>
                                            {{ $payment_method->payment_transactions()->where(function ($query) use ($from, $to) {
                                                    if ($from && $to) {
                                                        $query->whereBetween('created_at', [$from, $to]);
                                                    } elseif ($from) {
                                                        $query->where('created_at', '>=', $from);
                                                    } elseif ($to) {
                                                        $query->where('created_at', '<=', $to);
                                                    } else {
                                                        $query;
                                                    }
                                                })->where('type', 'in')->where('user_id', $user_id)->where('invoice_id', $invoice->id)->sum('amount') }}
                                        </td>
                                    @endforeach
                                    <td>
                                        @if ($invoice->status == 'paid')
                                            مدفوعة
                                        @elseif($invoice->status == 'unpaid')
                                            غير مدفوعة
                                        @else
                                            مرتجعة
                                        @endif
                                    </td>
                                    <td>{{ $invoice->date }}</td>
                                </tr>

                            @empty
                                <tr>
                                    <td> {{ __('site.There_are_no_invoices_for_this_customer') }}</td>
                                </tr>
                            @endforelse

                            <tr>
                                <td>{{ __('site.The_Total') }}</td>
                                <td>-</td>
                                <td>-</td>
                                <td>{{ $invoices->sum('price') }}</td>
                                <td>{{ $invoices->sum('discount') }}</td>
                                @if (setting('active_tax'))
                                    <td>{{ $invoices->sum('tax') }}</td>
                                @endif
                                <td>{{ $invoices->sum('total') }}</td>
                                @foreach ($payment_methods as $payment_method)
                                    <td>
                                        {{ $payment_method->payment_transactions()->where(function ($query) use ($from, $to) {
                                                if ($from && $to) {
                                                    $query->whereBetween('created_at', [$from, $to]);
                                                } elseif ($from) {
                                                    $query->where('created_at', '>=', $from);
                                                } elseif ($to) {
                                                    $query->where('created_at', '<=', $to);
                                                } else {
                                                    $query;
                                                }
                                            })->where('type', 'in')->where('user_id', $user_id)->sum('amount') }}
                                    </td>
                                @endforeach
                                {{-- <td>{{ $invoices->sum('total') + $invoices->sum('tax') }}</td> --}}
                            </tr>

                        </tbody>
                    </table>
                    {{ count($invoices) > 0 ? $invoices->links() : '' }}
                </div>
            @endif
        </div>
    </div>
</section>
