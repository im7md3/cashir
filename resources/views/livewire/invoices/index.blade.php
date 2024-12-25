<section class="main-section home">
    <div class="container">

        <x-messages></x-messages>


        <h4 class="main-heading">{{ __('site.Invoices') }}</h4>
        <div class="box-content">
            <div class="d-flex align-items-center gap-3 mb-1 flex-wrap">
                <div dir="ltr" class="d-flex align-items-center justify-content-end">
                    <button id="button-addon2" type="button" class="btn btn-success rounded-0 input-group-addon">
                        {{ __('site.search') }}
                    </button>
                    <input dir="rtl" type="text" class="form-control h-100"
                        placeholder="{{ __('site.Search_by_invoice_number') }}" wire:model='searchinvoiveno'>
                </div>
                <div class="d-flex align-items-center justify-content-end">
                    {{-- <button id="button-addon2" type="button" class="btn btn-success input-group-addon">
                        {{ __('site.search') }}
                    </button> --}}
                    {{-- <input dir="rtl" type="text" class="form-control" placeholder="البحث باسم الموظف"  wire:model='searchemployee'> --}}
                    <select name="" id="" wire:model='searchemployee' class="main-select">
                        <option value="">{{ __('site.Search_by_customer_name') }}</option>
                        @foreach (\App\Models\Client::get() as $client)
                            <option value="{{ $client->id }}"> {{ $client->name }}</option>
                        @endforeach
                        <option value="unknown">عملاء غير مسجلين</option>
                    </select>
                </div>
                <div class="d-flex align-items-center justify-content-end">
                    <select name="" id="" wire:model='user_id' class="main-select">
                        <option value="">{{ __('site.Choose_employee') }}</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}"> {{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="d-flex align-items-end justify-content-between flex-wrap gap-2 mb-3">
                <div class="gap-2">
                    <button class="btn btn-primary btn-sm mb-2 mb-sm-0"
                        wire:click="$set('filter_status','')">{{ __('site.all') }}
                        {{ App\Models\Invoice::count() }}</button>
                    <button class="btn btn-success btn-sm mb-2 mb-sm-0"
                        wire:click="$set('filter_status','paid')">{{ __('site.paid') }}
                        {{ App\Models\Invoice::where('status', 'paid')->count() }}</button>
                    <button class="btn btn-danger btn-sm mb-2 mb-sm-0"
                        wire:click="$set('filter_status','unpaid')">{{ __('site.spoon') }}
                        {{ App\Models\Invoice::where('status', 'unpaid')->count() }}</button>
                    <button class="btn btn-warning btn-sm mb-2 mb-sm-0"
                        wire:click="$set('filter_status','retrieved')">{{ __('site.retrieved') }}
                        {{ App\Models\Invoice::where('status', 'retrieved')->count() }}</button>
                    {{-- <button class="btn btn-info btn-sm mb-2 mb-sm-0"
                        wire:click="$set('filter_status','free')">{{ __('free') }}
                    {{ App\Models\Invoice::where('status', 'free')->count() }}</button> --}}
                </div>
                <div class="d-flex align-items-center gap-2 flex-wrap flex-lg-nowrap">
                    <div class=" w-100">
                        <label for="" class="small-label">{{ __('site.From') }}</label>
                        <input type="date" class="form-control w-100" wire:model="from">
                    </div>
                    <div class="w-100">
                        <label for="" class="small-label">{{ __('site.To') }}</label>
                        <input type="date" class="form-control w-100" wire:model="to">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button class="btn btn-sm btn-outline-info w-100" wire:click="export()">
                            <span>تصدير</span>
                        </button>
                    </div>
                </div>
            </div>
            @if ($package_client)
                <div class="alert alert-danger">
                    فواتير الباقة للعميل : {{ $packageClient?->name }} , <button
                        wire:click='$set("package_client",null)' class="btn btn-info btn-sm">إعادة تعيين</button>
                </div>
            @endif
            <div class="table-responsive mb-4">
                <table class="table main-table" id="data-table">
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
                            @foreach ($payment_methods as $method)
                                <th>{{ $method->name }}</th>
                            @endforeach
                            <th>{{ __('package balance') }}</th>
                            <th>{{ __('site.rest') }}</th>
                            <th>{{ __('site.Status') }}</th>
                            <th>{{ __('site.Returner') }}</th>
                            <th>{{ __('site.Control') }}</th>
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
                                @foreach ($payment_methods as $method)
                                    <td>{{ $method->payment_transactions()->where('type', 'in')->where('invoice_id', $invoice->id)->sum('amount') }}
                                    </td>
                                @endforeach
                                <td>{{ $invoice->package_balance }}</td>
                                <td>{{ $invoice->rest }}</td>
                                <td>
                                    <span
                                        class="badge bg-{{ $invoice->status === 'paid' ? 'success' : ($invoice->status === 'unpaid' ? 'danger' : 'warning') }}">
                                        {{ __($invoice->status) }}
                                    </span>
                                </td>
                                <td>
                                    {{ $invoice->refund ? $invoice->refund . ' - ' . ($invoice->refund_status == 'creditor' ? 'دائن' : 'مدين') : '' }}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center  gap-1">
                                        @if ($invoice->status != 'retrieved' and $invoice->status != 'free')
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#retrieved{{ $invoice->id }}">
                                                {{ __('site.Recovery') }}
                                            </button>
                                            @include('invoices.retrieved')
                                        @endif

                                        @if ($invoice->status != 'paid' || $invoice->bonds->count() > 0)
                                            <a href="{{ route('invoices.bonds', $invoice) }}" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="سندات"
                                                data-bs-custom-class="sm-tooltip" class="btn btn-sm btn-secondary">
                                                <i class="fa-solid fa-file-contract"></i>
                                            </a>
                                        @endif

                                        <a href="{{ route('invoices.show', $invoice->id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fa-solid fa-print"></i>
                                        </a>
                                        @if (auth()->user()->hasPermission('delete_invoices'))
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#delete{{ $invoice->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @endif
                                        @include('invoices.delete')
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>{{ __('site.The_Total') }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ $total }}</td>
                            <td></td>
                            <td> </td>
                            <td> </td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                {{ $invoices->links() }}
            </div>
        </div>
    </div>
</section>
