<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AIInsight extends Model
{
    protected $table = 'ai_insights';
    protected $fillable = ['user_id', 'month', 'year', 'insight'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
