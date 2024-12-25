<div class="">
    <x-messages></x-messages>
    @include('suppliers.modal')
    <h4 class="main-heading">{{ __('site.suppliers') }}</h4>
    <div class="box-content">
        <div class="d-flex align-items-center justify-content-between mb-3 gap-3 flex-wrap">
            <div dir="ltr" class="d-flex align-items-center justify-content-end">
                <button id="button-addon2" type="button" class="btn btn-success input-group-addon rounded-0">
                    {{ __('site.search') }}
                </button>
                <input dir="rtl" type="text" class="form-control h-100"
                    placeholder="{{ __('site.Search_by_mobile_number') }}" wire:model='searchphone'>
            </div>
            <button type="button" class="btn-main-sm ms-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">
                @lang('Add')
                <i class="icon fa-solid fa-plus"></i>
            </button>
        </div>

        <div class="table-responsive">
            <table class="table main-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('Name')</th>
                        <th>@lang('phone')</th>
                        <th>@lang('Company')</th>
                        <th>@lang('street')</th>
                        @if (setting('active_tax'))
                            <th>@lang('Tax number')</th>
                        @endif
                        <th class="text-center not-print">{{ __('site.Control') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($suppliers as $client)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->company }}</td>
                            <td>{{ $client->strret }}</td>
                            @if (setting('active_tax'))
                                <td>{{ $client->tax_number }}</td>
                            @endif
                            {{-- <td>{{ $client->created_at->format('Y-m-d') }}</td> --}}
                            {{-- <td>
                            <a href="{{ route('clients.invoice', $client->id) }}" class="btn btn-sm btn-purple">
                                <i class="fa-solid fa-eye"></i>
                                {{ $client->invoices->count() }}
                            </a>
                        </td> --}}
                            {{-- <td>
                            <span class="badge bg-warning">{{ $client->package?->name }}</span>
                        </td> --}}
                            <td>
                                <div class="d-flex flex-wrap align-items-center justify-content-center gap-1">
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" wire:click="edit({{ $client->id }})">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#delete{{ $client->id }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                    @include('suppliers.delete')
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
