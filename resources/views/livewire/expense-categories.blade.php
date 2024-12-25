<div class="">
    <x-messages></x-messages>
    @include('expense_categories.modal')
    <h4 class="main-heading">{{ __('site.Expense_departments') }}</h4>
    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-3">
        <button type="button" class="btn-main-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
            {{ __('site.Add_Department') }}
            <i class="icon fa-solid fa-plus"></i>
        </button>
        <a href="{{ route('expenses') }}" class="btn-main-sm">
            <i class="fas fa-angle-left"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table class="table main-table">
            <thead>
                <tr>
                    <th>{{ __('site.Name') }}</th>
                    <th>{{ __('site.Sub_Of') }}</th>
                    <th class="text-center">{{ __('site.Control') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>
                            {{ $category->main?->name ?? '-' }}
                            @if ($category->main?->parent)
                                @php
                                    $get_parent = \App\Models\ExpenseCategory::find($category->main?->parent);
                                @endphp
                                - {{ __('site.Sub_Of') }} : {{ $get_parent->name }}
                            @endif
                        </td>
                        <td>
                            <div class="d-flex flex-wrap align-items-center justify-content-center gap-1">
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" wire:click="edit({{ $category->id }})">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#delete{{ $category->id }}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                                @include('expense_categories.delete')
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $categories->links() }}
    </div>
</div>
