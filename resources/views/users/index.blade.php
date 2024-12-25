@extends('layouts.app')
@section('title', __('site.Employees'))
@section('content')
    {{-- @livewire('users') --}}
    <div class="">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h4 class="main-heading m-0">{{ __('site.Employees') }}</h4>
            <a href="{{ route('settings.index') }}" class="btn btn-sm btn-secondary px-4">{{ __('site.Back') }}</a>
        </div>
        <div class="box-content">
            <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-3">
                <a href="{{ route('admins.create') }}" class="btn btn-primary btn-sm px-3">
                    <i class="icon-plus"></i> {{ __('site.Add_Employee') }}
                </a>
                <a class="btn-main-sm" href="{{ route('roles.index') }}">
                    {{ __('site.Roles') }}
                </a>
            </div>
            <div class="table-responsive">
                <table class="table main-table">
                    <thead>
                        <tr>
                            <th># </th>
                            <th>{{ __('site.Employee_Name') }}</th>
                            <th>{{ __('site.Phone') }}</th>
                            <th>{{ __('site.E-mail') }}</th>
                            <th>{{ __('site.Group') }}</th>
                            <th>{{ __('branche') }}</th>
                            <th>{{ __('Cash drawer') }}</th>
                            <th class="text-center">{{ __('site.Control') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td class="text-nowrap">{{ $user->name }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-nowrap">
                                    @foreach ($user->roles as $role)
                                        <span>{{ __($role->name) }}</span> <br>
                                    @endforeach
                                </td>
                                <td>{{ $user->branch?->name }}</td>
                                <td>{{ $user->payment_method?->name ?? 'لا يوجد' }}</td>
                                <td class="d-flex align-items-center justify-content-center gap-1">
                                    <a class="btn btn-info btn-sm fonticon-wrap width-50"
                                        href="{{ route('admins.edit', $user->id) }}" title="تعديل">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    @if ($user->id != Auth::user()->id)
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $user->id }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    @endif
                                    @include('users.delete')
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {!! $users->appends(request()->all())->links() !!}
            </div>
        </div>
    </div>
@endsection
