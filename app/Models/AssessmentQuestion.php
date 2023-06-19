<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentQuestion extends Model
{
    use HasFactory;
    protected $table = 'assessment_questions';

    protected $fillable = [
        'question_id','assess_id','user_id'
    ];
}
