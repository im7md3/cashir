<div class="">
    <x-messages></x-messages>
    @include('expenses.modal')
    <div class="d-flex align-items-md-center justify-content-between gap-3 flex-column flex-sm-row mb-3">
        <h4 class="main-heading mb-0">{{ __('site.Expenses') }}</h4>
        @include('menu')

        <h4 class="main-heading mb-0 pe-none opacity-0 d-none d-md-block">{{ __('site.Expenses') }}</h4>
    </div>
    <div class="box-content">
        <div class="d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row mb-2 gap-3">
            <div class="d-flex gap-2">
                <a class="btn btn-primary btn-sm" href="{{ route('expense_categories') }}">
                    {{ __('site.Expense_departments') }}
                </a>
                <button class='btn btn-warning btn-sm' id='btn-prt-content'>
                    <i class="fa-solid fa-print"></i>
                    @lang('Print')
                </button>
                <button class="btn btn-sm btn-outline-info" id="export-btn">
                    <i class="fa-solid fa-file-excel"></i>
                    @lang('Export') Excel
                </button>
            </div>
            <button type="button" class="btn-main-sm ms-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">
                {{ __('site.Add_an_expense') }}
                <i class="icon fa-solid fa-plus"></i>
            </button>
        </div>
        <div class="table-responsive" id='prt-content'>
            <x-header-invoice></x-header-invoice>

            <table class="table main-table" id="data-table">
                <thead>
                    <tr>
                        <th>{{ __('site.Name') }}</th>
                        <th>{{ __('site.Department') }}</th>
                        <th>{{ __('site.Amount') }}</th>
                        <th class="text-center">{{ __('site.Control') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expenses as $expense)
                    <tr>
                        <td>{{ $expense->name }}</td>
                        <td>{{ $expense->category->name }}</td>
                        <td>{{ $expense->amount }}</td>
                        <td>
                            <div class="d-flex flex-wrap align-items-center justify-content-center gap-1">
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" wire:click="edit({{ $expense->id }})">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $expense->id }}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                                @include('expenses.delete')
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $expenses->links() }}
        </div>
    </div>
</div>