 <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <x-messages></x-messages>
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('site.Add_new_reservation') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"  >
                {{-- <div class="col-md-6">
                    <div dir="ltr" class="d-flex align-items-center justify-content-end mb-2">
                        <button id="button-addon2" type="button" class="btn btn-success input-group-addon">
                            {{ __('site.search') }}
                        </button>
                        <input dir="rtl" type="text" class="form-control" placeholder="البحث برقم الجوال العميل"  wire:model='searchphone'>
                    </div>
                </div> --}}
                {{-- <div class="col-md-3">
                    <div class="inp-holder">
                        <label for="" class="small-label">{{ __('site.Clients') }}</label>
                        <select class="main-select w-100" id="" name="" wire:model.defer="client_id">
                            <option value=""> --- اختر من العملاء</option>
                            @foreach (\App\Models\Client::get() as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                        @error('client_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> --}}
                <div class="row row-gap-24">
                    <div class="col-md-6">
                        <label for="" class="small-label ">{{ __('site.Mobile_number') }}</label>
                        <input type="tel" name="" class="form-control" id="" wire:model='phone' wire:change='searchname'>
                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="" class="small-label ">{{ __('site.Name') }}</label>
                        <input type="text" name="" class="form-control" id="" wire:model='name'>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="" class="small-label "> {{ __('site.The_number_of_people') }}</label>
                        <input type="number" min="0" name="" class="form-control" id="" wire:model.defer="personno">
                        @error('personno')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center gap-2">
                            <label for="" class="form-check-label d-flex align-items-center gap-1">
                                {{ __('site.Families') }}
                                <input type="radio" name="type" id="" class="form-check-input" wire:model.defer="social_situation" value="married">
                            </label>
                            <label for="" class="form-check-label d-flex align-items-center gap-1">
                                {{ __('site.Singles') }}
                                <input type="radio" name="type" id="" class="form-check-input" wire:model.defer="social_situation" value="single">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ __('site.Back') }}</button>
                <button wire:click='submit' class="btn btn-primary" data-bs-dismiss="modal">{{ __('site.Save') }}</button>
            </div>
        </div>
    </div>
</div>
