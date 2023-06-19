<?php

namespace App\Models;

use App\Models\Rate;
use App\Models\User;
use App\Models\RateAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';

    protected $fillable = [
        'status','note','action_id','rate_id','user_id'
    ];

    public function rate_action()
    {
        return $this->belongsTo(RateAction::class,'action_id');
    }
    public function rate()
    {
        return $this->belongsTo(Rate::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // belongsto
}
