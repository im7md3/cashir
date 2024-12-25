<table class="table main-table mt-3" style="min-width:1000px">
    <thead>

        <tr>
            <th>{{ __('site.invoice_number') }}</th>
            <th>{{ __('site.The_Employee') }}</th>
            <th>{{ __('site.Client') }}</th>
            <th>{{ __('Date') }}</th>
            <th>{{ __('site.Amount') }}</th>
            @if (setting('active_tax'))
                <th>{{ __('site.Tax') }}</th>
            @endif
            <th>{{ __('site.Total') }}</th>
            <th>{{ __('site.Discount') }}</th>

            <th>{{ __('package balance') }}</th>
            <th>{{ __('site.rest') }}</th>
            <th>{{ __('site.Status') }}</th>
            <th>{{ __('site.Returner') }}</th>
        </tr>

    </thead>
    <tbody>

        @foreach ($invoices as $invoice)
            <tr>
                <td>{{ $invoice->id }}</td>
                <td>{{ $invoice->user->name }}</td>
                <td>{{ $invoice->client ? $invoice->client->name : 'عميل نقدي' }}</td>
                <td>{{ $invoice->created_at->format('Y-m-d') }}</td>
                <td>{{ $invoice->price }}</td>
                @if (setting('active_tax'))
                    <td>{{ $invoice->tax }}</td>
                @endif
                <td>{{ $invoice->total }}</td>
                <td>{{ $invoice->discount ? $invoice->discount : 0 }}</td>

                <td>{{ $invoice->package_balance }}</td>
                <td>{{ $invoice->rest }}</td>
                <td>
                    {{ __($invoice->status) }}
                </td>
                <td>
                    {{ $invoice->refund ? $invoice->refund . ' - ' . ($invoice->refund_status == 'creditor' ? 'دائن' : 'مدين') : '' }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td>{{ __('site.The_Total') }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{ App\Models\Invoice::sum('total') }}</td>
            <td></td>
            <td></td>
            <td></td>
            {{-- <td>{{ App\Models\Invoice::sum('cash') }}</td> --}}
            {{-- <td>{{ App\Models\Invoice::sum('card') }}</td> --}}
            <td></td>
        </tr>


    </tbody>
</table>
