<section class="app my-0">
    {{-- Swiper Css --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        .swiper-wrapper {
            padding-inline: 2.5rem !important;
        }

        .swiper-slide {
            width: fit-content !important;
        }
    </style>
    <div class="container-fluid">

        {{-- <div id="fullscreen-alert" class="alert alert-warning" style="display: none;"> --}}
        {{-- قم بالضغط علي F11 لتجربة افضل --}}
        {{-- </div> --}}
        <div class="row g-3 cards hide-print">
            {{-- <div class="col-xl-2 special-col">
                <div class="card-app">
                    <div class="title-card-app">
                        {{ __('main items') }}
        </div>
        <div class="body-card-app">
            <div x-data="{ departmentId: @entangle('department_id') }"
                class="nav flex-column nav-pills main-tap" id="v-pills-tab" role="tablist"
                aria-orientation="vertical">
                @foreach ($departments as $depart)
                <button class="nav-link mb-2" :class="{ 'active': departmentId == {{ $depart->id }} }"
                    type="button" @click="departmentId = {{ $depart->id }}">
                    {{ $depart->name }}
                </button>
                @endforeach
            </div>
        </div>
    </div>
    </div> --}}
            <div class="col-md-8">
                <div class="swiper my-2" x-data="{ departmentId: @entangle('department_id') }">
                    <div class="swiper-wrapper">
                        @foreach ($departments as $depart)
                            <div class="swiper-slide">
                                <button class="btn btn-sm btn-primary mx-1"
                                    :class="{ 'active': departmentId == {{ $depart->id }} }" type="button"
                                    @click="departmentId = {{ $depart->id }}">
                                    {{ $depart->name }}
                                </button>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
                <div class="card-app ">
                    <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap p-2">
                        <p class="mb-0 fs-10px">
                            <span>{{ __('Session start') }} :- {{ $current_user_session?->start_time }} </span>
                            <span>{{ __('site.Employee_Name') }} :- {{ auth()->user()->name }} </span>

                        </p>
                        <button class="btn btn-sm btn-danger px-3" data-bs-toggle="modal"
                            wire:click="calculateEndAmount"
                            data-bs-target="#endSession">{{ __('End session') }}</button>
                    </div>
                    <div class="title-card-app  d-flex align-items-center flex-wrap gap-2 justify-content-between ">
                        <div class="d-flex  align-items-center  gap-1 ">
                            <input type="text" wire:model.defer="client_phone" wire:keydown.enter="getClient"
                                id="" class="form-control w-60"
                                placeholder="{{ __('site.Search_By_Customer_mobile') }}">
                            <input readonly type="text" class="{{ $client ? '' : 'd-none' }} form-control w-25"
                                value="{{ $client?->name }}">
                            <button wire:click='getClient'
                                class="btn btn-sm btn-primary">{{ __('site.search') }}</button>
                        </div>
                        {{ __('sub items') }}
                    </div>
                    <div class="list-btn flex-wrap justify-content-between">
                        <div class="d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap gap-2">
                            <div class="text-info text-nowrap">
                                {{ __('unpaid invoices') }}:
                            </div>
                            <select class="form-select fs-12px" wire:model='unpaid_invoice_id' wire:change='edit'>
                                <option value="">{{ __('site.Choose_invoice') }}</option>
                                @foreach ($unpaid_invoices as $invoice)
                                    <option value="{{ $invoice->id }}">{{ __('site.Invoice') }} {{ $invoice->id }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <div class="text-info">
                                {{ __('site.invoice_number') }}: {{ $invoice_id }}
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="form-group d-flex">
                                <label for="" class="text-nowrap mx-1">{{ __('search by barcode') }}</label>
                                <input type="number" min="0" class="form-control" wire:model='barcode'
                                    wire:keyup.debounce='add_product_barcode'>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if (setting('acivate_categories'))
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="border rounded p-2 category-holder" x-data="{ departmentId: @entangle('department_id') }">
                                    <div class="row g-3">
                                        @foreach ($departments as $depart)
                                            <div class="col-12 col-md-6">
                                                <button class="box-category w-100" type="button"
                                                    @click="departmentId = {{ $depart->id }}">
                                                    <img src="{{ $depart->image ? display_file($depart->image) : asset('img/products/kbtshyno.jpg') }}"
                                                        class="img-category" alt="">
                                                    <div class="title">
                                                        {{ $depart->name }}
                                                    </div>
                                                </button>

                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="{{ setting('acivate_categories') ? 'col-12 col-md-6 col-lg-8' : 'col-12' }}">
                            <div class="body-card-app content py-2">

                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="">
                                        <div class="list-orders">
                                            @forelse ($products as $product)
                                                <div x-data="{ canAddProduct: @json(!$product->allow_quantity || ($product->allow_quantity && $product->quantity > 0)) }"
                                                    @click="canAddProduct ? @this.call('add_product', {{ $product->id }}) : null"
                                                    class="order-btn">
                                                    @if ($product->cover)
                                                        <img src="{{ asset('uploads/' . $product->cover) }}"
                                                            alt="{{ $product->name }}" class="img-thumbnail"
                                                            width="100px">
                                                    @else
                                                        <img src="{{ asset('img/no-image.jpg') }}"
                                                            alt="{{ $product->name }}" class="img-thumbnail"
                                                            width="100px">
                                                    @endif
                                                    <div
                                                        class="about-product btn btn-primary btn-sm {{ !$product->allow_quantity || ($product->allow_quantity && $product->quantity > 0) ? 'btn-primary' : 'btn-danger' }}">
                                                        <span>{{ $product->name }}</span>
                                                        <span>{{ number_format($product->saleprice, 2) }}
                                                            {{ __(setting('default_currency')) }}</span>
                                                        <!-- <span>الكميه {{ $product->quantity ?? 0 }}</span> -->
                                                    </div>

                                                </div>
                                            @empty
                                                <div class="alert alert-warning">لا يوجد منتجات</div>
                                            @endforelse

                                            {{ $products ? $products->links() : null }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex justify-content-end my-2">
                    <a href="{{ route('home') }}" class="btn btn-sm btn-secondary px-4">
                        الرجوع للواجهة
                        <i class="fas fa-angle-left"></i>
                    </a>
                </div>
                <div class="card-app">
                    <div class="body-card-app">
                        <div class="box-table" style="height: 175px;">
                            <table class="table text-center shadow-none mb-0 ">
                                <tr>
                                    <th>{{ __('serial number') }}</th>
                                    <th>{{ __('item') }}</th>
                                    <th>{{ __('quantity') }}</th>
                                    <th>{{ __('price') }}</th>
                                    <th>{{ __('total') }}</th>
                                    <th>{{ __('delete') }}</th>
                                </tr>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($items as $key => $item)
                                    <tbody>

                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item['name'] }}</td>
                                            <td class="w-25">
                                                <div class="d-flex align-items-center justify-content-center  gap-2">
                                                    <div class="add-num control-num"
                                                        wire:click="increment({{ $key }})">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </div>
                                                    <input class="form-control p-1 text-center " type="number"
                                                        style="width: 50px" min="1" readonly
                                                        wire:model="items.{{ $key }}.quantity">
                                                    <div class="decrease-num control-num"
                                                        wire:click="decrement({{ $key }})">
                                                        <i class="fa-solid fa-minus"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ round($item['price'], 2) }}</td>
                                            <td>{{ round($item['quantity'] * $item['price'], 2) }} </td>
                                            <td class="text-center">
                                                <div class="btn btn-sm btn-danger py-0 px-1"
                                                    wire:click="delete_item({{ $key }})">
                                                    <i class="fas fa-trash-can"></i>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    @php
                                        $total += $item['quantity'] * $item['price'];
                                    @endphp
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="body-card-app pt-2">
                        @if (setting('active_bouquet'))
                            <div class="d-flex align-items-center  mb-2 gap-2 justify-content-end">
                                <label for="" class="text-info">
                                    استخدام رصيد الباقة
                                </label>
                                <input
                                    {{ !$client?->package || $client?->invoices()->sum('package_balance') == $client?->package->total_price
                                        ? 'disabled'
                                        : '' }}
                                    type="checkbox" id="" wire:model='use_package' class="form-check w-60"
                                    value="">

                            </div>
                        @endif
                        <div class="d-flex align-items-center mb-2 gap-2 justify-content-end">
                            @if ($client)
                                @if (!$client?->package)
                                    <span class="text-danger">لا يوجد باقة لهذا العميل</span>
                                @elseif($client?->invoices()->sum('package_balance') == $client?->package->total_price)
                                    <span class="text-danger">يوجد باقة للعميل ولكن انتهي رصيد الباقة</span>
                                @endif
                            @endif
                        </div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class=" mb-2 gap-2 ">
                                        <label for="" class="text-info ">
                                            {{ __('invoice amount') }}:
                                        </label>
                                        <input readonly type="text" min="0" id=""
                                            class="form-control w-100" value="{{ round($price, 2) }}">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class=" align-items-center gap-2 mb-2 justify-content-start">
                                        <label for="" class="text-info">
                                            {{ __('discount') }}:
                                        </label>
                                        <input type="number" min="0" step="0.1" id="numericInput3"
                                            wire:model="discount" class="form-control w-100">
                                    </div>
                                </div>
                                @if ($offers_discount > 0)
                                    <div class="col-12 col-lg-6">
                                        <div class="d-flex align-items-center gap-2 mb-2 justify-content-end">
                                            <label for="" class="text-info"> {{ __('site.Discount_Offers') }}
                                                :</label>
                                            <input readonly type="text" placeholder="0" class="form-control w-60"
                                                wire:model="offers_discount" />
                                        </div>
                                        <div class="d-flex align-items-center gap-2 mb-2 justify-content-end">
                                            <label for="" class="text-info">
                                                {{ __('site.Amount after discount of offers') }}:</label>
                                            <input readonly type="text" placeholder="0" class="form-control w-60"
                                                wire:model="amount_after_offers_discount" />
                                        </div>
                                    </div>
                                @endif
                                @if (setting('active_tax'))
                                    <div class="col-12 col-lg-6">
                                        <div class=" align-items-center gap-2 mb-2 justify-content-end">
                                            <label for="" class="text-info">
                                                {{ __('tax') }}:
                                            </label>
                                            <input readonly type="text" min="0" id=""
                                                class="form-control w-100" value="{{ round($tax, 2) }}">
                                        </div>
                                    </div>
                                @endif

                                @if (setting('activate_package_balance'))
                                    <div class="col-12 col-lg-6">
                                        <div class=" align-items-center gap-2 mb-2 justify-content-end">
                                            <label for="" class="text-info">
                                                {{ __('package balance') }} :
                                            </label>
                                            <input readonly type="text" min="0" class="form-control w-100"
                                                wire:model="package_balance">
                                        </div>
                                    </div>
                                @endif
                                <div class="col-12 col-lg-6">

                                    <div class=" align-items-center gap-2 mb-2 justify-content-end">
                                        <label for="" class="text-info">
                                            {{ __('rest') }}
                                        </label>
                                        <input type="text" min="0" readonly class="form-control w-100"
                                            wire:model="rest">
                                    </div>
                                </div>

                            </div>
                        </div>

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
                                                class="form-control number-only" wire:keyup='calculateRest'>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="box-final-total">
                            <div class="title">
                                {{ __('site.final_total') }}
                            </div>
                            <div class="price">
                                {{ round(floatval($total) + floatval($tax) - floatval($discount) - floatval($offers_discount), 2) }}
                                ر.س
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btns-control row ms-auto hide-print justify-content-end my-2 row-gap-24">
                    @if ($items)
                        <div class="col-sm-4">
                            <button wire:click='deleteItems' class="btn-sm fs-12px btn-dark btn">
                                {{ __('site.delete_cart') }}
                            </button>
                        </div>
                    @endif
                    <div class="col-sm-4">
                        <button wire:click='submit("unpaid")' class="btn-sm fs-12px btn-danger btn">
                            {{ __('site.Invoice_suspension') }}
                        </button>
                    </div>
                    <div class="col-sm-4">
                        <button wire:click='submit("paid")' onclick="/*ourprint();*/"
                            class="btn-sm btn-success btn fs-12px">
                            {{ __('pay') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="free_invoice" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close btn-cls" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ __('free_invoice') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm  btn-danger"
                        data-bs-dismiss="modal">{{ __('back') }}</button>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            window.livewire.on('free-invoice', () => {
                var myModal = new bootstrap.Modal(document.getElementById("free_invoice"), {});
                myModal.show();
            });
        </script>
    @endpush



    <div class="modal fade" id="endSession" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ __('End of financial session') }}</h1>
                </div>
                <div class="modal-body" id='prt-content'>
                    <div class="alert alert-primary mb-2 py-2 not-print">
                        {{ __('At the beginning of the work, the available amount must be written in the drawer and the
                                                                                                                                                                                                                                                                                                                                                                                                                                                work session is closed at the end') }}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover main-table mb-0">
                            <tbody>
                                <tr>
                                    <th>{{ __('site.Employee_Name') }}</th>
                                    <td>{{ auth()->user()->name }}</td>
                                </tr>
                                <tr>
                                    <th>مبلغ الدرج عند بدء الجلسة</th>
                                    <td>{{ $current_user_session?->start_amount }}</td>
                                </tr>

                                <tr>
                                    <th>{{ __('Amount available in the fund') }}</th>
                                    <td>
                                        <input type="text" wire:model="end_amount" class="form-control w-50">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning btn-sm px-4" id="btn-prt-content">طباعه</button>
                    <button type="button" class="btn btn-primary btn-sm px-4" wire:click="endSession">حفظ</button>

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
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <tbody>
                                    <tr>
                                        <th>{{ __('site.Employee_Name') }}</th>
                                        <td>{{ auth()->user()->name }}</td>
                                    </tr>
                                    @if (auth()->user()->payment_method_id)
                                        <tr>
                                            <th>
                                                {{ __('Amount available in the fund') }}
                                            </th>
                                            <td>
                                                <input type="text" wire:model="start_amount"
                                                    class="form-control w-auto">
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <th colspan="2">
                                                <div class="alert alert-warning">
                                                    {{ __('The sales screen can only be operated after the cash box is selected
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                for the employee or cashier.') }}
                                                    <a href="{{ route('admins.index') }}">{{ __('here') }}</a>
                                                </div>
                                            </th>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('home') }}" class="btn btn-danger btn-sm px-4">{{ __('Exit') }}</a>
                        @if (auth()->user()->payment_method_id)
                            <button type="button" class="btn btn-primary btn-sm px-4"
                                wire:click="saveSession">{{ __('Save') }}</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @push('js')
            <script>
                window.onload = function() {
                    var myModal = new bootstrap.Modal(document.getElementById('startSession'));
                    myModal.show();
                }
            </script>
        @endpush
    @endif
    {{-- Siwper Script --}}
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            const swiper = new Swiper('.swiper', {
                slidesPerView: "auto",
                spaceBetween: 6,
                loop: true,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        </script>


        <script>
            document.querySelectorAll('.number-only').forEach(function(element) {
                element.addEventListener('input', function() {
                    this.value = this.value.replace(/[^0-9]/g, '');
                });
            });
        </script>
    @endpush
</section>
