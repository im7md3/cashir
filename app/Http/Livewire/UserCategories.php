<?php

namespace App\Http\Livewire;

use App\Models\UserCategory;
use App\Traits\livewireResource;
use Livewire\Component;

class UserCategories extends Component
{

    use livewireResource;

    public $name, $user_category;
    protected function rules(){
        return [
            'name' => ['string','required'],
        ];
    } 
    
    public function render()
    {
        $user_categories = UserCategory::all();
        return view('livewire.user-categories', compact('user_categories'));
    }
}
