@extends('layouts.app')
@section('title', 'شاشة البيع')
@section('full_screen', true)
@section('content')
    @livewire('invoices.create')
    @push('css')
        <style>
            .row-gap-24 {
                row-gap: 24px;
            }

            .box-white {
                background-color: white;
                border: 1px solid #ddd;
                padding: 0.5rem 1rem;
            }

            .w-fit {
                width: -webkit-fit-content;
                width: -moz-fit-content;
                width: fit-content;
            }

            .box-price {
                background-color: #000000;
                color: #0FBD17;
                padding: 5px 1rem;
                font-weight: bold;
                font-size: 65px;
            }

            .width-btns .btn {
                min-width: 140px;
            }

            .inp-num-small {
                width: 100px !important;
                padding: 0 5px !important;
                height: auto !important;
            }

            .box-grey {
                background-color: #BBB9BA;
                padding: 5px 10px;
                border: 1px solid #A8AAA7;
                border-radius: 3px;
                height: 30px;
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                -webkit-box-pack: center;
                -ms-flex-pack: center;
                justify-content: center;
            }

            .box-grey-2 {
                background-color: #d6d3d6;
                padding: 5px 10px;
                border: 1px solid #A8AAA7;
                border-radius: 3px;
                height: 30px;
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                font-size: 20px;
                -webkit-box-pack: center;
                -ms-flex-pack: center;
                justify-content: center;
                color: #66676b;
            }

            .w-60px {
                width: 60px !important;
            }
        </style>
    @endpush
@endsection
