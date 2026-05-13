<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ai_conversations', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('user_id')->constrained()->onDelete('cascade');
            $blueprint->text('question');
            $blueprint->text('answer');
            $blueprint->timestamps();
        });

        Schema::create('ai_insights', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->foreignId('user_id')->constrained()->onDelete('cascade');
            $blueprint->integer('month');
            $blueprint->integer('year');
            $blueprint->text('insight');
            $blueprint->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ai_insights');
        Schema::dropIfExists('ai_conversations');
    }
};
