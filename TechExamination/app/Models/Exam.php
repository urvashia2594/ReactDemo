<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Subject;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\UserExam;


class Exam extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'exams';

    protected $fillable = [
        'subject_id',
        'name',
        'attempt',
    ] ;

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function userEaxm()
    {
        return $this->hasMany(UserExam::class, 'exam_id', 'id');
    }

    

}
