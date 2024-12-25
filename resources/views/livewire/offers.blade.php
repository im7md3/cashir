<section class="content-section">
    <div class="container">
        @if ($screen == 'index')
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h4 class="main-heading mb-0">{{ __('site.offers') }}</h4>
            <a href="{{ route('settings.index') }}" class="btn btn-sm btn-secondary px-4">{{ __('site.Back') }}</a>
        </div>
        <div class="section-content bg-white rounded-3 p-4 shadow">
            <div class="btn-holder-option d-flex align-items-center justify-content-between mb-2">
                <button class="btn btn-success btn-sm" wire:click='$set("screen","create")'>{{ __('site.add_offer') }}</button>
                <button id="btn-prt-content" class="print-btn btn btn-sm btn-warning">
                    <i class="fa-solid fa-print"></i>
                </button>
            </div>
            <div class="table-responsive" id="prt-content">
                <x-header-invoice></x-header-invoice>
                <table class="table main-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('site.product_name') }}</th>
                            <th>{{ __('site.start') }}</th>
                            <th>{{ __('site.end') }}</th>
                            <th>{{ __('site.rate') }}</th>
                            <th>{{ __('site.Show Rate') }}</th>
                            <th class="text-center not-print">{{ __('site.Control') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($offers as $offer)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $offer->product->name ?? 'الكل' }}</td>
                            <td>{{ $offer->start }}</td>
                            <td>{{ $offer->end }}</td>
                            <td>%{{ $offer->rate }}</td>
                            <td>{{ $offer->show ? __('Yes') : __('No') }}</td>
                            <td class="not-print">
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    {{-- <a href="{{ route('front.offers_report',['offer'=>$offer->id]) }}" class="btn btn-sm trans-btn text-white">{{ __('admin.financial report') }}</a> --}}
                                    <button wire:click='edit({{ $offer }})' class="btn btn-sm btn-info text-white">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete_agent{{ $offer->id }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @include('offers.delete')
                        @endforeach
                    </tbody>
                </table>
                {{ $offers->links() }}
            </div>
        </div>
        @else
        @include('offers.add_or_edit')
        @endif
    </div>
</section>
