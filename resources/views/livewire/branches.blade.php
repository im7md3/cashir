<div class="">
    <x-messages></x-messages>
    @include('branch.modal')
    <div class="d-flex align-items-center mb-3">
        <h4 class="main-heading m-0">{{ __('site.Branches') }}</h4>
        @if (setting('is_branches_active'))
            <div class="flex-fill d-flex justify-content-center ">
                <div class="alert alert-primary m-0 py-2">
                    {{ __('site.Branches_can_be_requested_to_be_activated_by_contacting_us') . setting('available_branches_count') }}
                </div>
            </div>
        @endif
        <a href="{{ route('settings.index') }}" class="btn btn-sm btn-secondary px-4">{{ __('site.Back') }}</a>
    </div>
    <div class="box-content">
        <div class="d-flex align-items-center justify-content-end mb-2">
            @if (auth()->user()->hasPermission('create_branches') &&
                    setting('is_branches_active') &&
                    setting('available_branches_count') > \App\Models\Branch::count())
                <button type="button" class="btn-main-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    {{ __('site.Add_Branch') }}
                    <i class="icon fa-solid fa-plus"></i>
                </button>
            @endif
        </div>
        <div class="table-responsive">
            <table class="table main-table">
                <thead>
                    <tr>
                        <th>{{ __('site.Name') }}</th>
                        <th>عدد الموظفين</th>
                        <th class="text-center">{{ __('site.Control') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($branches as $branch)
                        <tr>
                            <td>{{ $branch->name }}</td>
                            <td>
                                <a class="btn btn-sm btn-warning"
                                    href="{{ route('admins.index', ['branch_id' => $branch->id]) }}">{{ $branch->users_count }}</a>
                            </td>
                            <td>
                                <div class="d-flex flex-wrap align-items-center justify-content-center gap-1">
                                    @if (auth()->user()->hasPermission('update_branches'))
                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal" wire:click="edit({{ $branch->id }})">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    @endif
                                    @if (auth()->user()->hasPermission('delete_branches'))
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $branch->id }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    @endif
                                    @include('branch.delete')
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $branches->links() }}
        </div>
    </div>
</div>
