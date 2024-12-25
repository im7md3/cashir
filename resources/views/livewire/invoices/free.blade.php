<section class="main-section home">
    <div class="container">
        <x-messages></x-messages>
        <h4 class="main-heading">عملاء الفواتير المجانية</h4>
        <div class="box-content">
            <div class="d-flex align-items-center gap-3 mb-1 flex-wrap">
                <div dir="ltr" class="d-flex align-items-center justify-content-end">
                    <button id="button-addon2" type="button" class="btn btn-success rounded-0 input-group-addon">
                        {{ __('site.search') }}
                    </button>
                    <input dir="rtl" type="text" class="form-control h-100"
                        placeholder="ابحث باسم او هاتف العميل" wire:model='search'>
                </div>
            </div>

            <div class="table-responsive mb-4">
                <table class="table main-table" id="data-table">
                    <thead>
                        <tr>
                            <th>{{ __('site.Client') }}</th>
                            <th>{{ __('phone') }}</th>
                            <th>عدد الجلسات</th>
                            <th>مبلغ الجلسات المجانية</th>
                            <th>عدد الجلسات المجانية</th>
                            <th>{{ __('site.Control') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                        <tr>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->invoices_number }}</td>
                            <td>{{ $client->invoices_amount }}</td>
                            <td>{{ $client->free_count }}</td>
                            <td>
                                <div class="d-flex align-items-center  gap-1">
                                    <button  class="btn btn-sm btn-secondary" wire:click='free({{ $client }})' @disabled($client->invoices_number < 10 and $client->invoices_amount < setting('amount_free_invoice'))>
                                        جلسة مجانية
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $clients->links() }}
            </div>
        </div>
    </div>
</section>