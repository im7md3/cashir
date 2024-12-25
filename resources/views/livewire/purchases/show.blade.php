<div class="section-content p-4 bg-white rounded-3 shadow">
    <div class="d-flex justify-content-end mb-3">
        <button id="btn-prt-content" class="btn btn-sm btn-warning">
            <i class="fa-solid fa-print"></i>
        </button>
    </div>
    <div class="row" id="prt-content">
        <div class="col-md-4">
            <div class="d-flex flex-column mb-2">
                <label for="" class="small-label mb-1">المستودع</label>
                <input disabled type="text" value="{{ $purchase_invoice->warehouse->name }}"
                    class="w-100 form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="d-flex flex-column mb-2">
                <label for="" class="small-label mb-1">المورد</label>
                <input disabled type="text" value="{{ $purchase_invoice->supplier->name }}"
                    class="w-100 form-control">
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="d-flex flex-column mb-2">
                <label for="" class="small-label mb-1">التاريخ</label>
                <input disabled type="text" value="{{ $purchase_invoice->date }}" class="w-100 form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="d-flex flex-column mb-2">
                <label for="" class="small-label mb-1">{{ __('admin.amount') }}</label>
                <input type="text" value="{{ $purchase_invoice->amount }}" disabled class="w-100 form-control">
            </div>
        </div>

        <div class="col-md-4">
            <div class="d-flex flex-column mb-2">
                <label for="" class="small-label mb-1">{{ __('admin.tax') }}</label>
                <input type="text" value="{{ $purchase_invoice->tax }}" class="w-100 form-control">
            </div>
        </div>

        <div class="col-md-4">
            <div class="d-flex flex-column mb-2">
                <label for="" class="small-label mb-1">{{ __('admin.total') }}</label>
                <input type="text" value="{{ $purchase_invoice->total }}" disabled class="w-100 form-control">
            </div>
        </div>


        <div class="col-12 mt-3 mb-3">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th width="20%">@lang('admin.Barcode')</th>
                            <th width="30%">@lang('admin.Product_name')</th>
                            <th>@lang('admin.the_quantity')</th>
                            <th>@lang('admin.cost_price')</th>
                            <th>@lang('admin.sell_price')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchase_invoice->items as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->item->barcode }}</td>
                                <td>{{ $item->item->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->cost_price }}</td>
                                <td>{{ $item->sell_price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>
