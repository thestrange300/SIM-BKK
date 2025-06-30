<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dist_daging_qurban_tipe', function (Blueprint $table) {
            $table->foreignId('dist_daging_qurban_id')->constrained('dist_daging_qurban')->cascadeOnDelete();
            $table->foreignId('tipe_daging_qurban_id')->constrained()->cascadeOnDelete();
            $table->primary(['dist_daging_qurban_id', 'tipe_daging_qurban_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dist_daging_qurban_tipe');
    }
};
