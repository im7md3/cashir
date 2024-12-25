<div>
    <h4 class="main-heading">{{ __('site.Reservations') }}</h4>
    <div class="box-content">
        @include('Reservation.modal-add')
        <button type="button" class="btn btn-primary btn-sm px-3 mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
            {{ __('site.new_reservation') }}
        </button>
        <div class="row">
            <div class="col-xl-6">
                <div class="text-center xl-label mb-1 fw-bold">
                    {{ __('site.families') }}
                </div>
                <div class="table-responsive">
                    <table class=" text-center table main-table">
                        <thead>
                            <tr>
                                <th> #</th>
                                <th>{{ __('site.Name') }}</th>
                                <th>{{ __('site.Phone') }}</th>
                                <th>{{ __('site.Persons') }}</th>
                                <th>{{ __('site.Added_Date') }}</th>
                                <th>{{ __('site.Add_time') }}</th>
                                <th>{{ __('site.Whatsapp') }}</th>
                                <th>{{ __('site.Control') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($married as $client)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->phone }}</td>
                                <td>{{ $client->personno }}</td>
                                <td>
                                    {{ $client->created_at->format('Y-m-d') }}
                                    {{-- <div class="d-flex align-items-center gap-1 justify-content-center btns-table">
                                        <div class="btn btn-success btn-sm text-nowrap"><i class="fas fa-check"></i> </div>
                                        <div class="btn btn-danger btn-sm text-nowrap"> <i class="fas fa-xmark"></i></div>
                                    </div> --}}
                                </td>
                                <td>{{ $client->created_at->format('H:i:s') }}</td>
                                <td>
                                    <a href="https://wa.me/{{ $client->phone }}">
                                        <img src="{{ asset('img/whatsapp.png') }}" alt="whatsapp" width="37">
                                    </a>
                                </td>
                                <td>
                                    {{-- <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i></button> --}}
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#delete{{ $client->id }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                    @include('Reservation.delete')
                                </td>
                            </tr>
                            @empty
                                 <span>{{ __('site.No_reservations') }}</span>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="text-center xl-label mb-1 fw-bold">
                    {{ __('site.singles') }}
                </div>
                <div class="table-responsive">
                    <table class=" text-center table main-table">
                        <thead>
                            <tr>
                                <th> #</th>
                                <th>{{ __('site.Name') }}</th>
                                <th>{{ __('site.Phone') }}</th>
                                <th>{{ __('site.Persons') }}</th>
                                <th>{{ __('site.Added_Date') }}</th>
                                <th>{{ __('site.Add_time') }}</th>
                                <th>{{ __('site.Whatsapp') }}</th>
                                <th>{{ __('site.Control') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($single as $client)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->phone }}</td>
                                <td>{{ $client->personno }}</td>
                                <td>
                                    {{ $client->created_at->format('Y-m-d') }}
                                    {{-- <div class="d-flex align-items-center gap-1 justify-content-center btns-table">
                                        <div class="btn btn-success btn-sm text-nowrap"><i class="fas fa-check"></i> </div>
                                        <div class="btn btn-danger btn-sm text-nowrap"> <i class="fas fa-xmark"></i></div>
                                    </div> --}}
                                </td>
                                <td>{{ $client->created_at->format('H:i:s') }}</td>
                                <td>
                                    <a href="https://wa.me/{{ $client->phone }}">
                                        <img src="{{ asset('img/whatsapp.png') }}" alt="whatsapp" width="37">
                                    </a>
                                </td>
                                <td>
                                    {{-- <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i></button> --}}
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#delete{{ $client->id }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                    @include('Reservation.delete')
                                </td>
                            </tr>
                            @empty
                                 <span>{{ __('site.No_reservations') }}</span>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
