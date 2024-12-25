<?php

namespace App\Http\Livewire;

use App\Models\ExpenseCategory;
use App\Traits\livewireResource;
use Livewire\Component;

class ExpenseCategories extends Component
{

    use livewireResource;
    public $name, $parent;
    protected function rules()
    {
        return [
            'name' => ['required', 'unique:expense_categories,name,' . $this->obj?->id],
            'parent' => ['nullable'],
        ];
    }

    public function render()
    {
        if ($this->obj) {
            if ($this->obj->parent) {
                $allCategories = ExpenseCategory::where('id', '!=', $this->obj?->id)->get();
            } else {
                $allCategories = ExpenseCategory::where(function ($q) {
                    $q->where('parent', '!=', $this->obj?->id)->orWhereNull('parent');
                })->where('id', '!=', $this->obj?->id)->get();
            }
        } else {
            $allCategories = ExpenseCategory::all();
        }

        $categories = ExpenseCategory::with('main')->latest('id')->paginate(10);
        return view('livewire.expense-categories', compact('allCategories', 'categories'));
    }

    public function beforeSubmit()
    {
        if ($this->parent == '') {
            $this->data['parent'] = null;
        }
    }
}
