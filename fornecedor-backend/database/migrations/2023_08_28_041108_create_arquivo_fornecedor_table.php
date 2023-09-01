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
        Schema::create('arquivo_fornecedor', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('path');
            $table->string('filename');
            $table->unsignedBigInteger('fornecedor_id')->nullable();
            $table->foreign('fornecedor_id')->references('id')->on('fornecedores');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arquivo_fornecedors');
    }
};
