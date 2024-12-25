@extends('layouts.app')
@section('title', 'عرض فاتورة')
@section('content')
    @livewire('invoices.show', ['id' => $id])
@endsection
