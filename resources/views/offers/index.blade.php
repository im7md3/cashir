@extends('layouts.app')
@section('title')
    {{ __('site.offers') }}
@endsection
@section('content')
    @livewire('offers')
@endsection
