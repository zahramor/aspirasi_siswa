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
    Schema::create('input_aspirasis', function (Blueprint $table) {
        $table->id('id_pelaporan');
        $table->foreignId('nis')->constrained('siswas', 'nis');
        $table->foreignId('id_kategori')->constrained('kategoris', 'id_kategori');
        $table->string('lokasi');
        $table->text('ket');
        $table->date('tgl_input');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('input_aspirasis');
    }
};
