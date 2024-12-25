<div class="">
    <x-messages></x-messages>
    @include('department.modal')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="main-heading m-0">{{ __('site.Departments') }}</h4>
        <a href="{{ route('products') }}" class="btn btn-sm btn-secondary px-4">{{ __('site.Back') }}</a>
    </div>
    <div class="box-content">
        <div class="d-flex align-items-center justify-content-end mb-2">
            @if (auth()->user()->hasPermission('create_departments'))
                <button type="button" class="btn-main-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    {{ __('site.Add_Department') }}
                    <i class="icon fa-solid fa-plus"></i>
                </button>
            @endif
        </div>
        <div class="table-responsive">
            <table class="table main-table">
                <thead>
                    <tr>
                        <th>{{ __('site.Name') }}</th>
                        <th>{{ __('site.Sub_Of') }}</th>
                        <th>{{ __('site.image') }}</th>
                        {{--  @if (setting('is_branches_active'))
                            <th>{{ __('site.branch_id') }}</th>
                        @endif --}}
                        <th class="text-center">{{ __('site.Control') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departments as $department)
                        <tr>
                            <td>{{ $department->name }}</td>
                            <td>{{ $department->main?->name ?? '-' }}</td>
                            <td>
                                @if ($department->image)
                                    <img src="{{ asset('uploads/' . $department->image) }}"
                                        alt="{{ $department->name }}" class="img-thumbnail" width="100px">
                                @else
                                    <img src="{{ asset('img/no-image.jpg') }}" alt="{{ $department->name }}"
                                        class="img-thumbnail" width="100px">
                                @endif
                            </td>
                            {{-- @if (setting('is_branches_active'))
                                <td>{{ $department->branch?->name }}</td>
                            @endif --}}
                            <td>
                                <div class="d-flex flex-wrap align-items-center justify-content-center gap-1">
                                    @if (auth()->user()->hasPermission('update_departments'))
                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal" wire:click="edit({{ $department->id }})">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    @endif
                                    @if (auth()->user()->hasPermission('delete_departments'))
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $department->id }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    @endif
                                    @include('department.delete')
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $departments->links() }}
        </div>
    </div>
</div>
