<section class="main-section users">
    @section('title', __('site.Add_a_purchase_invoice'))
    <x-messages></x-messages>
    <div class="container">
        <div class="d-flex mb-3 gap-3 align-items-center ">
            <h4 class="main-heading m-0">{{ __('site.Purchases') }}</h4>
        </div>
        <div class="section-content p-4 bg-white rounded-3 shadow">
            <div class="row">
                @if(setting('is_branches_active'))
                    <div class="col-md-4">
                        <div class="d-flex flex-column mb-2">
                            <label for="" class="small-label mb-1">{{ __('site.branch_id') }}</label>
                            <select wire:model="branch_id" id="branch_id" class="form-select">
                                <option value="">اختر الفرع</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif
                <div class="col-md-4">
                    <div class="d-flex flex-column mb-2">
                        <label for="" class="small-label mb-1">{{ __('Supplier') }}</label>
                        <select wire:model="supplier_id" id="supplier_id" class="form-select">
                            <option value="">اختر المورد</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex flex-column mb-2">
                        <label for="" class="small-label mb-1">{{ __('site.Date') }}</label>
                        <input type="date" wire:model="date" class="form-control">
                    </div>
                </div>

                <div class="col-12 mt-3 mb-3">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th width="30%">@lang('site.barcode')</th>
                                <th width="30%">@lang('site.product_name')</th>
                                <th>@lang('site.Quantity')</th>
                                <th>@lang('site.cost_price')</th>
                                <th>@lang('site.sell_price')</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($items as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <input type="text" class="form-control"
                                               wire:keydown.enter='getProduct({{ $index }},$event.target.value)'
                                               wire:model="items.{{ $index }}.barcode"
                                               wire:keyup="calculateTotal">
                                    </td>
                                    <td>
                                        <div>
                                            <select class="form-select"
                                                    wire:model="items.{{ $index }}.product_id">
                                                <option value="">@lang('site.product_name')</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control"
                                               wire:model="items.{{ $index }}.quantity"
                                               wire:keyup="calculateTotal">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control"
                                               wire:model="items.{{ $index }}.cost_price"
                                               wire:keyup="calculateTotal">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control"
                                               wire:model="items.{{ $index }}.sell_price">
                                    </td>
                                    <td>
                                        @if ($index == 0)
                                            <button class="btn btn-success btn-sm" wire:click="addItem"><i
                                                    class="fa fa-plus"></i></button>
                                        @endif
                                        @if ($index > 0)
                                            <button class="btn btn-danger btn-sm"
                                                    wire:click="removeItem({{ $index }})"><i
                                                    class="fa fa-trash"></i></button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="d-flex flex-column mb-2">
                        <label for="" class="small-label mb-1">{{ __('site.Amount') }}</label>
                        <input type="text" wire:model.defer="amount" disabled class="w-100 form-control">
                    </div>
                </div>
                @if (setting('active_tax'))
                    <div class="col-md-4">
                        <div class="d-flex flex-column mb-2">
                            <label for="" class="small-label mb-1">{{ __('site.Tax') }}</label>
                            <input type="text" disabled wire:model="tax" class="w-100 form-control">
                        </div>
                    </div>
                @endif

                <div class="col-md-4">
                    <div class="d-flex flex-column mb-2">
                        <label for="" class="small-label mb-1">{{ __('site.Total') }}</label>
                        <input type="text" wire:model.defer="total" disabled class="w-100 form-control">
                    </div>
                </div>

                <div class="col-md-12">
                    <table class="mt-3 table main-table text-center">
                        <thead>
                        <tr>
                            <th colspan="3">{{ __('Payments') }}</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Payment Method') }}</th>
                            <th>{{ __('amount') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($payments as $index => $payment)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    {{ $payment['payment_method_name'] }}
                                </td>
                                <td>
                                    <input type="text" wire:model="payments.{{ $index }}.amount"
                                           class="form-control" wire:keyup='calculateRest'>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-md-4">
                    <div class="d-flex flex-column mb-2">
                        <label for="" class="small-label mb-1">المدفوع</label>
                        <input type="text" wire:model.defer="paid" disabled class="w-100 form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex flex-column mb-2">
                        <label for="" class="small-label mb-1">المتبقي</label>
                        <input type="text" disabled wire:model="rest" class="w-100 form-control">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="d-flex flex-column mb-2">
                       الحالة : {{__($status)}}
                    </div>
                </div>


                <div class="col-md-12">
                    <button class="btn btn-sm  btn-success" data-bs-dismiss="modal"
                            wire:click='save'>{{ __('site.Save') }}</button>
                </div>
            </div>
        </div>
    </div>


    @if (!$current_user_session)
        <!-- Modal -->
        <div class="modal fade" id="startSession" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ __('Financial session') }}</h1>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning">يجب بدأ جلسة مالية من صفحة شاشة البيع.</div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('invoices.create') }}"
                           class="btn btn-danger btn-sm px-4">{{ __('Exit') }}</a>
                    </div>
                </div>
            </div>
        </div>
        @push('js')
            <script>
                window.onload = function () {
                    var myModal = new bootstrap.Modal(document.getElementById('startSession'));
                    myModal.show();
                }
            </script>
        @endpush
    @endif

</section>
