<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingSetting extends Model
{
    use HasFactory;

    protected $table = 'landing_settings';

    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'hero_image_path',
    ];
}
