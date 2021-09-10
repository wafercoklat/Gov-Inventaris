<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangdetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangdetail', function (Blueprint $table) {
            $table->id('IdBarangDetail');
            $table->integer('IdBarang');
            $table->integer('Status');
            $table->enum('Verified', ['Y', 'N'])->default('N');
            $table->string('Remark',50)->nullable();;
            $table->string('Pelapor',20);
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
        Schema::dropIfExists('barangdetail');
    }
}
