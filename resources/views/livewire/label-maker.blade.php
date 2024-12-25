<div class="">
    <style>
        .name,
        .price {
            font-size: 13px !important;
            font-weight: 500 !important;
        }
    </style>
    <h3 class="main-heading">@lang('Poster maker')</h3>
    <div class="box-white">
        <div class="inputs-holder d-flex flex-column gap-2">
            <div class="d-flex align-items-end justify-content-between gap-5 flex-wrap">
                <div class="inp-holder">
                    <select wire:model="department_id" class="main-select w-170px">
                        <option value="">@lang('Select section')</option>
                        @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="img-holder">
                    @if ($product)
                    {!! DNS1D::getBarcodeHTML($product->id . '', 'C128') !!}
                    @endif
                </div>
            </div>
            <div class="inp-holder">
                <select wire:model="product_id" class="main-select w-170px">
                    <option value="">@lang('Choose the product')</option>
                    @foreach ($products as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="inp-holder">
                <input type="number" min="0" value="{{ $product?->code }}" class="main-select w-170px" placeholder="@lang('Code number')">
            </div>
            <div class="btn-holder text-start">
                <button class="btn btn-purple btn-sm px-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa-solid fa-eye"></i>
                    @lang('Show')
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">@lang('Poster display')</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div class="inputs-holder d-flex flex-column justify-content-center align-items-center gap-1 w-100 mx-auto" id="prt-content-livewire">
                                    @if ($product)
                                    <div class="name">
                                        {{ $product->name }}
                                    </div>
                                    <div class="d-flex align-items-end justify-content-center gap-2 w-100 flex-wrap">
                                        <div class="img-holder">
                                            {!! DNS1D::getBarcodeHTML($product->id . '', 'C128') !!}
                                        </div>
                                    </div>
                                    <div class="price">
                                        @lang('the price') : {{ $product->saleprice }}
                                    </div>
                                    <div class="not-print btn-holder d-flex align-items-center justify-content-between gap-3 w-100 mt-2">
                                        <button type="button" class="btn btn-danger btn-sm w-100" data-bs-dismiss="modal">@lang('Back')</button>
                                        <button type="button" class="btn btn-warning btn-sm w-100" onclick='printDiv()'>
                                            <i class="fa-solid fa-print"></i>
                                            @lang('Print')
                                        </button>
                                    </div>
                                    @else
                                    <div class="alert alert-warning">@lang('You must choose the product first')</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // const myModalEl = document.getElementById('exampleModal')
        // myModalEl.addEventListener('show.bs.modal', event => {
        //     if (document.getElementById("prt-content-livewire")) {
        //         var btnPrtContent = document.getElementById("btn-prt-content-livewire");
        //         btnPrtContent.addEventListener("click", printDiv);


        //     }

        // })
        function printDiv() {
            var prtContent = document.getElementById("prt-content-livewire");
            newWin = window.open("");
            newWin.document.head.replaceWith(document.head.cloneNode(true));
            newWin.document.body.appendChild(prtContent.cloneNode(true));
            setTimeout(() => {
                newWin.print();
                newWin.close();
            }, 600);
        }
    </script>
</div>
