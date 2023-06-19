<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;

    protected $table = 'teams';

    protected $fillable = [
        'title',
        'manager_id',
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(TeamUser::class, 'team_id', 'id');
    }


    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'team_users', 'team_id', 'user_id')->withPivot('user_id', 'team_id');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
