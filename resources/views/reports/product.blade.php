@extends('layouts.app')
@section('title')
    {{ __('site.Product_financial_report') }}
@endsection
@section('content')
    @livewire('reports.product')

@endsection
