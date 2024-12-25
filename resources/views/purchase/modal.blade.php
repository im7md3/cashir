<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('site.add') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-2">
                    <div class=" col-md-12">
                        <label class="small-label" for="">{{ __('site.Name') }}</label>
                        <input class="form-control" type="text" wire:model.defer='name' placeholder="">
                        {{-- {{ var_export($name) }} --}}
                    </div>
                    <div class=" col-md-12">
                        <label class="small-label" for="">{{ __('site.Amount') }}</label>
                        <input class="form-control" type="number" min="0" wire:model.defer='amount'
                            placeholder="">
                        {{-- {{ var_export($amount) }} --}}
                    </div>
                    <div class=" col-md-12 d-flex align-items-end gap-2">
                        <div class="inp-holder mb-2">
                            <label class="small-label mb-0" for="">{{ __('site.There_is_a_tax') }}</label>
                            <input type="checkbox" class="mb-1" wire:model.defer='status'>
                            {{-- {{ var_export($status) }} --}}
                        </div>
                    </div>
                </div>

                <table class="mt-3 table main-table text-center">
                    <thead>
                        <tr>
                            <th colspan="4">{{ __('Payments') }} <button wire:click="addPayment"
                                    class="btn btn-success btn-sm"><i class="fa fa-plus"></i></button></th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Payment Method') }}</th>
                            <th>{{ __('amount') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $index => $payment)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <select class="form-select"
                                        wire:model="payments.{{ $index }}.payment_method_id">
                                        <option value="">اختر</option>
                                        @foreach ($payment_methods as $payment_method)
                                            <option value="{{ $payment_method->id }}">
                                                {{ $payment_method->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" wire:model="payments.{{ $index }}.amount"
                                        class="form-control">
                                </td>
                                <td>
                                    <button wire:click="removePayment({{ $index }})"
                                        class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">{{ __('site.Close') }}</button>
                <button wire:click='store' class="btn btn-primary"
                    data-bs-dismiss="modal">{{ __('site.Save') }}</button>
            </div>
        </div>
    </div>
</div>
