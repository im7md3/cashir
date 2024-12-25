<div class="modal fade" id="add_or_update_bonds" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <div class="modal-body">
                <div class="collectData-box mb-2">
                    <label for="" class="small-label mb-1">رقم الفاتورة</label>
                    <input readonly type="text" wire:model.defer="invoice_id" id=""
                        class="w-100 form-control">
                </div>
                <div class="collectData-box mb-2">
                    <label for="" class="small-label mb-1">{{ __('Client') }}</label>
                    <input type="text" readonly wire:model="client" id="" class="w-100 form-control">
                </div>
                <div class="collectData-box mb-2">
                    <label for="" class="small-label mb-1">المتبقي</label>
                    <input type="text" readonly wire:model="invoice_rest" id="" class="w-100 form-control">
                </div>
                <div class="collectData-box mb-2">
                    <label for="" class="small-label mb-1">{{ __('amount') }}</label>
                    <input type="text" wire:model="amount" id="" class="w-100 form-control">
                </div>
                <div class="collectData-box mb-2">
                    <label for="" class="small-label mb-1">الحالة</label>
                    <select wire:model="status" id="" class="w-100 form-control">
                        <option value="creditor">دائن</option>
                        <option value="debtor">مدين</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">رجوع</button>
                <button class="btn btn-sm  btn-success" data-bs-dismiss="modal" wire:click='save'>حفظ</button>
            </div>

        </div>

    </div>
</div>
