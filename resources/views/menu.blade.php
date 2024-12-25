<div class="d-flex align-items-center gap-2 justify-content-center">
    <a href="{{ route('accounting') }}" class="btn btn-info">
        {{ __('site.Accounting') }}
    </a>
    <a href="{{route('purchases')}}" class="btn btn-info">
        @lang('site.Purchases')
    </a>
    <a href="{{route('expenses')}}" class="btn btn-info">
        @lang('site.Expenses')
    </a>
</div>