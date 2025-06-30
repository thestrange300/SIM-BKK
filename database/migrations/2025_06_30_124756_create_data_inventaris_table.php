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
        Schema::create('data_inventaris', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang'); // e.g., CHAIR01, TABLE01
            $table->string('nama_barang'); // e.g., Chair, Table
            $table->string('serial_number')->nullable(); // For unique items, nullable for grouped
            $table->integer('jumlah')->default(1); // Quantity
            $table->foreignId('tipe_inventaris_id');
            $table->foreign('tipe_inventaris_id')->references('id')->on('tipe_inventaris')->onDelete('cascade');
            $table->string('lokasi')->nullable(); // e.g., Room 101
            $table->string('kondisi')->nullable(); // e.g., Good, Broken
            $table->text('keterangan')->nullable(); // Notes
            $table->date('tanggal_penerimaan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_inventaris');
    }
};
