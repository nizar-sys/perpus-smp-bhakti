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
        Schema::create('stock_opnames', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buku_id');
            $table->foreign('buku_id')->references('id')->on('books')->onDelete('cascade')->cascadeOnUpdate();
            $table->date('tanggal');
            $table->longText('keterangan');
            $table->integer('jumlah_buku');
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
        Schema::dropIfExists('stock_opnames');
    }
};
