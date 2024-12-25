@extends('layouts.app')
@section('title', 'الاشعارات')
@section('content')
<section class="">
    <div class="container">
        <h4 class="main-heading">{{ __('site.notifications') }}</h4>
        <div class="bg-white p-3 rounded-2 shadow">

            <div class="d-flex justify-content-between mb-3">
                <a class="btn btn-success btn-sm" href="{{ route('markAsRead') }}"><i class="fa fa-eye"></i>
                    @lang('site.read_all_notifications')</a>
                {{-- <a class="btn btn-danger btn-sm" href="{{ route('deleteAllNotifications') }}">
                    مسح كل الاشعارات
                </a> --}}
                <a class="btn btn-danger btn-sm" href="{{ route('deleteAllNotifications') }}" onclick="return confirm('هل أنت متأكد من رغبتك في حذف جميع الإشعارات؟');">
                    مسح كل الاشعارات
                </a>
                
            </div>

            @php
            $notifications = auth()
            ->user()
            ->notifications()
            ->paginate(10);
            @endphp
            @forelse ($notifications as $noti)
            <div class="p-3 border-bottom">
                @if ($noti->read_at == null)
                <span class="text-danger new">
                    @lang('site.new') </span>
                @endif
                <a href="{{ $noti['data']['link'] ?? '#' }}">
                    <span class="text-main-color">{{ $noti['data']['title'] }}</span>
                </a>
            </div>
            @empty
            <div class="alert alert-warning">
                @lang('site.no_notifications')
            </div>
            @endforelse
            <div class="mt-3">
                {{ $notifications->links() }}
            </div>
        </div>
    </div>
</section>
@endsection
