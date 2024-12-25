<?php

namespace App\Http\Livewire;

use App\Models\Branch;
use App\Models\Unit;
use App\Models\Product;
use Livewire\Component;
use App\Models\Department;
use App\Models\ProductQuantity;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Traits\livewireResource;
use Intervention\Image\Facades\Image;
use Illuminate\Validation\Rule;

class Products extends Component
{
    use WithPagination, livewireResource, WithFileUploads;
    public $name, $department_id, $price, $cover, $id, $quantity = 0, $allow_quantity = 0, $searchdepart, $saleprice, $product, $unit_id;
    public $barcode, $opening_quantity, $has_end_date = 0, $end_date, $branch_id, $filter_branch_id;

    public $filter_end_quantity, $filter_out_of_date;

    protected function rules()
    {
        $rules = [
            'name' => ['required'],
            'department_id' => ['required'],
            'price' => ['required'],
            'saleprice' => ['required'],
            'quantity' => ['required_with:allow_quantity', 'numeric'],
            'allow_quantity' => 'nullable',
            'barcode' => 'nullable|integer',
            'unit_id' => 'required',
            'branch_id' => 'nullable',
            'opening_quantity' => $this->obj ? 'required' : 'nullable' . '|numeric',
            'has_end_date' => 'boolean'
        ];

        // Add custom validation rule for end_date if has_end_date is true
        if ($this->has_end_date) {
            $rules['end_date'] = [
                'required',
                function ($attribute, $value, $fail) {
                    if (!$value) {
                        $fail('The end date is required if has end date is true.');
                    }
                },
            ];
        }

        return $rules;
    }

    public function beforeCreate()
    {
        $this->validate([
            'cover' => 'nullable|mimes:jpg,jpeg,png|max:2000',
        ]);
        if ($this->cover) {
            $this->data['cover'] = store_file($this->cover, 'products');
        }
        $this->data['opening_quantity'] = $this->quantity;
    }

    public function beforeUpdate()
    {
        $this->validate([
            'cover' => 'nullable|mimes:jpg,jpeg,png|max:2000',
        ]);
        if ($this->cover) {
            delete_file($this->obj->cover);
            $this->data['cover'] = store_file($this->cover, 'products');
        } else {
            $this->data['cover'] = $this->obj->cover;
        }
    }

    public function beforeDelete($obj)
    {
        delete_file($obj->getRawOriginal('cover'));
    }

    public function afterSubmit()
    {
        if ($this->branch_id) {
            $this->obj->branch_id = $this->branch_id;
            $this->obj->save();
        }
    }

    public function afterCreate()
    {
        ProductQuantity::create([
            'product_id' => $this->obj?->id,
            'quantity' => $this->quantity,
            'type' => 'charge',
        ]);
    }

    public function render()
    {
        $searchdepart = $this->searchdepart;
        $departments = Department::all();
        $units = Unit::all();
        $branches = Branch::all();
        $products = Product::with(['department', 'unit'])
            ->where(function ($q) {
                if ($this->filter_end_quantity) {
                    $q->where('quantity', 0);
                }
                if ($this->filter_branch_id) {
                    $q->where('branch_id', $this->filter_branch_id);
                }
                if ($this->filter_out_of_date) {
                    $q->whereNotNull('end_date')->where('end_date', '<', date('Y-m-d'));
                }
            })->latest()->paginate(10);
        return view('livewire.products', compact('departments', 'products', 'units', 'branches'));
    }

    public function back()
    {
        $this->reset();
        $this->screen = 'index';
    }
}
