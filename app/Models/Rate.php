<?php

namespace App\Models;

use App\Enums\RateStatusEnums;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rate extends Model
{
    use HasFactory;

    protected $table = 'rates';

    protected $fillable = ['team_id', 'user_id', 'manager_id', 'date', 'rate', 'status','assessment_id'];

    protected $attributes = [
        'status' => RateStatusEnums::PENDING,
    ];

    protected $casts = [
        'status' => RateStatusEnums::class,
    ];

    public function answers(): HasMany
    {
        return $this->hasMany(RateAnswer::class, 'rate_id');
    }

    public function assessment()
    {
        return $this->belongsTo(Assessment::class, 'assessment_id');
    }

    public function actions(): HasMany
    {
        return $this->hasMany(RateAction::class, 'rate_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }


    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function scopePublished($query)
    {
        // dd($query);
        return $query->where('status', 'published');
    }

    public function scopeAssessmentType($query, $type)
    {
        // dd($query,$type);
        return $query->whereHas('assessment', function ($q) use ($type) {
            $q->where('type', $type);
        });
    }
}
