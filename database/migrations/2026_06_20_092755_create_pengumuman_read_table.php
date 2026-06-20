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
        Schema::create('pengumuman_read', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pengumuman');
            $table->unsignedBigInteger('id_walimurid');
            $table->timestamps();

            // Indexes for faster lookup
            $table->index(['id_pengumuman', 'id_walimurid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumuman_read');
    }
};
