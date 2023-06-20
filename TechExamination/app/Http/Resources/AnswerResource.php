<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'subject_id' => $this->subject_id,
            'question_id' => $this->question_id,
            'subject_name' => $this->subject->name,
            'opption_1' => $this->opption_1,
            'opption_2' => $this->opption_2,
            'opption_3' => $this->opption_3,
            'opption_4' => $this->opption_4,
            'correct_answer' => $this->correct_answer,
            'created_at' => $this->created_at->format('d-m-Y H:i:s'),
            'updated_at' => $this->updated_at->format('d-m-Y H:i:s'),
        ];
    }
}
