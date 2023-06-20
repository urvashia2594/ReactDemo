<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                Rule::unique('users')->where(function ($q) {
                    $q->where('actor', 2);
                })->whereNull('deleted_at')->ignore($this->user->id)
            ],
            'name' => [
                'required',
                'min:3',
                'max:191'
            ],
            'password' => [
                'nullable',
                'min:3',
                'max:191'
            ]
        ];
    }
}
