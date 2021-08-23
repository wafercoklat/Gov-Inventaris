<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTransaksipindahbarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Transaksi', function (Blueprint $table) {
            $table->id('IdTrans');
            $table->string('Trans',25);
            $table->integer('IdBarang');
            $table->integer('IdRuangan');
            $table->string('User',64);
            $table->string('Remark',64);
            $table->integer('Counter');
            $table->enum('Req', ['Y', 'N'])->default('N');
            $table->string('ReqBy',25);
            $table->timestamp('ReqTime')->nullable();
            $table->enum('Verified', ['Y', 'N'])->default('N');
            $table->string('VerifyBy',25);
            $table->timestamp('VerifedTime')->nullable();
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
        Schema::dropIfExists('Transaksi');
    }
}
