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
        Schema::create('khutbah_jumat', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('judul')->nullable();
            $table->text('catatan')->nullable();            
            $table->foreignId('imam_id');
            $table->foreign('imam_id')->references('id')->on('petugas_keagamaan')->onDelete('cascade');
            $table->foreignId('khotib_id');
            $table->foreign('khotib_id')->references('id')->on('petugas_keagamaan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khutbah_jumats');
    }
};
