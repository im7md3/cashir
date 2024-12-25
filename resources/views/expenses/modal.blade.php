<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $name ? __('Edit') : __('Add') }}
                    {{ __('site.Branch') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row row-gap-24">
                    <div class="cols-sm-12">
                        <label class="small-label" for="">{{ __('section') }}</label>
                        <select wire:model="expense_category_id" class="form-control">
                            <option value="">{{ __('site.choose') }}</option>
                            @foreach ($expense_categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                    @if ($category->parent)
                                        - {{ __('site.Sub_Of') }} : {{ $category->main?->name }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class=" cols-sm-12">
                        <label class="small-label" for="">{{ __('site.Name') }}</label>
                        <input class="form-control" type="text" wire:model.defer='name' placeholder="">
                    </div>
                    <div class=" cols-sm-12">
                        <label class="small-label" for="">{{ __('site.Amount') }}</label>
                        <input class="form-control" type="text" wire:model.defer='amount' placeholder="">
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
                <button wire:click='submit' class="btn btn-primary"
                    data-bs-dismiss="modal">{{ __('site.Save') }}</button>
            </div>
        </div>
    </div>
</div>
