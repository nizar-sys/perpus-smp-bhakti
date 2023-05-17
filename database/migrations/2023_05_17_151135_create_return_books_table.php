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
        Schema::create('return_books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('borrow_id');
            $table->foreign('borrow_id')->references('id')->on('borrows')->onDelete('cascade')->cascadeOnUpdate();
            $table->unsignedBigInteger('petugas_id');
            $table->foreign('petugas_id')->references('id')->on('users')->onDelete('cascade')->cascadeOnUpdate();
            $table->date('tanggal_kembali');
            $table->integer('denda');
            $table->integer('jumlah_denda');
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
        Schema::dropIfExists('return_books');
    }
};
