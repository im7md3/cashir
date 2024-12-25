<div class="">
    <x-messages></x-messages>
    <h4 class="main-heading d-flex align-items-center justify-content-between flex-wrap gap-3">
        {{ __('site.Using packages') }}
        <a href="{{route('packages')}}" class="btn btn-sm btn-secondary">
            رجوع
            <i class="fas fa-angle-left"></i>
        </a>
    </h4>
    <div class="box-content">
        <div class="d-flex align-items-end justify-content-between gap-2 mb-2 flex-wrap">
            <button class="btn btn-info btn-sm">{{ __('site.Number subscribers') }}
                {{ $clients->count() }}
            </button>
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <input dir="rtl" type="text" class="form-control w-auto" placeholder="{{ __('site.Search_by_customer_name') }}">
                <input dir="rtl" type="text" class="form-control w-auto" placeholder="{{ __('site.Search_By_Customer_mobile') }}">
            </div>
            {{-- <div class="d-flex align-items-center gap-2 flex-wrap flex-lg-nowrap">
                <div class=" w-100">
                    <label for="" class="small-label">{{ __('site.From') }}</label>
            <input type="date" class="form-control w-100">
        </div>
        <div class="w-100">
            <label for="" class="small-label">{{ __('site.To') }}</label>
            <input type="date" class="form-control w-100">
        </div>
    </div> --}}
</div>
{{-- <div class="d-flex justify-content-end mb-2">
            <button class="btn btn-success btn-sm">{{ __('site.add') }}
</button>
</div> --}}
<div class="table-responsive">
    <table class="table main-table">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('site.Name') }}</th>
                <th>الباقة</th>
                <th>{{ __('package balance') }}</th>
                <th>{{ __('site.rest') }}</th>
                <th>{{ __('site.Invoices') }}</th>
                {{-- <th class="text-center">{{ __('site.Control') }}</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
            <tr>
                <td>{{ $loop->index }}</td>
                <td>{{ $client->name }}</td>
                <td>{{ $client->package?->name }}</td>
                {{-- <td>2022/2/2</td>  --}}
                <td>{{ $client->package?->total_price }}</td>
                <td>{{ $client->package?->total_price - $client->invoices()->sum('package_balance') }}</td>
                <td>
                    <a href="{{ route('invoices.index',['package_client' => $client->id]) }}" class="btn btn-sm btn-warning">
                        الفواتير
                    </a>
                </td>
                {{-- <td>
                            <div class="d-flex flex-wrap align-items-center justify-content-center gap-1">
                                <button type="button" class="btn btn-sm btn-primary">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </td>  --}}
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
</div>
