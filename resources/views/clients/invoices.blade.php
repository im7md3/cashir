@extends('layouts.app')
@section('title', 'فواتير' . ' ' . $client->name)
@section('content')
    <section class="patinet-report main-section pt-5">
        <div class="container">
            <h4 class="main-heading"> @lang('invoices') {{ $client->name }}</h4>
            <div class="treasuryAccount-content bg-white p-4 rounded-2 shadow">

                @if (count($invoices) > 0)
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
                                    <th>{{ __('site.Payment_method') }}</th>
                                    <th>{{ __('site.Status') }}</th>
                                    <th>{{ __('site.Date') }}</th>
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
                                        <td>{{ $invoice->payment_method == 'cash' ? @lang('Cash') : @lang('Network') }}
                                        </td>
                                        <td>
                                            @if ($invoice->status == 'paid')
                                                @lang('Paid')
                                            @elseif($invoice->status == 'unpaid')
                                                @lang('Unpaid')
                                            @else
                                                @lang('review')
                                            @endif
                                        </td>
                                        <td>{{ $invoice->date }}</td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td> {{ __('site.There_are_no_bills_for_this_employee') }}</td>
                                    </tr>
                                @endforelse

                                {{-- <tr>
                                <td>{{ __('site.The_Total') }}</td>
                                <td>-</td>
                                <td>-</td>
                                <td>{{ $invoices->sum('price') }}</td>
                                <td>{{ $invoices->sum('discount') }}</td>
                                <td>{{ $invoices->sum('tax') }}</td>
                                <td>{{ $invoices->sum('total') }}</td>
                                <td>-</td>
                                <td>{{ $invoices->sum('total') + $invoices->sum('tax') }}</td>
                            </tr> --}}

                            </tbody>
                        </table>
                        {{ count($invoices) > 0 ? $invoices->links() : '' }}
                    </div>
                @endif
            </div>
        </div>
    </section>

@endsection
