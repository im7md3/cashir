<div class="box-header-invoice">
    <div class="row">
        <div class="col-12">
            <p class="text-center">{{ setting('website_name') }}</p>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            @if (setting('active_tax'))
                <small class="mb-1 d-block">الرقم الضريبي: {{ setting('tax_no') }}</small>
            @endif
            <small class="mb-1 d-block">
                العنوان: {{ setting('address') }} - {{ setting('street') }} - {{ setting('building_no') }}
            </small>
            <small class="mb-1 d-block">الهاتف: {{ setting('phone') }}</small>
        </div>
        <div class="text-center col-md-4  d-flex align-items-center justify-content-center">
            <img src="{{ display_file(setting('logo_img')) }}" alt="" width="70">
        </div>
    </div>
</div>
