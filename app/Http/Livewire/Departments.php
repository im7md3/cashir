<?php

namespace App\Http\Livewire;

use App\Models\Branch;
use App\Models\Department;
use App\Traits\livewireResource;
use Livewire\Component;
use Livewire\WithFileUploads;

class Departments extends Component
{
    use livewireResource, WithFileUploads;

    public $name, $parent, $branch_id, $image;
    protected function rules()
    {
        return [
            'name' => ['required'],
            'parent' => ['nullable'],
            'branch_id' => ['nullable'],
            'image' => ['nullable', 'image'],
        ];
    }
    public function render()
    {
        $allDepartments = Department::all();
        $branches = Branch::all();
        $departments = Department::with('main')->latest('id')->paginate(10);
        return view('livewire.departments', compact('departments', 'allDepartments', 'branches'));
    }

    public function afterSubmit()
    {
        if ($this->branch_id) {
            $this->obj->branch_id = $this->branch_id;
            $this->obj->save();
        }
    }

    public function whileEditing()
    {
        $this->image = '';
    }

    public function beforeSubmit()
    {
        if ($this->image) {
            if ($this->obj) {
                delete_file($this->obj->image);
            }
            $this->data['image'] = store_file($this->image, 'departments');
        } else {
            unset($this->data['image']);
        }
    }
}
