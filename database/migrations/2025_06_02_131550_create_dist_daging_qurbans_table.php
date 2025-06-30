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
        Schema::create('dist_daging_qurban', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_penerimaan');
            $table->string('nama_penerima');
            $table->string('alamat')->nullable();
            $table->json('tipe_daging_qurban')->nullable(); // Assuming this is a JSON field for types of meat
            $table->decimal('jumlah', 8, 2);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dist_daging_qurban');
    }
};
