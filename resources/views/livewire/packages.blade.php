<div class="">
    <x-messages></x-messages>
    @include('packages.modal')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="main-heading m-0">{{ __('site.Packages') }}</h4>
        <div class="alert alert-primary m-0 py-2">
            الباقات هي بطريقة الكروت مثال العميل يشتري بطاقة بـ 100 ريال ويستطيع الشراء بـ 120 ريال ويتم الخصم من رصيد الباقه
        </div>
        <a href="{{ route('settings.index') }}" class="btn btn-sm btn-secondary px-4">{{ __('site.Back') }}</a>
    </div>
    <div class="box-content">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <button type="button" class="btn-main-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                {{ __('site.add') }}
                <i class="icon fa-solid fa-plus"></i>
            </button>
            <a href="{{ route('using_packages') }}" class="btn-main-sm">
                {{ __('site.Using packages') }}
            </a>
        </div>
        <div class="table-responsive">
            <table class="table main-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('site.Package name') }}</th>
                        <th>{{ __('site.Package price') }}</th>
                        <th>{{ __('site.rate') }}</th>
                        <th>{{ __('site.Amount after rate') }}</th>
                        <th>{{ __('site.Participants') }}</th>
                        <th class="text-center">{{ __('site.Control') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($packages as $k=>$package)
                    <tr>
                        <td>{{$k + 1}}</td>
                        <td>{{$package->name}}</td>
                        <td>{{$package->price}}</td>
                        <td>{{$package->rate}}%</td>
                        <td>{{$package->total_price}}</td>
                        {{-- <td>{{$package->clients->count()}}</td> --}}
                        <td><a href="{{ route('clients.index', ['package_id' => $package->id]) }}">{{$package->clients->count()}}
                            <i class="fa fa-eye"></i></a></td>
                        <td>
                            <div class="d-flex flex-wrap align-items-center justify-content-center gap-1">
                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" wire:click="edit({{ $package->id }})">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $package->id }}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                                @include('packages.delete')
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $packages->links() }}
        </div>
    </div>
</div>
