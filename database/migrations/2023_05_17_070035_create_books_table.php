<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_category_id');
            $table->foreign('book_category_id')->references('id')->on('book_categories')->onDelete('cascade')->cascadeOnUpdate();
            $table->string('kode_buku');
            $table->string('judul_buku');
            $table->string('nama_pengarang');
            $table->string('nama_penerbit');
            $table->string('tahun_terbit');
            $table->integer('jumlah_buku');
            $table->enum('available', ['y', 'n'])->default('y');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
