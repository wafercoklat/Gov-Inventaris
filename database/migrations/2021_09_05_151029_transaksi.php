<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Transaksi extends Migration
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
            $table->string('Type',10)->nullable()->default(NULL);
            $table->string('Trans',25)->nullable()->default(NULL);
            $table->integer('IdBarang')->nullable()->default(NULL);
            $table->integer('IdRuangan')->nullable()->default(NULL);
            $table->integer('IdRuangan2')->nullable()->default(NULL);
            $table->string('User',64)->nullable()->default(NULL);
            $table->string('Remark',64)->nullable()->default(NULL);
            $table->integer('Counter')->nullable()->default(NULL);
            $table->integer('CounterNo')->nullable()->default(NULL);
            $table->enum('Req', ['Y', 'N'])->default('N');
            $table->string('ReqBy',25)->nullable()->default(NULL);
            $table->timestamp('ReqTime')->nullable();
            $table->enum('Verified', ['Y', 'N'])->default('N');
            $table->string('VerifyBy',25)->nullable()->default(NULL);
            $table->timestamp('VerifedTime')->nullable();
            $table->timestamps();
        });   //
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
