@extends('layouts.app')

@section('title')
   سندات الفواتير
@endsection
@section('content')


    @livewire('invoices.bonds', ['invoice' => $invoice])
@endsection
