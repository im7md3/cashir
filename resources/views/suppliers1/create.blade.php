<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">اضافة مورد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row row-gap-24">

                    <div class=" col-sm-6">
                        <label class="small-label" for="">الاسم</label>
                        <input class="form-control" type="text"  value=""
                            placeholder="">
                    </div>
                    <div class=" col-sm-6">
                        <label class="small-label" for="">الجوال</label>
                        <input class="form-control" type="number" min="0"  placeholder=""
                            value="">
                    </div>
                    <div class=" col-sm-6">
                        <label class="small-label" for="">الشركة</label>
                        <input class="form-control" type="number"  min="0" placeholder=""
                            value="">
                    </div>


                    <div class="col-sm-6">
                        <label class="small-label" for="">الشارع</label>
                        <input class="form-control" type="text"  placeholder=""
                            value="" min="1">
                    </div>
                    <div class="col-sm-6">
                        <label class="small-label" for="">الرقم الضريبي</label>
                        <input class="form-control" type="text"  placeholder=""
                            value="" min="1">
                    </div>



                </div>
            </div>
            <input type="hidden" wire:model="id" class="form-control">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('site.Close') }}</button>
                <button  class="btn btn-success"
                    data-bs-dismiss="modal">حفظ</button>
            </div>
        </div>
    </div>
</div>
