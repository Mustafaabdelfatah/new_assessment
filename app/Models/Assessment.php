<?php

namespace App\Models;

use App\Models\Question;
use App\Models\TeamUser;
use App\Models\AssessmentQuestion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Assessment extends Model
{
    use HasFactory;

    protected $table = 'assessments';

    protected $fillable = [
        'title', 'type', 'manager_id', 'time', 'start_date', 'to_date','status','slug'
    ];

    protected $casts = [
        'start_date' => 'date:Y-m-d',
        'to_date' => 'date:Y-m-d'
    ];


    public function questions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'assessment_questions');
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'assessment_users');
    }

    public function rates()
    {
        return $this->hasMany(Rate::class,'assessment_id');
    }

    public function answers()
    {
        return $this->hasMany(RateAnswer::class,'assessment_id');
    }

    public function actions()
    {
        return $this->hasMany(RateAction::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class);
    }





}
