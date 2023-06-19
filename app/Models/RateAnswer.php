<?php

namespace App\Models;

use App\Enums\AnswersStatusEnums;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RateAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['question_id', 'rate_id', 'rate','actual_degree', 'status', 'note', 'assessment_id', 'user_id'];


    public function rateTable(): BelongsTo
    {
        return $this->belongsTo(Rate::class, 'rate_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function assess(): BelongsTo
    {
        return $this->belongsTo(Assessment::class);
    }
}
