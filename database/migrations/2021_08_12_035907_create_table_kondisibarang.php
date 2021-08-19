<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKondisibarang extends Migration
{
    /**
     * Run the migrations.
     * Fungsi : Check barang yang rusak dan tidak rusak untuk pelaporan barang yang rusak
     * @return void
     */
    public function up()
    {
        Schema::create('BarangDetail', function (Blueprint $table) {
            $table->id('IdBarangDetail');
            $table->integer('IdBarang');
            $table->string('Kondisi',64);
            $table->string('Status',25);
            $table->string('Remark',64)->nullable()->default(NULL);
            $table->string('Pelapor',64);
            $table->integer('Counter');
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
        Schema::dropIfExists('BarangDetail');
    }
}
