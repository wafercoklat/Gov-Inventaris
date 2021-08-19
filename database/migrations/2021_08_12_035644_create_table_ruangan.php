<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRuangan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Ruangan', function (Blueprint $table) {
            $table->id('IdRuangan');
            $table->string('Code',25);
            $table->string('Name',64);
            $table->string('NUP',25)->nullable()->default(NULL);
            $table->string('Keterangan',64)->nullable()->default(NULL);
            $table->integer('Counter')->nullable()->default(NULL);
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
        Schema::dropIfExists('Ruangan');
    }
}
