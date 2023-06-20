<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Subject;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Question;

class Answer extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'answers';

    protected $fillable = [
        'subject_id',
        'question_id',
        'opption_1',
        'opption_2',
        'opption_3',
        'opption_4',
        'correct_answer',
    ] ;

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

}
