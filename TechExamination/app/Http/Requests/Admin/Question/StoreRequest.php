<?php

namespace App\Http\Requests\Admin\Question;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'subject_id' => [
                'required',
                Rule::exists('subjects','id')->whereNull('deleted_at')
            ],
            'que' => [
                'required',
                'min:3',
                'max:191',
                Rule::unique('questions')->where(function ($q) {
                    $q->where('subject_id', $this->subject_id);
                })->whereNull('deleted_at')
            ],
        ];
    }
}
