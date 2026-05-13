<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AIConversation extends Model
{
    protected $table = 'ai_conversations';
    protected $fillable = ['user_id', 'question', 'answer'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
