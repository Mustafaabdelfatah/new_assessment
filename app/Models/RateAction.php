<?php

namespace App\Models;

use App\Models\Rate;
use App\Enums\ActionsStatusEnums;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RateAction extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'user_id' ,'assess_id', 'status','employee_id'];

    protected $attributes = [
        'status' => ActionsStatusEnums::PENDING,
    ];

    protected $casts = [
        'status' => ActionsStatusEnums::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employees()
    {
        return $this->hasMany(User::class, 'employee_id');
    }


    public function assess()
    {
        return $this->belongsTo(Assessment::class);
    }

    public function rate()
    {
        return $this->belongsTo(Rate::class);
    }
}
