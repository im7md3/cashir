@extends('layouts.app')
@section('title','المنتجات')
@section('content')
<x-messages></x-messages>
<h4 class="main-heading">{{ __('site.Products') }}</h4>
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
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>
                        @if ($product->cover)
                        <img src="{{ asset('uploads/' . $product->cover) }}" alt="{{ $product->name }}"
                            class="img-thumbnail" width="100px">
                        @else
                        <img src="{{ asset('img/no-image.jpg') }}" alt="{{ $product->name }}" class="img-thumbnail"
                            width="100px">
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
                        {{ $product->barcode }}
                    </td>
                    <td>{{ $product->unit?->name }}</td>
                    <td>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
<script>
    window.onload = function() {
        window.print(); 
        window.onafterprint = function() {
            window.history.back();
        };
    };
</script>
@endsection