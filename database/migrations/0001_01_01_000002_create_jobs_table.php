<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('tbl_kjemaat', function (Blueprint $table) {
            $table->bigIncrements('id_kjemaat');
            $table->string('kategori');
            $table->timestamps();
        });

        Schema::create('tbl_njemaat', function (Blueprint $table) {
            $table->bigIncrements('id_njemaat');
            $table->unsignedBigInteger('id_kjemaat'); 
            $table->string('nama');
            $table->timestamps();
        
            $table->foreign('id_kjemaat')->references('id_kjemaat')->on('tbl_kjemaat'); 
        });
        
        Schema::create('tbl_lagu', function (Blueprint $table) {
            $table->bigIncrements('id_lagu');
            $table->string('judul');
            $table->string('genre');
            $table->timestamps();
        });

        Schema::create('tbl_kategori_lomba', function (Blueprint $table) {
            $table->bigIncrements('id_kategori_lomba');
            $table->string('kategori_lomba');
            $table->timestamps();
        });

        Schema::create('tbl_register', function (Blueprint $table) {
            $table->bigIncrements('id_register');
            $table->unsignedBigInteger('id_njemaat');
            $table->unsignedBigInteger('id_lagu');
            $table->unsignedBigInteger('id_kategori_lomba');
            $table->string('kordinator');
            $table->string('phone')->nullable();
            $table->boolean('status');
            $table->string('file')->nullable();
            $table->timestamps();

            $table->foreign('id_njemaat')->references('id_njemaat')->on('tbl_njemaat');
            $table->foreign('id_lagu')->references('id_lagu')->on('tbl_lagu');
            $table->foreign('id_kategori_lomba')->references('id_kategori_lomba')->on('tbl_kategori_lomba'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_njemaat');
        Schema::dropIfExists('tbl_lagu');
        Schema::dropIfExists('tbl_kjemaat');
        Schema::dropIfExists('tbl_kategori_lomba');
        Schema::dropIfExists('tbl_register');
    }
};
