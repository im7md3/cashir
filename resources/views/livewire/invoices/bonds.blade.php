<section class="bills-section main-section pt-4">
    <x-alert></x-alert>
    @include('invoices.add_or_update_bonds')
    <div class="container">
        <h4 class="main-heading mb-4">سندات الفاتورة {{ $invoice->id }} </h4>
        <div class="bills-content bg-white p-4 rounded-2 shadow">
            <div class="bills-option&btn d-flex align-items-center flex-wrap gap-2 justify-content-end mb-1">
                <div class="control-option d-flex flex-wrap gap-1 align-items-center justify-content-center">
                    <div class="print-btn btn btn-sm btn-warning " id="btn-prt-content">
                        <i class="fa-solid fa-print"></i>
                    </div>
                    <button class="btn-main-sm" data-bs-toggle="modal" data-bs-target="#add_or_update_bonds">
                        أضف سند
                        <i class="icon fa-solid fa-plus me-1"></i>
                    </button>
                </div>
            </div>

            <div id="prt-content" class="table-print">
                <x-header-invoice></x-header-invoice>
                <div class="table-responsive">
                    <table class="table main-table">
                        <thead>
                            <tr>
                                <th>رقم الفاتورة</th>
                                <th>المتبقي</th>
                                <th>{{ __('The_Employee') }}</th>
                                <th>{{ __('Client') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('amount') }}</th>
                                <th>الحالة</th>
                                <th class="not-print">إجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bonds as $bond)
                                <tr>
                                    <td>{{ $bond->invoice->id }}</td>
                                    <td>{{ $bond->rest }}</td>
                                    <td>{{ $bond->user->name }}</td>
                                    <td>{{ $bond->invoice->client->name }}</td>
                                    <td>{{ $bond->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $bond->amount }}</td>
                                    <td>{{ __($bond->status) }}</td>
                                    <td class="not-print">
                                        <div class="d-flex align-items-center justify-content-center gap-1">

                                            @if (auth()->user()->hasPermission('update_invoices'))
                                                <button data-bs-toggle="modal" data-bs-target="#add_or_update_bonds"
                                                    class="btn btn-sm btn-info text-white"
                                                    wire:click='edit({{ $bond->id }})'>
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                            @endif

                                            @if (auth()->user()->hasPermission('delete_invoices'))
                                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    title="حذف" data-bs-target="#deleteBond{{ $bond->id }}">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @include('invoices.deleteBond')
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
