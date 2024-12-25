<div class="modal fade" id="edit{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('site.Edit_product') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row row-gap-24">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{ __('site.Product_picture') }}</label>
                                <input class="form-control img" name="cover" type="file" accept="image/*" wire:model.defer='cover'>
                                @error('cover')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            @if ($product->cover)
                            <img src="{{ asset('img/products/' . $product->cover) }}" alt="{{ $product->name }}" class="img-thumbnail img-preview" width="200px">
                            @else
                            <img src="{{ asset('img/no-image.jpg') }}" alt="" class="img-thumbnail img-preview" width="200px">
                            @endif
                        </div>
                    </div>

                    <div class=" col-sm-6">
                        <label class="small-label" for="">{{ __('site.Product_name') }}</label>
                        <input class="form-control" type="text" wire:model='name' value="{{ $product->name }}" placeholder="">
                    </div>
                    <div class=" col-sm-6">
                        <label class="small-label" for="">{{ __('site.Departments') }}</label>
                        <select class="form-control" wire:model.defer='department_id'>
                            <option value="">{{ __('site.Choose_Department') }}</option>
                            @foreach ($departments as $department)
                            <option value="{{ $department->id }}" {{ $product->department_id == $department->id ? 'selected' : '' }}>
                                {{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class=" col-sm-6">
                        <label class="small-label" for="">{{ __('site.Purchasing_price') }}</label>
                        <input class="form-control" type="number" min="0" wire:model.defer='price' placeholder="" value="{{ $product->price }}">
                    </div>
                    <div class=" col-sm-6">
                        <label class="small-label" for="">{{ __('site.selling_price') }}</label>
                        <input class="form-control" type="number" min="0" wire:model.defer='saleprice' placeholder="" value="{{ $product->saleprice }}">
                    </div>


                    <div class="col-sm-6">
                        <label class="small-label" for="">{{ __('site.Quantity') }}</label>
                        <input class="form-control" type="text" wire:model.defer='quantity' placeholder="" value="{{ $product->quantity }}" min="1">
                    </div>

                    <div class=" col-sm-6 mt-4">
                        <label class="small-label" for="">{{ __('site.Activate_quantity') }}</label>
                        <input value="1" type="checkbox" wire:model.defer='allow_quantity' {{ $product->allow_quantity ? 'checked' : '' }}>
                    </div>

                </div>
            </div>
            <input type="hidden" wire:model="id" class="form-control">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('site.Close') }}</button>
                <button wire:click='update("{{ $product->id }}")' class="btn btn-primary" data-bs-dismiss="modal">تعديل</button>
            </div>
        </div>
    </div>
</div>
