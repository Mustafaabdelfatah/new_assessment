<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\softDeletes;

class Position extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'positions';

    protected $fillable = [
        'title',
        'parent_id'
    ];

    public function parent_position()
    {
        return $this->belongsTo(self::class,'parent_id');
    }

    public function child_positions()
    {
        return $this->hasMany(self::class, 'parent_id')->with('child_positions');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
