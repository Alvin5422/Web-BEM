<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('period_id')->constrained('periods')->cascadeOnDelete();
            $table->string('department');
            $table->string('name');
            $table->text('description');
            $table->text('objective')->nullable();
            $table->string('target_audience')->nullable();
            $table->enum('status', ['direncanakan', 'berjalan', 'selesai'])->default('direncanakan');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('person_in_charge')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
