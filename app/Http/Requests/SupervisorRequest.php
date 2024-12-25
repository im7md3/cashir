<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupervisorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST': {
                    return [
                        'name'     => 'required',
                        'email'         => 'required|email|max:255|unique:users',
                        'phone'         => 'required|numeric|unique:users',
                        'password'      => 'required|min:6',
                        'user_category_id'      => 'required',
                        'payment_method_id'      => 'nullable',
                        'branch_id'      => 'nullable',

                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'name'          => 'required',
                        'email'         => 'required|email|max:255|unique:users,email,' . $this->route()->admin->id,
                        'phone'         => 'required|numeric|unique:users,phone,' . $this->route()->admin->id,
                        'password'      => 'nullable|min:6',
                        'user_category_id'      => 'required',
                        'payment_method_id'      => 'nullable',
                        'branch_id'      => 'nullable',
                    ];
                }
            default:
                break;
        }
    }
}
