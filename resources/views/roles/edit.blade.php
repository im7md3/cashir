@extends('layouts.app')
@section('title', 'تعديل صلاحيه')
@section('content')
    <div class="">
        <h4 class="main-heading">@lang('Edit role')</h4>
        <div class="box-content">
            <form action="{{ route('roles.update', $role->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="d-flex align-items-end gap-3 flex-wrap mb-3">
                    <div class="inp-holder">
                        <label for="name">@lang('roles.roles')<span class="text-danger">*</span> </label>
                        <input type="text" class="form-control w-250px" placeholder="Role Name" name="name"
                            value="{{ old('name', __($role->name)) }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="inp-holder mb-1">
                        <label for="name">{{ __('site.Select_All') }}</label>
                        <input type="checkbox" name="select_all" id="selectall">
                    </div>
                </div>
                <div class=" col-sm-12">
                    <div class="form-group">
                        <label for="">@lang('roles.permissions')<span class="text-danger">*</span> </label>
                        <table class="table main-table">
                            <thead>
                                <tr>
                                    <th>@lang('roles.model')</th>
                                    {{-- <th>select all</th> --}}
                                    @foreach ($permissionMaps as $key => $value)
                                        {{-- <th>@lang('roles.permissions') {{ $key+1 }}</th> --}}
                                        <th>@lang('site.' . $value)</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($models as $key => $model)
                                    @php
                                        $characters = explode(',', $model);
                                        $maps = [];
                                        foreach ($characters as $char) {
                                            if (isset($permissionMaps[$char])) {
                                                $maps[] = $permissionMaps[$char];
                                            }
                                        }
                                    @endphp
                                    <tr>
                                        <td>@lang('site.' . $key)</td>
                                        @foreach ($maps as $permissionMap)
                                            <td>
                                                <div class="animated-checkbox mx-2" style="display:inline-block;">
                                                    <label class="m-0">
                                                        <input type="checkbox" value="{{ $permissionMap . '_' . $key }}"
                                                            name="permissions[]"
                                                            {{ $role->hasPermission($permissionMap . '_' . $key) ? 'checked' : '' }}
                                                            class="checkbox1">
                                                        <span class="label-text text-nowrap">@lang('site.' . $permissionMap)
                                                            @lang('site.' . $key)</span> </label>
                                                </div>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table><!-- end of table -->
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary px-4 btn-sm">
                        {{ __('site.Save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#selectall').click(function(event) { //on click
                // console.log('hello');
                if (this.checked) { // check select status
                    $('.checkbox1').each(function() { //loop through each checkbox
                        this.checked = true; //select all checkboxes with class "checkbox1"
                    });
                } else {
                    $('.checkbox1').each(function() { //loop through each checkbox
                        this.checked = false; //deselect all checkboxes with class "checkbox1"
                    });
                }
                var chkArray = [];
                $("input[name='check[]']:checked").map(function() {
                    chkArray.push(this.value);
                }).get();
                var selected;
                selected = chkArray.join(',') + ",";
                if (selected.length > 1) {
                    alert('هل تريد تحديد الكل?');
                } else {
                    alert(' تحديد الكل');
                }
            });
        });
    </script>
@endpush
