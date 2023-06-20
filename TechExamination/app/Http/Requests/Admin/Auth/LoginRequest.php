<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Validation\Rule;



use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
                Rule::exists('users')->where(function($q){
                    $q->whereIn('actor',['0','1']);
                })->whereNull('deleted_at')
            ],
            'password' => [
                'required',
            ]
        ];
    }
}
