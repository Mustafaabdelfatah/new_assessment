<?php

namespace App\Models;

use App\Models\Team;
use App\Models\Assessment;
use App\Models\Category;
use App\Models\RateAnswer;
use App\Enums\CategoryStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;
    protected $table = 'questions';

    protected $fillable = [
        'title',
        'percentage'
    ];
    public function assessments()
    {
        return $this->belongsToMany(Assessment::class, 'assessment_questions');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function readAnswers()
    {
        return $this->hasOne(RateAnswer::class);
    }

    public function getCategoriesListAttribute()
    {
        return $this->categories->map(function($category) {
            return '<span class="badge badge-primary">' . $category->name . '</span>';
        })->implode(' ');
    }

}
