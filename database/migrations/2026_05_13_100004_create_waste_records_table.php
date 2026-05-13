<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('waste_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->decimal('organic_kg', 10, 2)->default(0);
            $table->decimal('plastic_kg', 10, 2)->default(0);
            $table->decimal('paper_kg', 10, 2)->default(0);
            $table->decimal('metal_kg', 10, 2)->default(0);
            $table->decimal('other_kg', 10, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('waste_records');
    }
};
