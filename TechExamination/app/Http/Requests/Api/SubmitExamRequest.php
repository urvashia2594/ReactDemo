<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use App\Models\Exam;

class SubmitExamRequest extends FormRequest
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
            'exam_id' => [
                'required',
                Rule::exists('exams', 'id')->whereNull('deleted_at')
            ],
            'exam' => [
                'required',
            ],
            'exam.*.question_id' => [
                'required',
            ],
            'exam.*.answer_id' => [
                'required',
            ],
            'exam.*.selected_anser' => [
                'required',
            ], 
           
        ];
    }

    private function getSubjectId()
    {
        $exam = Exam::where('id',$this->exam_id)->first();
        $sub_id =  ($exam)? $exam->subject_id :'';
        return $sub_id;
    }
}
