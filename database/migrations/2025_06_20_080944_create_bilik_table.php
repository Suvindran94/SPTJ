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
   Schema::create('bilik', function (Blueprint $table) {
    $table->id();
    $table->string('nama_bilik'); // Room name or number, e.g., "Bilik 1"
    $table->string('jenis_rawatan'); // Type of treatment in the room, e.g., "ENT", "Ortho"
    $table->unsignedBigInteger('doktor_id')->nullable(); // Reference to doctor (user)
    $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif'); // Room availability
    $table->text('keterangan')->nullable(); // Optional notes about the room
    $table->timestamps();

    // Foreign key constraint if linked to users table
    $table->foreign('doktor_id')->references('id')->on('users')->onDelete('set null');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bilik');
    }
};
