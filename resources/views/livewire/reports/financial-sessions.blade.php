<section class="main-section py-0 section-mobile">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-3">
            <h4 class="main-heading mb-0">@lang('Follow up financial sessions')</h4>
            <a href="{{ route('accounting') }}" class="btn btn-secondary btn-sm px-3 w-fit d-block ms-auto">
                <i class="fas fa-angle-left"></i>
            </a>
        </div>
        <div class="box-content">
            <div class="d-flex flex-wrap justify-content-between align-items-end mb-3 gap-2">
                <div class="row g-1">
                    <div class="col-12 col-md-4">
                        <div class="inp-holder">
                            <label for="" class="small-label mb-2">{{ __('site.The_Employee') }}</label>
                            <select wire:model="user_id" class="form-select">
                                <option value="">الكل</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 d-flex align-items-end">
                        <div class="inp-holder">
                            <label for="" class="small-label">من</label>
                            <input type="date" class="form-control" wire:model="from">
                        </div>
                    </div>
                    <div class="col-12 col-md-4 d-flex align-items-end">
                        <div class="inp-holder">
                            <label for="" class="small-label">الي</label>
                            <input type="date" class="form-control" wire:model="to">
                        </div>
                    </div>
                </div>
                <div class="option-holder d-flex align-items-center gap-1">
                    <button class="btn btn-sm btn-outline-warning" id="btn-prt-content">
                        <i class="fa-solid fa-print"></i>
                        <span>طباعة</span>
                    </button>
                    <button class="btn btn-sm btn-outline-info" id="export-btn">
                        <i class="fa-solid fa-file-excel"></i>
                        <span>تصدير Excel</span>
                    </button>
                </div>
            </div>
            <div id="prt-content">
                {{--<div class="box-header-invoice">
                    <div class="row">
                        <div class="col-12">
                            <p class="text-center">ثوبي الفاخر</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="mb-1 d-block">الرقم الضريبي: 300546992600003</small>
                            <small class="mb-1 d-block">
                                العنوان: المدينة المنورة - العام - 100
                            </small>
                            <small class="mb-1 d-block">الهاتف: 0563394041</small>
                        </div>
                        <div class="text-center col-md-4  d-flex align-items-center justify-content-center">
                            <img src="http://127.0.0.1:8000/uploads/settings/1714641620266.jpg" alt=""
                                width="70">
                        </div>
                    </div>
                </div> --}}
                <x-header-invoice />
                <div class="table-responsive">
                    <table class="table main-table table-print" id="data-table">
                        <thead>
                            <tr>
                                <th>{{ __('site.The_Employee') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Start of the session') }}</th>
                                <th>{{ __('End of session') }}</th>
                                <th>{{ __('Cash') }}</th>
                                @foreach ($payment_methods as $method)
                                    <th>{{ __($method->name) }}</th>
                                @endforeach
                                @if (setting('active_tax'))
                                    <th>{{ __('tax') }}</th>
                                @endif
                                <th>{{ __('Total') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $cash = 0;
                                $total_cash = 0;
                            @endphp
                            @foreach ($user_sessions as $session)
                                @php
                                    $total = 0;
                                    $sum_tax = 0;
                                @endphp
                                <tr>
                                    <td>{{ $session->user?->name }}</td>
                                    <td>{{ $session->date }}</td>
                                    <td>{{ $session->start_time }}</td>
                                    <td>{{ $session->end_time ?? 'لم يتم إنهاء الجلسة' }}</td>
                                    <td>
                                        @php
                                            $invoice_ids = $session
                                                ->payment_transactions()
                                                ->where('type', 'in')
                                                ->pluck('invoice_id')
                                                ->toArray();
                                            $sum_tax = \App\Models\Invoice::whereIn('id', $invoice_ids)->sum('tax');
                                            $cash = $session
                                                ->payment_transactions()
                                                ->where('type', 'in')
                                                ->where('payment_method_id', $session->user->payment_method_id)
                                                ->sum('amount');
                                            $total_cash += $cash;
                                            $total += $cash;
                                        @endphp
                                        {{ $cash }}
                                    </td>
                                    @foreach ($payment_methods as $method)
                                        @php
                                            $total += $method
                                                ->payment_transactions()
                                                ->where('type', 'in')
                                                ->where('user_session_id', $session->id)
                                                ->sum('amount');
                                        @endphp
                                        <td>{{ $method->payment_transactions()->where('type', 'in')->where('user_session_id', $session->id)->sum('amount') }}
                                        </td>
                                    @endforeach
                                    @if (setting('active_tax'))
                                        <td>{{ $sum_tax }}</td>
                                    @endif
                                    <td>{{ $total }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>{{ __('Total') }}</td>
                                <td></td>
                                <td>{{ $total_cash }}</td>
                                @foreach ($payment_methods as $method)
                                    <td>{{ $method->payment_transactions()->where('type', 'in')->sum('amount') }}</td>
                                @endforeach
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
