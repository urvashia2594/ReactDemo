<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Answer;
use App\Models\UserExam;



class UserExamQueAns extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'user_exam_que_ans';

    protected $fillable = [
        'user_exam_id',
        'user_id',
        'exam_id',
        'question_id',
        'answer_id',
        'user_answer',
        'correct_answer'
    ] ;

    public function userExam()
    {
        return $this->belongsTo(UserExam::class, 'user_exam_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class, 'answer_id', 'id');
    }



    

}
