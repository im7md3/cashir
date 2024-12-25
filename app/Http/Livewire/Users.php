<?php

namespace App\Http\Livewire;

use App\Models\PaymentMethod;
use App\Models\User;
use App\Traits\livewireResource;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class Users extends Component
{
    use WithPagination, livewireResource;

    public $name, $phone, $email, $password, $user_category_id, $id, $payment_method_id;

    // protected function mount($user){
    //  $this->user = $user;
    // }
    protected function rules()
    {
        return [
            'name' => ['string', 'required'],
            // 'phone' => [$this->user ? Rule::unique('users')->ignore($this->user->id) : 'unique:users,phone', 'required'],
            // 'phone' => [Rule::unique('users'), 'required'],
            // 'email' => [Rule::unique('users'), 'required'],
            'phone' => ['required', 'unique:users,phone,' . $this->obj?->id],
            'email' => ['required', 'unique:users,email,' . $this->obj?->id],
            // 'phone' => 'required|unique:users,phone,'.$this->user->id,
            // 'email' => 'required|unique:users,email,'.$this->user->id,
            'password' => [$this->name ? 'nullable' : 'required', 'min:6'],
            'user_category_id' => ['required'],
            'payment_method_id' => ['nullable'],
        ];
    }

    public function render()
    {
        $users = User::get();
        $payment_methods = PaymentMethod::where('is_cash', 1)->get();
        return view('livewire.users', compact('users', 'payment_methods'));
    }
}
