<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRuanganDetail extends Migration
{
    /**
     * Run the migrations.
     * Fungsi : check ruangan ada di lantai berapa
     * @return void
     */
    public function up()
    {
        Schema::create('RuanganDetail', function (Blueprint $table) {
            $table->id('idDetail');
            $table->string('idRuangan',15);
            $table->string('idLokasi',15);
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
        Schema::dropIfExists('RuanganDetail');
    }
}
