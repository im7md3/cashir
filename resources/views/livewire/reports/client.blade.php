<section class="patinet-report">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-3">
            <h4 class="main-heading mb-0">{{ __('site.Client_report') }}</h4>
            <a href="{{ route('accounting') }}" class="btn btn-secondary btn-sm px-3 w-fit d-block ms-auto">
                <i class="fas fa-angle-left"></i>
            </a>
        </div>
        <div class="treasuryAccount-content bg-white p-4 rounded-2 shadow">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="box-info">
                        <label for="client-id"
                            class="report-name mt-3 mb-2 small-label">{{ __('site.Client_Number') }}</label>
                        <input type="text" wire:keyup='get_client' wire:model="phone" class="form-control client-id"
                            id="client-id" />
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="box-info">
                        <label for="client-name"
                            class="report-name mt-3 mb-2 small-label">{{ __('site.Client_Name') }}</label>
                        <input type="text" class="client-name form-control" id="client-name"
                            value="{{ $client ? $client->name : '' }}" readonly />
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
                <div class="col-12 col-md-4">
                    <div class="box-info">
                        <label for="pay-way"
                            class="report-name mt-3 mb-2 small-label">{{ __('site.Payment_method') }}</label>
                        <select class="main-select w-100 pay-way" id="pay-way" wire:model="pay_method">
                            <option value="">{{ __('site.choose') }}</option>
                            <option value="cash">{{ __('site.Cash') }}</option>
                            <option value="card">{{ __('site.Network_pay') }}</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-ms-6 col-md-6">
                        <div class="box-info">
                            <label for="duration-to" class="small-label report-name mt-3 mb-2">@lang('Total bills paid')</label>
                            <input type="text" class="form-control"
                                value="{{ $client ? $client->invoices->where('status', 'paid')->sum('total') : '' }}"
                                readonly />
                        </div>
                    </div>
                    <div class="col-12 col-ms-6 col-md-6">
                        <div class="box-info">
                            <label for="duration-to" class="small-label report-name mt-3 mb-2">@lang('Total unpaid bills')
                            </label>
                            <input type="text" class="form-control"
                                value="{{ $client ? $client->invoices->where('status', 'unpaid')->sum('total') : '' }}"
                                readonly />
                        </div>
                    </div>
                </div>

            </div>
            <!-- <hr> -->
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
                                <th>{{ __('site.Cash') }}</th>
                                <th>{{ __('site.Network_pay') }}</th>
                                <th>{{ __('site.Status') }}</th>
                                <th>{{ __('Date') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->id }}</td>
                                    <td>{{ $invoice->user->name }}</td>
                                    <td>{{ $invoice->client ? $invoice->client->name : __('undefined') }}</td>
                                    <td>{{ $invoice->price }}</td>
                                    <td>{{ $invoice->discount }}</td>
                                    @if (setting('active_tax'))
                                        <td>{{ $invoice->tax }}</td>
                                    @endif
                                    <td>{{ $invoice->total }}</td>
                                    <td>{{ $invoice->cash }}</td>
                                    <td>{{ $invoice->card }}</td>
                                    <td>
                                        @if ($invoice->status == 'paid')
                                            @lang('paid')
                                        @elseif($invoice->status == 'unpaid')
                                            @lang('unpaid')
                                        @else
                                            @lang('returned')
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
                                <td>{{ $invoices->sum('tax') }}</td>
                                <td>{{ $invoices->sum('total') }}</td>
                                <td>-</td>
                                <td>{{ $invoices->sum('total') + $invoices->sum('tax') }}</td>
                            </tr>

                        </tbody>
                    </table>
                    {{ count($invoices) > 0 ? $invoices->links() : '' }}
                </div>
            @endif
        </div>
    </div>
</section>
