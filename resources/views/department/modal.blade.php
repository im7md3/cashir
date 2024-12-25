<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $name ? __('Edit') : __('Add') }}
                    {{ __('site.department') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row row-gap-24">
                    <div class=" col-sm-6">
                        <label class="small-label" for="">{{ __('site.Name') }}</label>
                        <input class="form-control" type="text" wire:model.defer='name' placeholder="">
                    </div>
                    <div class=" col-sm-6">
                        <label class="small-label" for="">{{ __('site.Sub_Of') }}</label>
                        <select class="form-control" wire:model.defer='parent'>
                            <option value="">{{ __('site.Main') }}</option>
                            @foreach ($allDepartments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>{{ __('site.Product_picture') }}</label>
                            <input class="form-control img" type="file" accept="image/*" wire:model.defer='image'
                                id="image">
                            @if ($obj?->image)
                                <img src="{{ display_file($obj->image) }}" alt=""
                                    class="img-thumbnail mt-1 img-preview" width="200px">
                            @else
                                @if ($image)
                                    <img src="{{ $image->temporaryUrl() }}" alt=""
                                        class="img-thumbnail mt-1 img-preview" width="200px">
                                @else
                                    <img src="{{ asset('img/no-image.jpg') }}" alt=""
                                        class="img-thumbnail mt-1 img-preview" width="200px">
                                @endif

                            @endif
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                    </div>

                    {{-- @if (setting('is_branches_active'))
                        <div class=" col-sm-4">
                            <label class="small-label" for="">{{ __('site.branch_id') }}</label>
                            <select class="form-control" wire:model.defer='branch_id'>
                                <option value="">{{ __('site.branch_id') }}</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif --}}
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
