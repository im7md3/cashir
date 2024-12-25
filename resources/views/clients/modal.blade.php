<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $client ? __('Edit') : __('Add') }} {{ __('site.client') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row row-gap-24">
                    <div class=" col-sm-12">
                        <label class="small-label" for="">{{ __('site.Name') }}</label>
                        <input class="form-control" type="text" wire:model.defer='name' placeholder="">
                    </div>
                    <div class=" col-sm-12">
                        <label class="small-label" for="">{{ __('site.Phone') }}</label>
                        <input class="form-control" type="text" wire:model.defer='phone' placeholder="">
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="">{{ __('site.Social_Situation') }}</label>
                        <select wire:model.defer="social_situation" id="" class="form-control">
                            <option>{{ __('site.Choose_Social_Situation') }}</option>
                            <option value="single">{{ __('site.Single') }}</option>
                            <option value="married">{{ __('site.Married') }}</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="">{{ __('site.Package') }}</label>
                        <select wire:model.defer="package_id" id="" class="form-control">
                            <option>{{ __('Choose Package') }}</option>
                            @foreach ($packages as $package)
                            <option value="{{ $package->id }}">{{ $package->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('site.Close') }}</button>
                <button wire:click='submit' class="btn btn-primary" data-bs-dismiss="modal">{{ __('site.Save') }}</button>
            </div>
        </div>
    </div>
</div>