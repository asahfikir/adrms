<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_indicator_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // PIC
            $table->text('target')->nullable();         // e.g. "Kesesuaian Dokumen (100%)"
            $table->string('table_data')->nullable();   // Data tabel tambahan kalau ada
            $table->string('document_name');
            $table->text('document_link')->nullable();  // bisa null kalau belum diisi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
