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
        Schema::create('berita_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('berita_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('berita_id')->references('id')->on('beritas')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('kategoris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita_category');
    }
};
