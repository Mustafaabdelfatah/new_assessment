<?php

namespace App\Models;

use App\Models\Question;
use App\Enums\CategoryStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'status'];

    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }

    // public function questions()
    // {
    //     return $this->hasMany(Question::class);
    // }

}
