<div class="">
    <x-messages></x-messages>
    <h4 class="main-heading">{{ __('site.Products') }}</h4>
    <div class="box-content">
        @if ($screen == 'index')
        <div class="d-flex align-items-center gap-3 justify-content-between flex-wrap mb-3">
            <div dir="ltr" class="d-flex align-items-center justify-content-end">
                <div x-data="{ searchdepart: @js($searchdepart) }">
                    <select x-model="searchdepart" class="main-select"
                        @change="$wire.set('searchdepart', searchdepart)">
                        <option value="">{{ __('site.Department_search') }}</option>
                        @foreach (\App\Models\Department::get() as $department)
                        <option value="{{ $department->name }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
                @if (setting('is_branches_active'))
                <div x-data="{ filter_branch_id: @js($filter_branch_id) }">
                    <select x-model="filter_branch_id" class="main-select"
                        @change="$wire.set('filter_branch_id', filter_branch_id)">
                        <option value="">{{ __('site.branch_id') }}</option>
                        @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif

            </div>
            <div x-data class="filter-holder">
                <button @click="$wire.set('filter_end_quantity', '1')" class="btn btn-sm bg-primary text-light">
                    @lang('Out of stock products') :
                    {{ App\Models\Product::where('allow_quantity', 1)->where('quantity', '0')->count() }}
                </button>
                <button @click="$wire.set('filter_out_of_date', '1')" class="btn btn-sm bg-warning text-light">
                    @lang('Expired products') :
                    {{ App\Models\Product::whereNotNull('end_date')->whereDate('end_date', '<', date('Y-m-d'))->count() }}
                </button>
            </div>

            <div class="d-flex align-items-center gap-2 flex-wrap">
                <a href="{{ route('products.print') }}" class="btn btn-sm btn-warning"><i
                        class="fas fa-print"></i></a>
                @if (auth()->user()->hasPermission('read_departments'))
                <a href="{{ route('departments.index') }}" class="btn btn-sm btn-success">
                    {{ __('site.Departments') }}
                    <!-- <i class="fab fa-buffer"></i> -->
                </a>
                @endif
                <a href="{{ route('LabelMaker') }}" class="btn btn-sm btn-purple">@lang('Poster maker')</a>
                <a href="{{ route('units') }}" class="btn btn-sm btn-primary">@lang('Units')</a>
                <button type="button" class="btn-main-sm" wire:click='$set("screen","create")'>
                    {{ __('site.Add_new_product') }}
                    <i class="icon fa-solid fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table main-table">
                <thead>
                    <tr>
                        <th>{{ __('site.Product_picture') }}</th>
                        <th>{{ __('site.Product_name') }}</th>
                        <th>{{ __('site.Department') }}</th>
                        <th>{{ __('site.Purchasing_price') }}</th>
                        <th>{{ __('site.selling_price') }}</th>
                        <th>{{ __('site.Activate_quantity') }}</th>
                        <th>{{ __('site.Quantity') }}</th>
                        <th>@lang('Barcode')</th>
                        <th>@lang('Unity')</th>
                        @if (setting('is_branches_active'))
                        <th>{{ __('site.branch_id') }}</th>
                        @endif
                        <th class="text-center">{{ __('site.Control') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>
                            @if ($product->cover)
                            <img src="{{ asset('uploads/' . $product->cover) }}"
                                alt="{{ $product->name }}" class="img-thumbnail" width="100px">
                            @else
                            <img src="{{ asset('img/no-image.jpg') }}" alt="{{ $product->name }}"
                                class="img-thumbnail" width="100px">
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->department?->name ?? '-' }}</td>

                        <td>{{ $product->price }}</td>
                        <td>{{ $product->saleprice }}</td>

                        <td>
                            {{ $product->allow_quantity ? 'مفعلة' : 'غير مفعلة' }}
                        </td>
                        <td>
                            {{ $product->quantity }}
                        </td>
                        <td>
                            @if ($product->barcode)
                            {!! DNS1D::getBarcodeHTML($product->barcode . '', 'C128') !!}
                            @endif
                        </td>
                        <td>{{ $product->unit?->name }}</td>
                        @if (setting('is_branches_active'))
                        <td>{{ $product->branch?->name }}</td>
                        @endif
                        <td>
                            <div class="d-flex flex-wrap align-items-center justify-content-center gap-1">

                                <a href="{{ route('reports.product', ['product' => $product->id]) }}"
                                    class="btn btn-sm trans-btn text-nowrap">{{ __('site.Financial_report') }}</a>

                                @if (auth()->user()->hasPermission('update_products'))
                                <button type="button" class="btn btn-sm btn-info text-white text-nowrap"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    wire:click="edit({{ $product->id }})">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                @endif
                                @if (auth()->user()->hasPermission('delete_products'))
                                <button type="button" class="btn btn-sm btn-danger text-nowrap"
                                    data-bs-toggle="modal" data-bs-target="#delete{{ $product->id }}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                                @endif
                                {{-- @include('product.editmodal')  --}}
                                @include('product.delete')
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $products->links() }}
        </div>
        @else
        @include('product.modal')
        @endif

    </div>
</div>