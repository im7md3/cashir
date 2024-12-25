<div class="">
    @section('title', __('site.Purchases'))
    <div class="d-flex align-items-center justify-content-between flex-wrab mb-3">
        <h4 class="main-heading mb-0">{{ __('site.Purchases') }}</h4>
        @include('menu')

        <h4 class="main-heading mb-0 pe-none opacity-0">{{ __('site.Purchases') }}</h4>
    </div>
    <div class="box-content">
        <div class="d-flex align-items-center justify-content-between mb-2 gap-2">
            <a href="{{ route('purchases.create') }}" class="btn-main-sm">
                {{ __('site.Add_a_purchase_invoice') }}
                <i class="icon fa-solid fa-plus"></i>
            </a>
            <div class="d-flex gap-2">
                <a href="{{ route('suppliers.index') }}" class="btn btn-primary px-3 btn-sm">
                    {{ __('site.suppliers') }}
                </a>

                <button class="btn btn-sm btn-outline-warning ms-2" id="btn-prt-content">
                    <i class="fa-solid fa-print"></i>
                    @lang('Print')
                </button>
                <button class="btn btn-sm btn-outline-info" id="export-btn">
                    <i class="fa-solid fa-file-excel"></i>
                    @lang('Export') Excel
                </button>
            </div>
        </div>
        <div class="table-responsive" id='prt-content'>
            <x-header-invoice></x-header-invoice>

            <table class="table main-table" id="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('site.supplier_id') }}</th>
                        <th>{{ __('site.Amount') }}</th>
                        @if (setting('active_tax'))
                            <th>{{ __('site.The_Tax') }} </th>
                        @endif
                        <th>المتبقي</th>
                        <th>{{ __('site.Total') }}</th>
                        <th>{{ __('site.status') }}</th>
                        <th>{{ __('site.Date_created') }}</th>
                        <th class="text-center not-print">{{ __('site.Control') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchases as $purchase)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $purchase->supplier?->name }}</td>
                            <td>{{ $purchase->amount }}</td>
                            @if (setting('active_tax'))
                                <td>{{ $purchase->tax }}</td>
                            @endif
                            <td class="text-nowrap">{{ $purchase->rest }}</td>
                            <td class="text-nowrap">{{ $purchase->total }}</td>
                            <td class="text-nowrap">{{ __($purchase->status) }}</td>
                            <td class="text-nowrap">{{ $purchase->date }}</td>
                            <td class="not-print">
                                <a href="{{ route('purchases.edit', $purchase->id) }}" class="btn btn-sm btn-info">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <button wire:click="itemId({{ $purchase->id }})" class="btn btn-sm btn-danger"
                                    data-bs-toggle="modal" data-bs-target="#delete">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $purchases->links() }}
            @include('livewire.purchases.delete')
        </div>
    </div>
</div>
