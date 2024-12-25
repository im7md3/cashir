<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ConstSettings extends Component
{
    public $available_branches_count,$is_branches_active;
    public function render()
    {
        return view('livewire.const-settings')
            ->extends('layouts.app')
            ->section('content')
            ;
    }

    public function mount()
    {
        $this->available_branches_count=setting('available_branches_count');
        $this->is_branches_active=(int)setting('is_branches_active');
    }
    public function submit()
    {
        $data =$this->validate([
            'is_branches_active'=>'bool',
            'available_branches_count'=> 'required_if:is_branches_active,1'
        ]);
        setting($data)->save();
        $this->dispatchBrowserEvent('alert',['type'=>'success','message'=>'تم الحفظ بنجاح']);
    }
}
