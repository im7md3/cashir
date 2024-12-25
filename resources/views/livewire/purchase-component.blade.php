<div class="">
    <x-messages></x-messages>
    @include('purchase.modal')
    <div class="d-flex align-items-md-center justify-content-between gap-3 flex-column flex-sm-row mb-3">
        <h4 class="main-heading mb-0">{{ __('site.Purchases') }}</h4>
@include('menu')
        <h4 class="main-heading mb-0 pe-none opacity-0 d-none d-md-block">{{ __('site.Purchases') }}</h4>
    </div>
    <div class="box-content">
        <div class="d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row mb-2 gap-3">
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
            <button type="button" class="btn-main-sm align-self-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                {{ __('site.Add_a_purchase_invoice') }}
                <i class="icon fa-solid fa-plus"></i>
            </button>
        </div>
        <div class="table-responsive" id='prt-content'>
            <x-header-invoice></x-header-invoice>

            <table class="table main-table" id="data-table">
                <thead>
                    <tr>
                        <th>{{ __('site.Name') }}</th>
                        <th>{{ __('site.Amount') }}</th>
                        @if (setting('active_tax'))
                            <th>{{ __('site.There_is_a_tax') }}</th>
                            <th>{{ __('site.The_Tax') . '(' . $tax . ')' . '%' }} </th>
                            <th>{{ __('site.amount_with_tax') }}</th>
                        @endif
                        <th>{{ __('site.Date_created') }}</th>
                        <th class="text-center not-print">{{ __('site.Control') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchases as $purchase)
                        <tr>
                            <td>{{ $purchase->name }}</td>
                            <td>{{ $purchase->amount }}</td>
                            @if (setting('active_tax'))
                                <td class="text-nowrap">
                                    {{ $purchase->status == 1 ? 'شامل الضريبه' : 'غير شامل الضريبه' }}</td>
                                <td>{{ $purchase->status == 1 ? ($purchase->amount * $tax) / 100 : '-' }}</td>
                                <td>{{ $purchase->status == 1 ? $purchase->amount + ($purchase->amount * $tax) / 100 : '-' }}
                                </td>
                            @endif
                            <td class="text-nowrap">{{ $purchase->created_at() }}</td>
                            <td class="not-print">
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                        data-bs-target="#edit{{ $purchase->id }}"
                                        wire:click="edit({{ $purchase->id }})">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#delete{{ $purchase->id }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                    @include('purchase.editmodal')
                                    @include('purchase.delete')
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $purchases->links() }}
        </div>
    </div>
</div>
