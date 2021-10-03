<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksidetail', function (Blueprint $table) {
            $table->integer('IdTrans');
            $table->id('DetailID');
            $table->integer('IdBarang')->nullable()->default(NULL);
            $table->integer('IdRuangan')->nullable()->default(NULL);
            $table->integer('IdRuangan2')->nullable()->default(NULL);
            $table->integer('Status')->default('1');
            $table->string('Remark',64)->nullable()->default(NULL);
            $table->enum('Req', ['Y', 'N'])->default('N');
            $table->string('ReqBy',25)->nullable()->default(NULL);
            $table->timestamp('ReqTime')->nullable();
            $table->enum('Checked', ['Y', 'N'])->default('N');
            $table->string('CheckBy',25)->nullable()->default(NULL);
            $table->timestamp('CheckTime')->nullable();
            $table->enum('Verified', ['Y', 'N'])->default('N');
            $table->string('VerifyBy',25)->nullable()->default(NULL);
            $table->timestamp('VerifedTime')->nullable();
            $table->enum('Done', ['Y','R', 'N'])->default('N');
            $table->timestamp('DoneTime')->nullable();
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
        Schema::dropIfExists('transaksi_detail');
    }
}
