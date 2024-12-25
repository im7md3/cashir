<div class="">
    <x-messages></x-messages>
    @include('units.modal')
    <div class="d-flex align-items-center mb-3">
        <h4 class="main-heading m-0">@lang('Units')</h4>

    </div>
    <div class="box-content">
        <div class="d-flex align-items-center justify-content-end mb-2">

            <button type="button" class="btn-main-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                @lang('Add')
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
                    @foreach ($units as $unit)
                    <tr>
                        <td>{{ $unit->name }}</td>
                        <td>
                            <div class="d-flex flex-wrap align-items-center justify-content-center gap-1">
                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" wire:click="edit({{ $unit->id }})">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#delete{{ $unit->id }}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                                @include('units.delete')
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $units->links() }}
        </div>
    </div>
</div>
