<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('ai_conversations', function (Blueprint $table) {
            $table->string('provider')->nullable()->after('answer');
            $table->string('model')->nullable()->after('provider');
        });

        Schema::table('ai_insights', function (Blueprint $table) {
            $table->string('provider')->nullable()->after('insight');
            $table->string('model')->nullable()->after('provider');
        });
    }

    public function down()
    {
        Schema::table('ai_conversations', function (Blueprint $table) {
            $table->dropColumn(['provider', 'model']);
        });

        Schema::table('ai_insights', function (Blueprint $table) {
            $table->dropColumn(['provider', 'model']);
        });
    }
};
