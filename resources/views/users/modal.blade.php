<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $name ? __('Edit') : __('Add') }}
                    {{ __('site.Employee') }}</h5>
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
                    <div class=" col-sm-12">
                        <label class="small-label" for="">{{ __('site.E-mail') }}</label>
                        <input class="form-control" type="text" wire:model.defer='email' placeholder="">
                    </div>
                    <div class=" col-sm-12">
                        <label class="small-label" for="">{{ __('site.Password') }}</label>
                        <input class="form-control" type="password" wire:model.defer='password'
                            placeholder="{{ __('site.Password') }}">
                    </div>
                    @if ($user_category_id)
                        <div class=" col-sm-12">
                            <label class="small-label" for="">{{ __('site.Department') }}</label>
                            <select class="form-select" wire:model.defer='user_category_id' id="">
                                <option value="">{{ __('site.choose') }}</option>
                                @foreach (\App\Models\UserCategory::get() as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $user_category_id ? 'selected' : '' }}>{{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        <div class=" col-sm-12">
                            <label class="small-label" for="">{{ __('site.Department') }}</label>
                            <select class="form-select" wire:model.defer='user_category_id' id="">
                                <option value="">{{ __('site.choose') }}</option>
                                @foreach (\App\Models\UserCategory::get() as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div class=" col-sm-12">
                        <label class="small-label" for="">{{  __('Cash drawer') }}</label>
                        <select class="form-select" wire:model.defer='payment_method_id' id="">
                            <option value="">{{ __('site.choose') }}</option>
                            @foreach ($payment_methods as $payment_method)
                                <option value="{{ $payment_method->id }}">{{ $payment_method->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">{{ __('site.Close') }}</button>
                <button wire:click='submit' class="btn btn-primary"
                    data-bs-dismiss="modal">{{ __('site.Save') }}</button>
            </div>
        </div>
    </div>
</div>
