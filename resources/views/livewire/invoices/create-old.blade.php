<section class="app my-3">
    <x-messages></x-messages>
    <div class="row row-gap-24 cards hide-print">
        <div class="col-xl-2 special-col">
            <div class="card-app">
                <div class="title-card-app">
                    {{ __('site.Main_varieties') }}
                </div>
                <div class="body-card-app">
                    <div class="nav flex-column nav-pills main-tap " id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        @foreach ($departments as $depart)
                            <button class="nav-link mb-2 {{ $depart->id == $department_id ? 'active' : '' }}"
                                type="button"
                                wire:click='$set("department_id",{{ $depart->id }})'>{{ $depart->name }}</button>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 special-medal-col">

            <div class="card-app ">
                <div class="list-btn flex-wrap  justify-content-between">

                    <div class="d-flex align-items-center  justify-content-between flex-wrap flex-sm-nowrap gap-2">
                        <div class="text-info text-nowrap">
                            {{ __('site.Outstanding_billing') }}:
                        </div>
                        <select class="form-select" wire:model='unpaid_invoice_id' wire:change='edit'>
                            <option value="">{{ __('site.Choose_invoice') }}</option>
                            @foreach ($unpaid_invoices as $invoice)
                                <option value="{{ $invoice->id }}">{{ __('site.Invoice') }} {{ $invoice->id }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <b>{{ $date }}</b>
                        <div class="text-info">
                            {{ __('site.invoice_number') }}: {{ $invoice_id }}
                        </div>
                    </div>
                </div>
                <div class="title-card-app  d-flex align-items-center flex-wrap gap-2 justify-content-between ">
                    <div class="d-flex  align-items-center  gap-1 ">
                        <input type="text" wire:model.defer="client_phone" id="" class="form-control w-60"
                            placeholder="{{ __('site.Search_By_Customer_mobile') }}">
                        <input readonly type="text" class="{{ $client ? '' : 'd-none' }} form-control w-25"
                            value="{{ $client?->name }}">
                        <button wire:click='getClient' class="btn btn-sm btn-primary">{{ __('site.search') }}</button>
                    </div>
                    {{ __('site.List_of_subcategories') }}
                </div>
                <div class="body-card-app ">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="">
                            <h5 class="text-center mt-2 mb-4">
                                {{ App\Models\Department::find($department_id)?->name }}
                            </h5>
                            <div class="list-orders">
                                @foreach ($products as $product)
                                    <div class="order-btn"
                                        @if (!$product->allow_quantity || ($product->allow_quantity && $product->quantity > 0)) wire:click='add_product({{ $product }})' @endif>
                                        @if ($product->cover)
                                            <img src="{{ asset('img/products/' . $product->cover) }}"
                                                alt="{{ $product->name }}" class="img-thumbnail" width="70px">
                                        @else
                                            <img src="{{ asset('img/no-image.jpg') }}" alt="{{ $product->name }}"
                                                class="img-thumbnail" width="70px">
                                        @endif
                                        <div
                                            class="about-product btn btn-primary btn-sm {{ !$product->allow_quantity || ($product->allow_quantity && $product->quantity > 0) ? 'btn-primary' : 'btn-danger' }}">
                                            <span>{{ $product->name }}</span>
                                            <span>{{ number_format($product->saleprice, 2) }}
                                                {{ __('site.R.S') }}</span>
                                            <!-- <span>الكميه {{ $product->quantity ?? 0 }}</span> -->
                                        </div>
                                        {{-- @if ($product->allow_quantity)
                                            @if ($product->quantity > 0)
                                                <small> {{ __('site.Quantity') }}: {{ $product->quantity }}</small>
                                            @else
                                                <small>لا يوجد كمية</small>
                                            @endif
                                        @endif --}}

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card-app">
                <div class="body-card-app">
                    <div class=" box-table ">
                        <table class="table">
                            <tr>
                                <th>{{ __('site.M') }}</th>
                                <th>{{ __('site.item') }}</th>
                                <th>{{ __('site.Quantity') }}</th>
                                <th>{{ __('site.price') }}</th>
                                <th>{{ __('site.Total') }}</th>
                                <th>{{ __('site.delete') }}</th>
                            </tr>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($items as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item['name'] }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-1">
                                            <div class="add-num control-num"
                                                wire:click="increment({{ $key }})">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                            <input class="form-control p-1" type="text" min="1" readonly
                                                wire:model="items.{{ $key }}.quantity">
                                            <div class="decrease-num control-num"
                                                wire:click="decrement({{ $key }})">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                        </div>
                                        <!-- <script>
                                            let addNum = document.querySelectorAll(".add-num");
                                            addNum.forEach((ele) => {
                                                ele.addEventListener("click", () => {
                                                    let inpNum = ele.parentElement.querySelector("input[type='number']");
                                                    inpNum.value = +inpNum.value + 1;
                                                })
                                            });
                                            let decreaseNum = document.querySelectorAll(".decrease-num");
                                            decreaseNum.forEach((ele) => {
                                                ele.addEventListener("click", () => {
                                                    let inpNum = ele.parentElement.querySelector("input[type='number']");
                                                    if (+inpNum.value >= 1) {
                                                        inpNum.value = +inpNum.value - 1;
                                                    }
                                                })
                                            });
                                        </script> -->
                                    </td>
                                    <td>{{ $item['saleprice'] }}</td>
                                    <td>{{ $item['quantity'] * $item['saleprice'] }} </td>
                                    <td class="text-center">
                                        <div class="btn btn-sm btn-danger py-0 px-1"
                                            wire:click="delete_item({{ $key }})">
                                            <i class="fas fa-trash-can"></i>
                                        </div>
                                    </td>
                                </tr>
                                @php
                                    $total += $item['quantity'] * $item['saleprice'];
                                @endphp
                            @endforeach
                            {{-- <tr class="footer-table">
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="num">0.00</div>
                                </td>
                                <td>
                                    <div class="num">{{ $total }}</div>
                                </td>
                                <td>
                                    <div class="num">0.00</div>
                                </td>
                                <td></td>
                            </tr> --}}
                        </table>
                    </div>
                </div>
                <div class="title-card-app text-start mt-3">
                    {{ __('site.Totals') }}
                </div>
                <div class="body-card-app pt-2">
                    <div class="d-flex align-items-center  mb-2 gap-2 justify-content-end">
                        <label for="" class="text-info">
                            {{ __('site.Amount_of_the_invoice') }}:
                        </label>
                        <input readonly type="number" min="0" id="" class="form-control w-60"
                            value="{{ $price }}">
                    </div>
                    <div class="d-flex align-items-center gap-2 mb-2 justify-content-end">
                        <label for="" class="text-info">
                            {{ __('site.Discount') }}:
                        </label>
                        <input type="text" wire:model="discount" class="form-control w-60">
                    </div>

                    <div class="d-flex align-items-center gap-2 mb-2 justify-content-end">
                        <label for="" class="text-info"> {{ __('site.Discount_Offers') }} :</label>
                        <input readonly type="text" placeholder="0" class="form-control w-60"
                            wire:model="offers_discount" />
                    </div>
                    <div class="d-flex align-items-center gap-2 mb-2 justify-content-end">
                        <label for="" class="text-info">
                            {{ __('site.Amount after discount of offers') }}:</label>
                        <input readonly type="text" placeholder="0" class="form-control w-60"
                            wire:model="amount_after_offers_discount" />
                    </div>

                    <div class="d-flex align-items-center gap-2 mb-2 justify-content-end">
                        <label for="" class="text-info">
                            {{ __('site.Tax') }}:
                        </label>
                        <input readonly type="number" min="0" id="" class="form-control w-60"
                            value="{{ $tax }}">
                    </div>
                    <div class="d-flex align-items-center gap-2  mb-2  justify-content-end">
                        <label for="" class="text-danger">
                            {{ __('site.final_total') }}:
                        </label>
                        <input type="number" min="0" id="" readonly
                            value="{{ $total + $tax - $discount - $offers_discount }}"
                            class="form-control text-danger w-60">
                    </div>

                    <div class="d-flex align-items-center gap-2 mb-2 justify-content-end">
                        <label for="" class="text-info">
                            {{ __('site.cash_Money') }}:
                        </label>
                        <input type="number" min="0" class="form-control w-60" wire:model="cash">
                    </div>
                    <div class="d-flex align-items-center gap-2 mb-2 justify-content-end">
                        <label for="" class="text-info">
                            {{ __('site.Network_pay') }} - {{ __('site.Mada') }}:
                        </label>
                        <input type="number" min="0" class="form-control w-60" wire:model="card">
                    </div>

                    <div class="d-flex align-items-center gap-2 mb-2">
                        <label for="" class="text-info">
                            {{ __('site.not_paid') }}
                        </label>
                        <input type="checkbox" wire:model="not_paid">
                    </div>

                </div>
            </div>
        </div>

    </div>
    <div class="row hide-print">
        <div class="col-xl-4 me-auto">
            <div class=" btns-control row my-3 row-gap-24">
                <div class="col-sm-4">
                    <button wire:click='submit("card","unpaid")' class="btn-sm   btn-danger btn">
                        {{ __('site.Invoice_suspension') }}
                    </button>
                </div>
                <div class="col-sm-4">
                    <button wire:click='submit("cash")' onclick="/*ourprint();*/" class="btn-sm   btn-success btn">
                        <!-- <input class="form-check-input choose" type="checkbox" value=""> -->
                        {{ __('site.Pay') }}
                    </button>
                </div>
                {{-- <div class="col-sm-4">
                    <button wire:click='submit("card")' class="btn-img btn">
                        <!-- <input class="form-check-input choose" type="checkbox" value="" id=""> -->
                        <img src="{{ asset('img/mada-logo-474-Px.png') }}" alt="">
                    </button>
                </div> --}}
            </div>
        </div>
    </div>


    {{-- ------------عرض الفاتورة------------- --}}


    <div class="invoice-content bg-white shadow rounded-3 pb-2 invoice-print" id="invoice-print"
        style="display: none">
        <h1 class="invoice-name text-center rounded-3 fw-bold mb-0 pt-2">
            {{ __('site.Bill_Number') }}
            <br>
            #{{ $invoice->id ?? 0 }}
        </h1>
        <h4 class="  mb-2 fw-bold mb-3 text-center mt-2">
            {{ setting('website_name') }}
        </h4>
        <div class="the_date d-flex align-items-center justify-content-evenly mb-3">
            <div class="date-holder ">
                <small>{{ $invoice->date ?? '' }}</small>
            </div>
            <div class="date-holder ">
                <small>{{ isset($invoice) ? $invoice->created_at->format('H:i a') : '' }}</small>
            </div>
        </div>
        <div class="logo-holder m-auto text-center  rounded-3 mb-3">
            <img class="the_image mx-auto  h-auto rounded-3" src="{{ display_file(setting('logo_img')) }}"
                width="150" alt="logo">
        </div>
        <div class="me-2">
            <div class="tax-number  mb-2 fw-bold">
                <small>{{ __('site.Tax_Number') }} : <span class="">{{ setting('tax_no') }}</span></small>
            </div>
            <div class="the_address mb-4 fw-bold">
                <div class="address-holder">
                    <small>{{ setting('address') }}</small>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table main-table text-center rounded-3 w-100">
                <thead class="border-0">
                    <tr>

                        <th class="">
                            <div>{{ __('site.Description') }}</div>
                            <div class="">Description</div>
                        </th>

                        <th class="">
                            <div class="">{{ __('site.price') }}</div>
                            <div class="">price</div>
                        </th>

                        <th>
                            <div class="">{{ __('site.Quantity') }}</div>
                            <div class="">Qty</div>
                        </th>

                        <th>
                            <div class="">{{ __('site.The_Tax') }}</div>
                            <div class="">Vat</div>
                        </th>
                        <th>
                            <div class="">{{ __('site.Total') }}</div>
                            <div class="">Total</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoice->items ?? [] as $item)
                        <tr>
                            <td>
                                {{ $item->name }}
                            </td>
                            <td>
                                {{ $item->product->saleprice }}
                            </td>
                            <td>
                                {{ $item->quantity }}
                            </td>
                            <td>
                                {{ $item->tax }}
                            </td>
                            <td>
                                {{ $item->total }}
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="table-responsive second-table mt-2">
            <table class="table main-table" id="data-table">
                <tbody>
                    <tr>
                        <td colspan="2" class="text-end ">
                            <div class="text-center spechial-text">{{ __('site.Total_before_discount_and_tax') }}
                            </div>
                            <div class="text-center spechial-text">Total before deduction and tax</div>
                        </td>
                        <td colspan="2"> {{ $invoice->price ?? '' }}</td>
                    </tr>

                    <tr>
                        <td colspan="2" class="text-end ">
                            <div class="text-center spechial-text">{{ __('site.value_added_tax') }}</div>
                            <div class="text-center spechial-text">value added tax</div>
                        </td>
                        <td colspan="2"> {{ $invoice->tax ?? '' }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-end ">
                            <div class="text-center spechial-text"> {{ __('site.Discount') }} Dicsc</div>
                            <!-- <div class="text-center spechial-text"></div> -->
                        </td>
                        <td colspan="2"> {{ $invoice->discount ?? '' }}</td>
                    </tr>
                    <tr class="">
                        <td colspan="1" class="text-end ">
                            <div class="text-center spechial-text"> {{ __('site.Total') }} Total</div>
                            <!-- <div class="text-center spechial-text"></div> -->
                        </td>
                        <td colspan="3 " class="">{{ $invoice->total ?? '' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>


        <div class="bar_code_holder text-center">
            {!! $qrCode ?? '' !!}
        </div>
        <div class="d-flex justify-content-center not-print mt-3">
            <button class="btn btn-sm btn-info" onclick="print()">print</button>
        </div>

    </div>
    <style>
        @media print {
            .hide-print {
                display: none;
            }

            .invoice-print {
                display: block !important;
            }
        }
    </style>
    {{-- <script>
        const myTimeout = setTimeout(Printing, 3000);

        function Printing() {
            @if ($invoice != null && $invoice->id != null && $invoice->id != 0)
                window.print();
            @endif
        }
    </script> --}}
</section>
