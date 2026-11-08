<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('periods', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. "2026/2027"
            $table->string('cabinet_name'); // e.g. "Kabinet Ananta Anardhaya"
            $table->string('leader_name');
            $table->string('vice_leader_name')->nullable();
            $table->string('motto')->nullable();
            $table->text('vision')->nullable();
            $table->text('mission')->nullable();
            $table->string('cabinet_logo')->nullable();
            $table->boolean('is_active')->default(false);
            $table->integer('start_year');
            $table->integer('end_year');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('periods');
    }
};
