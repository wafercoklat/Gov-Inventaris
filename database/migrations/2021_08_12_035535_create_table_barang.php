<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Barang', function (Blueprint $table) {
            $table->id('IdBarang');
            $table->integer('IdRuangan');
            $table->string('Code',25);
            $table->string('Name',64);
            $table->integer('Kategori');
            $table->string('Barcode', 100)->unique();
            $table->string('NUP',25)->nullable()->default(NULL);
            $table->string('Keterangan',64)->nullable()->default(NULL);
            $table->string('CreatedBy', 50)->nullable()->default(NULL);
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
        Schema::dropIfExists('Barang');
    }
}
