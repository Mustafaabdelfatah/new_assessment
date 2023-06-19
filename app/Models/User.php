<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Rate;
use App\Models\Position;
use App\Models\Assessment;
use App\Models\RateAction;
use App\Enums\UsersTypesEnums;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword;


    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'image',
        'type',
        'position_id',
    ];

    protected $appends = ['image_path'];


    protected $attributes = [
        'type' => UsersTypesEnums::EMPLOYEE,
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        'type' => UsersTypesEnums::class,
    ];

    public function getImagePathAttribute()
    {
        $path = 'public/users/' . $this->image;
        $imageExists = Storage::exists($path);

        if ($this->image && $imageExists) {
            return asset('storage/users/' . $this->image);
        } else {
            return asset('storage/users/default.jpg');
        }
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function rateActions(): HasMany
    {
        return $this->hasMany(RateAction::class);
    }

    public function actions(): HasMany
    {
        return $this->hasMany(RateAction::class, 'rate_id');
    }

    public function AssessmentManager()
    {
        return $this->hasMany(Assessment::class, 'manager_id');
    }

    public function assessment(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Assessment::class, 'assessment_users')->withPivot('user_id', 'assessment_id');
    }


    public function rates(): HasMany
    {
        return $this->hasMany(Rate::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(RateAnswer::class);
    }

    public function answersRate(): HasMany
    {
        return $this->hasMany(RateAnswer::class, 'user_id');
    }


    public function teams(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'team_users')->withPivot('user_id', 'team_id');
    }


}
