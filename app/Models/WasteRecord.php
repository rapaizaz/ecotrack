<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WasteRecord extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'organic_kg',
        'plastic_kg',
        'paper_kg',
        'metal_kg',
        'other_kg',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
