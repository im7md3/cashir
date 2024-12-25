<div class="">
    <x-messages></x-messages>
    @include('users.modal')
    <h4 class="main-heading">{{ __('site.Employees') }}</h4>
    <div class="box-content">
        <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-3">
            <a class="btn-main-sm" href="{{ route('user_categories') }}">
                {{ __('site.Employees_Departments') }}
            </a>
            @if (auth()->user()->hasPermission('create_admins'))
                <button type="button" class="btn-main-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    أضف موظف
                    <i class="icon fa-solid fa-plus"></i>
                </button>
            @endif
        </div>
        <div class="table-responsive">
            <table class="table main-table">
                <thead>
                    <tr>
                        <th># </th>
                        <th>{{ __('site.Name') }}</th>
                        <th>{{ __('site.Phone') }}</th>
                        <th>{{ __('site.E-mail') }}</th>
                        <th>{{ __('site.Department') }}</th>
                        <th>{{ __('Cash drawer') }}</th>
                        <th class="text-center">{{ __('site.Control') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->category->name }}</td>
                            <td>{{ $user->payment_method?->name ?? 'لا يوجد' }}</td>
                            <td>
                                <div class="d-flex flex-wrap align-items-center justify-content-center gap-1">
                                    @if (auth()->user()->hasPermission('update_admins'))
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal" wire:click="edit({{ $user->id }})">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    @endif
                                    @if (auth()->user()->hasPermission('delete_admins'))
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $user->id }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    @endif
                                    @include('users.delete')
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
