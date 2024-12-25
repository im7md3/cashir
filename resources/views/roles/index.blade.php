@extends('layouts.app')
@section('title', 'الصلاحيات')
@section('content')
    <div class="">
        <h4 class="main-heading">{{ __('site.powers') }}</h4>
        <div class="box-content">
            @if (auth()->user()->hasPermission('create_roles'))
                <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between mb-3">
                    <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm px-3">
                        <i class="icon-plus"></i> {{ __('site.Add_Group') }}
                    </a>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table main-table">
                    <thead>
                        <tr>
                            <th># </th>
                            <th>@lang('roles.group_name')</th>
                            {{-- <th>@lang('roles.employees_count')</th> --}}
                            <th>{{ __('site.Added_Date') }}</th>
                            @if (auth()->user()->hasPermission('update_roles','delete_roles'))
                              <th class="text-center">{{ __('site.Control') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $index=>$role)
                            <tr>
                                <td>{{ $index +1 }}</td>
                                <td>{{ __($role->name)}} </td>
                                {{-- <td>{{ $role->users_count}}</td> --}}
                                <td>{{ $role->created_at() }}</td>
                                <td>
                                    <div class="d-flex flex-wrap align-items-center justify-content-center gap-1">
                                        @if (auth()->user()->hasPermission('update_roles'))
                                            <a class="btn btn-info btn-sm fonticon-wrap width-50" href="{{ route('roles.edit',$role->id )}}" title="تعديل">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        @endif
                                        @if (auth()->user()->hasPermission('delete_roles'))
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#delete{{ $role->id }}">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        @endif
                                        @include('roles.delete')
                                    </div>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="text-center">لايوجد صلاحيات</td>
                                </tr>
                            @endforelse

                    </tbody>
                </table>
                {!! $roles->appends(request()->all())->links() !!}
            </div>
        </div>
    </div>
@endsection
