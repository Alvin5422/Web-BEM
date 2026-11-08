<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aspirations', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_code')->unique();
            $table->string('name')->nullable();
            $table->boolean('is_anonymous')->default(false);
            $table->string('nim')->nullable();
            $table->string('study_program')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('topic'); // Akademik & Kurikulum, Fasilitas Kampus, dll.
            $table->string('subject');
            $table->text('content');
            $table->string('attachment')->nullable();
            $table->enum('status', ['menunggu', 'diproses', 'ditindaklanjuti', 'selesai'])->default('menunggu');
            $table->text('admin_notes')->nullable();
            $table->text('response')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aspirations');
    }
};
