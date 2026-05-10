<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up() {
    Schema::create('tanggapan_aspirasis', function (Blueprint $table) {
        $table->id('id_aspirasi');
        $table->foreignId('id_pelaporan')->constrained('input_aspirasis', 'id_pelaporan');
        $table->enum('status', ['Menunggu', 'Proses', 'Selesai'])->default('Menunggu');
        $table->text('feedback')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanggapan_aspirasis');
    }
};
