<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class SaveUser extends FormRequest
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
        $rules = [
            'name' => 'required|unique:users,name'.(! empty($this->user) ? ','.$this->user->id : null),
            'email' => 'required|email',
            'group_id' => 'required',
            'roles' => 'array',
        ];
        $rules['password'] = ! $this->user ? 'required' : '';
        return $rules;
    }

    public function attributes()
    {
        return [
            'name' => 'логін',
            'email' => 'E-mail',
            'password' => 'пароль',
            'group_id' => 'група',
        ];
    }
}
