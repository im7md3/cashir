<div class="">
    @section('title', __('Payment Methods'))

    <x-messages></x-messages>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $name ? __('Edit') : __('Add') }}
                        {{ __('site.payment_methods') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row row-gap-24">
                        <div class=" col-sm-12">
                            <label class="small-label" for="">{{ __('site.Name') }}</label>
                            <input class="form-control" type="text" wire:model.defer='name' placeholder="">
                        </div>
                        <div class=" col-sm-12">
                            <label class="small-label" for="">{{ __('site.account_no') }}</label>
                            <input class="form-control" type="text" wire:model.defer='account_no' placeholder="">
                        </div>
                        <div class=" col-sm-12">
                            {{ __('Cash') }} <input type="checkbox" wire:model="is_cash">
                        </div>
                        <div class=" col-sm-12">
                            {{ __('Default to payment') }} <input type="checkbox" wire:model="default_payment">
                        </div>
                        <div class=" col-sm-12">
                            {{ __('site.active') }} <input type="checkbox" wire:model="status">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('site.Close') }}</button>
                    <button wire:click='submit' class="btn btn-primary"
                        data-bs-dismiss="modal">{{ __('site.Save') }}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="main-heading m-0">{{ __('Payment Methods') }}</h4>
        <a href="{{ route('settings.index') }}" class="btn btn-sm btn-secondary px-4">{{ __('site.Back') }}</a>
    </div>
    <div class="box-content">
        <div class="d-flex align-items-center justify-content-end mb-2">
            @if (auth()->user()->hasPermission('create_payment_methods'))
                <button type="button" class="btn-main-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    {{ __('site.create') }}
                    <i class="icon fa-solid fa-plus"></i>
                </button>
            @endif
        </div>
        <div class="table-responsive">
            <table class="table main-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('site.Name') }}</th>
                        <th>{{ __('site.account_no') }}</th>
                        <th>{{ __('site.status') }}</th>
                        <th>{{ __('Cash') }}</th>
                        <th>{{ __('Default to payment') }}</th>
                        <th>{{ __('site.Employees') }}</th>
                        <th class="text-center">{{ __('site.Control') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payment_methods as $payment_method)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $payment_method->name }}</td>
                            <td>{{ $payment_method->account_no }}</td>
                            <td>{{ $payment_method->status == 1 ? 'مفعل' : 'غير مفعل' }}</td>
                            <td>{{ $payment_method->is_cash == 1 ? 'نعم' : 'لا' }}</td>
                            <td>{{ $payment_method->default_payment == 1 ? 'نعم' : 'لا' }}</td>
                            <td>
                                @foreach ($payment_method->users as $user)
                                    <p class="badge bg-primary">{{ $user->name }}</p>
                                @endforeach
                            </td>
                            <td>
                                <div class="d-flex flex-wrap align-items-center justify-content-center gap-1">
                                    @if (auth()->user()->hasPermission('update_payment_methods'))
                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal"
                                            wire:click="edit({{ $payment_method->id }})">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    @endif
                                    {{-- @if (auth()->user()->hasPermission('delete_payment_methods'))
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $payment_method->id }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>

                                        <div class="modal fade" id="delete{{ $payment_method->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            {{ __('site.delete') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ __('site.Are_you_sure_to_delete_the_section?') }}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">{{ __('site.Close') }}</button>
                                                        <button wire:click='delete({{ $payment_method->id }})'
                                                            type="button" class="btn btn-primary"
                                                            data-bs-dismiss="modal">{{ __('site.yes') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif --}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $payment_methods->links() }}
        </div>
    </div>
</div>
