<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Exam;
use App\Models\UserExamQueAns;

class UserExam extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'user_exams';

    protected $fillable = [
        'user_id',
        'exam_id',
        'total_attempt',
    ] ;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }

    public function userEaxmQueAns()
    {
        return $this->hasMany(UserExamQueAns::class, 'user_exam_id', 'id');
    }



    

}
