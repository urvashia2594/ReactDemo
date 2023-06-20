<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Question;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Answer;
use App\Models\Exam;

class Subject extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'subjects';

    protected $fillable = [
        'name'
    ] ;

    public function questions()
    {
        return $this->hasMany(Question::class, 'subject_id', 'id');
    }

    public function answer()
    {
        return $this->hasMany(Answer::class, 'subject_id', 'id');
    }

    public function exam()
    {
        return $this->hasMany(Exam::class, 'subject_id', 'id');
    }
}
