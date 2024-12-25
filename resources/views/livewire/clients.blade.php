<div class="">
    <x-messages></x-messages>
    @include('clients.modal')
    <h4 class="main-heading">{{ __('site.Clients') }}</h4>
    <div class="box-content">
        @if (auth()->user()->hasPermission('create_clients'))
            <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-3">
                <div dir="ltr" class="d-flex align-items-center justify-content-end">
                    <div x-data="{ searchphone: '' }">
                        <input dir="rtl" type="text" class="form-control h-100"
                            placeholder="{{ __('site.Search_by_mobile_number') }}" x-model="searchphone"
                            @input="$wire.set('searchphone', searchphone)">
                    </div>
                </div>
                <button type="button" class="btn-main-sm ms-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    {{ __('site.Add_Client') }}
                    <i class="icon fa-solid fa-plus"></i>
                </button>
            </div>
        @endif
        <div class="table-responsive">
            <table class="table main-table">
                <thead>
                    <tr>
                        <th># </th>
                        <th>{{ __('site.Name') }}</th>
                        <th>{{ __('site.Phone') }}</th>
                        <th>{{ __('site.Social_Situation') }}</th>
                        <th>{{ __('site.Added_Date') }}</th>
                        <th>{{ __('site.Invoices') }}</th>
                        <th>{{ __('site.Packages') }}</th>
                        @if (auth()->user()->hasPermission('update_clients', 'delete_clients'))
                            <th class="text-center">{{ __('site.Control') }}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->social_situation == 'single' ? 'اعزب' : 'متزوج' }}</td>
                            <td>{{ $client->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('clients.invoice', $client->id) }}" class="btn btn-sm btn-purple">
                                    <i class="fa-solid fa-eye"></i>
                                    {{ $client->invoices->count() }}
                                </a>
                            </td>
                            <td>
                                <span class="badge bg-warning">{{ $client->package?->name }}</span>
                            </td>
                            <td>
                                <div class="d-flex flex-wrap align-items-center justify-content-center gap-1">
                                    @if (auth()->user()->hasPermission('update_clients'))
                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal" wire:click="edit({{ $client->id }})">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    @endif
                                    @if (auth()->user()->hasPermission('delete_clients'))
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $client->id }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    @endif
                                    @include('clients.delete')
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
