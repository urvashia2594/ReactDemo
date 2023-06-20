<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Subject;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Answer;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Question extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'questions';

    protected $fillable = [
        'subject_id',
        'que'
    ] ;

    public function getSubWithQueAttribute()
    {
        return $this->subject->name . ' - ' . $this->que;
    }

    protected function subWithQue(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  $this->subject->name . ' - ' . $this->que
            // set: fn ($value) =>  Carbon::parse($value)->format('Y-m-d'),
        );
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function answer()
    {
        return $this->hasMAny(Answer::class, 'question_id', 'id');
    }

}
