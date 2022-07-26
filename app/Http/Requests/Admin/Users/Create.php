<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class Create extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $availableRoles = Role::query()->where('name', '!=', 'admin')->pluck('name', 'id')->toArray();
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required'],
            'role' => ['exists:roles,id', Rule::in(array_keys($availableRoles)) ]
        ];
    }
}
