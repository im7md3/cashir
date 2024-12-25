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
        </tr>
    </tbody>
</table>
