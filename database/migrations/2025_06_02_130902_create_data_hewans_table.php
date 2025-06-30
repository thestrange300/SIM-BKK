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
        Schema::create('data_hewan', function (Blueprint $table) {
            $table->id();
            $table->string('id_hewan')->unique();
            $table->enum('jenis_hewan', ['Kambing', 'Sapi', 'Domba', 'Kerbau', 'Lainnya']);
            $table->decimal('berat', 8, 2)->nullable();
            $table->date('tanggal')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_hewans');
    }
};
