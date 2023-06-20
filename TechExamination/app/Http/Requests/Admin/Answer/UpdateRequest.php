<?php

namespace App\Http\Requests\Admin\Answer;

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
            'subject_id' => [
                'required',
                Rule::exists('subjects', 'id')->whereNull('deleted_at')
            ],
            'question_id' => [
                'required',
                Rule::exists('questions', 'id')->where(function ($q) {
                    $q->where('subject_id', $this->subject_id);
                })->whereNull('deleted_at')
            ],
            'opption_1' => [
                'required',
                'min:3',
                'max:191',
            ],
            'opption_2' => [
                'required',
                'min:3',
                'max:191',
            ],
            'opption_3' => [
                'required',
                'min:3',
                'max:191',
            ],
            'opption_4' => [
                'required',
                'min:3',
                'max:191',
            ],
            'correct_answer' => [
                'required',
                'min:3',
                'max:191',
            ],
        ];
    }
}
