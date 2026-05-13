<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ElectricityUsage extends Model
{
    protected $fillable = [
        'user_id',
        'month',
        'year',
        'kwh',
        'cost',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
