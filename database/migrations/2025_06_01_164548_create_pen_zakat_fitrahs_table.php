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
        Schema::create('pen_zakat_fitrah', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_penerimaan');
            $table->string('nama_muzakki');
            $table->string('alamat')->nullable();
            $table->foreignId('tipe_zakat_fitrah_id');
            $table->foreign('tipe_zakat_fitrah_id')->references('id')->on('tipe_zakat_fitrah')->onDelete('cascade');
            $table->decimal('jumlah_makanan_pokok', 8, 2)->nullable(); // dalam kg
            $table->decimal('jumlah_uang', 12, 2)->nullable(); // dalam rupiah
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pen_zakat_fitrah');
    }
};
