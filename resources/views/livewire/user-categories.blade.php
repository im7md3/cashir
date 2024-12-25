<div class="">
    <x-messages></x-messages>
    @include('user_categories.modal')
    <h4 class="main-heading">{{ __('site.Employees_Departments') }}</h4>
    <div class="box-content">
        <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-3">
            <button type="button" class="btn-main-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                {{ __('site.Add_Department') }}
                <i class="icon fa-solid fa-plus"></i>
            </button>
        </div>
        <div class="table-responsive">
            <table class="table main-table">
                <thead>
                    <tr>
                        <th>{{ __('site.Name') }}</th>
                        <th class="text-center">{{ __('site.Control') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user_categories as $user_category)
                        <tr>
                            <td>{{ $user_category->name }}</td>
                            <td>
                                <div class="d-flex flex-wrap align-items-center justify-content-center gap-1">
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" wire:click="edit({{ $user_category->id }})">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#delete{{ $user_category->id }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                    @include('user_categories.delete')
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
