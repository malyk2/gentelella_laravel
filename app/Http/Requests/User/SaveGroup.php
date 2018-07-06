<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class SaveGroup extends FormRequest
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
        return [
            'name' => 'required|max:255',
            'parent_id' => ! $this->group ? 'required' : '',
            'perms' => 'array',
            'active' => 'boolean',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'назва',
            'parent_id' => 'група',
        ];
    }
}
