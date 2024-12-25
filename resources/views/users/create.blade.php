@extends('layouts.app')
@section('title', 'اضافه موظف')
@section('content')
    <div class="">
        {{-- <x-messages></x-messages> --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="main-heading mb-0">{{ __('site.Employees') }}</h4>
            <a href="{{ route('admins.index') }} " class="btn-main-sm">@lang('site.Back')</a>
        </div>
        <div class="box-content">
            <form action="{{ route('admins.store') }}" method="post">
                @csrf
                <div class="row row-gap-24">
                    <div class=" col-sm-4">
                        <label class="small-label" for="">{{ __('site.Name') }}</label>
                        <input class="form-control" type="text" placeholder="{{ __('site.Name') }}" name="name"
                            value="{{ old('name') }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class=" col-sm-4">
                        <label class="small-label" for="">{{ __('site.E-mail') }}</label>
                        <input class="form-control" type="text" placeholder="{{ __('site.E-mail') }}" name="email"
                            value="{{ old('email') }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class=" col-sm-4">
                        <label class="small-label" for="">{{ __('site.Password') }}</label>
                        <input class="form-control" type="password" placeholder="{{ __('site.Password') }}" name="password"
                            value="{{ old('password') }}">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class=" col-sm-4">
                        <label class="small-label" for="">{{ __('site.Phone') }}</label>
                        <input class="form-control" type="tel" placeholder="{{ __('site.Phone') }}" name="phone"
                            maxlength="11" minlength="11" onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                            value="{{ old('phone') }}" />
                    </div>
                    <div class=" col-sm-4">
                        <label class="small-label" for="">{{ __('site.Department') }}</label>
                        <select class="main-select w-100" id="" name="user_category_id">
                            <option value="">{{ __('site.choose') }}</option>
                            @foreach (\App\Models\UserCategory::get() as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('item', $admin->category->id ?? null) == $item->id ? 'selected' : null }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('user_category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class=" col-sm-4">
                        <label class="small-label" for="">{{  __('Cash drawer') }}</label>
                        <select class="main-select w-100" id="" name="payment_method_id">
                            <option value="">{{ __('site.choose') }}</option>
                            @foreach ($payment_methods as $payment_method)
                                <option value="{{ $payment_method->id }}"
                                    {{ old('payment_method_id') == $payment_method->id ? 'selected' : null }}>
                                    {{ $payment_method->name }}</option>
                            @endforeach
                        </select>
                        @error('payment_method_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class=" col-sm-4">
                        <label class="small-label" for="">{{ __('branche') }}</label>
                        <select class="main-select w-100" id="" name="branch_id">
                            <option value="">{{ __('Select') }}</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}"
                                    {{ old('branch_id') == $branch->id ? 'selected' : null }}>
                                    {{ $branch->name }}</option>
                            @endforeach
                        </select>
                        @error('branch_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="roles" class="small-label">{{ __('site.powers') }}</label>
                            <select name="role_id" class="main-select w-100 mb-3" id="id_h5_multi">
                                @forelse($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ $role->id == old('role_id') ? 'selected' : '' }}>
                                        {{ __($role->name) }}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                            @error('roles')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-sm px-4 mt-3 sw-100">
                        {{ __('site.Save') }}
                        <i class="la la-check-square-o"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
